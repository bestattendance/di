<?php

namespace ContactForm\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ContactForm\Model\FormSubmission\FormSubmission;
use ContactForm\Model\Exception\RequiredFieldMissingException;
use ContactForm\Service\EmailFormSubmissionService;

/**
 * Handles HTTP requests to the contact form page.
 *
 * Class ContactFormController
 * @package ContactForm\Controller
 */
class ContactFormController extends AppControllerAbstract
{

    /**
     * Allows users to submit contact forms.
     *
     * @param Request $request
     * @return Response
     */
    public function showContactFormAction(Request $request)
    {
        // Create a new FormSubmission model
        /** @var FormSubmission $formSubmission */
        $formSubmission = $this->_container['FormSubmissionModel'];
        $formErrors = [];

        // If this is a post request, populate the model with post data, write to database, and send email.
        if ($request->isMethod('post')) {

            $formSubmission
                ->setFullName($request->get('full_name'))
                ->setEmail($request->get('email'))
                ->setMessage($request->get('message'))
                ->setPhone($request->get('phone'));

            try {

                // Persist the submission to the database
                $formSubmission->save();

                // Email the submission
                // If more robustness were needed, this would be triggered via an event lister and put into a queue,
                // with error logs for failed emails.
                $emailFormSubmissionService = new EmailFormSubmissionService($this->_container['SwiftMailer']);
                $emailFormSubmissionService->sendEmailNotice(
                    $formSubmission,
                    $this->_container['config']->admin_email,
                    $this->_container['config']->admin_name
                );

                // Display a thank-you page
                // Most of the time I would use a session flash message for these types of notifications.
                // (Also, if there was a proper router, I would use a redirect instead of forwarding to a different controller).
                // To increase maintainability, the common parts of the view would be factored out into a Twig layout, from which
                // each Twig template would inherit.
                return $this->_thankYou();

            } catch (RequiredFieldMissingException $e) {
                $formErrors = $formSubmission->getErrors();

                // A production application would require additional error handling and logging.
            }
        }


        // Twig will automatically escape output to prevent cross site scripting attacks.
        // CSRF is not a concern, as there is no authenticated session.

        /** @var $this->_container['twig'] Twig_Environment */
        return new Response($this->_container['twig']->render('/ContactForm/contact.twig', [
            'formSubmission' => $formSubmission,
            'formErrors' => $formErrors
        ]));
    }

    /**
     * Displays a thank you page
     * @return Response
     */
    protected function _thankYou()
    {
        return new Response($this->_container['twig']->render('/ContactForm/thank-you.twig', []));
    }
}