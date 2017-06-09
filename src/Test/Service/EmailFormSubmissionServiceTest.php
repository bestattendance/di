<?php

namespace ContactForm\Test\Model;

use ContactForm\Test\ContactFormTestCase;
use ContactForm\Service\EmailFormSubmissionService;
use ContactForm\Model\FormSubmission\FormSubmission;

/**
 * Class EmailFormSubmissionServiceTest
 * @package ContactForm\Test\Model
 */
class EmailFormSubmissionServiceTest extends ContactFormTestCase
{

    /**
     * Test the email sending service.
     * See notes in ContactFormTestCase regarding the Pimple Container for test cases.
     * We assert true at the end; running this test ensures that no exceptions where thrown or errors occurred..
     */
    public function testSendEmail()
    {
        $emailFormSubmissionService = new EmailFormSubmissionService($this->_container['SwiftMailer']);

        $formSubmission = new FormSubmission($this->_container['pdo']);
        $formSubmission
            ->setFullName('John Doe')
            ->setEmail('example@example.com')
            ->setMessage('dummy message')
            ->setPhone('555-555-5555');

        $emailFormSubmissionService->sendEmailNotice($formSubmission, 'example@example.com', 'John Doe');

        $this->assertTrue(true);
    }

}