<?php

namespace ContactForm\Service;

use ContactForm\Model\FormSubmission\FormSubmission;

/**
 * Provides services for emailing all form submissions to a pre-configured contact.
 *
 * Class EmailFormSubmissionService
 * @package ContactForm\Service
 */
class EmailFormSubmissionService
{

    /**
     * @var \Swift_Mailer
     */
    protected $_swiftMailer;

    /**
     * Inject dependencies.
     * @param \Swift_Mailer $swiftMailer
     */
    public function __construct(\Swift_Mailer $swiftMailer)
    {
        $this->_swiftMailer = $swiftMailer;
    }

    /**
     * Sends an email notifying the specified recipient of the provided form submission.
     *
     * @param FormSubmission $formSubmission
     * @param $adminEmail
     * @param $adminName
     * @return void
     */
    public function sendEmailNotice(FormSubmission $formSubmission, $adminEmail, $adminName)
    {

        $submissionData = [
            'Full Name: ' => $formSubmission->getFullName(),
            'Email: ' => $formSubmission->getEmail(),
            'Message: ' => $formSubmission->getMessage(),
            'Phone: ' => $formSubmission->getPhone()
        ];

        $message = new \Swift_Message('Code Challenge Form Submission');
        $message
            ->setContentType('text/html')
            ->setFrom(['no-reply@example.com' => 'Dealer Inspire'])
            ->setTo([$adminEmail => $adminName])
            ->setBody(implode('<br>', $submissionData));

        $result = $this->_swiftMailer->send($message);
    }

}