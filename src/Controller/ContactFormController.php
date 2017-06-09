<?php

namespace ContactForm\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ContactForm\Model\FormSubmission\FormSubmission;
use ContactForm\Model\Exception\RequiredFieldMissingException;

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
                $formSubmission->save();

            } catch (RequiredFieldMissingException $e) {
                $formErrors = $formSubmission->getErrors();
            }
        }


        /** @var $this->_container['twig'] Twig_Environment */
        return new Response($this->_container['twig']->render('/ContactForm/contact.twig', [
            'formSubmission' => $formSubmission,
            'formErrors' => $formErrors
        ]));
    }
}