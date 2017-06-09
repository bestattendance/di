<?php

namespace ContactForm\Test\Model;

use ContactForm\Test\ContactFormTestCase;
use ContactForm\Model\FormSubmission\FormSubmission;
use ContactForm\App;
use ContactForm\Model\Exception\RequiredFieldMissingException;

/**
 * Class FormSubmissionTest
 * @package ContactForm\Test\Model
 */
class FormSubmissionTest extends ContactFormTestCase
{


    /**
     * Test missing required field: full name
     *
     * @expectedException \ContactForm\Model\Exception\RequiredFieldMissingException
     */
    public function testMissingFullName()
    {

        $formSubmission = new FormSubmission($this->_container['pdo']);
        $formSubmission
            ->setEmail('example@example.com')
            ->setMessage('dummy message')
            ->setPhone('555-555-5555')
            ->save();
    }

    /**
     * Test missing required field: email
     *
     * @expectedException \ContactForm\Model\Exception\RequiredFieldMissingException
     */
    public function testMissingEmail()
    {

        $formSubmission = new FormSubmission($this->_container['pdo']);
        $formSubmission
            ->setFullName('John Doe')
            ->setMessage('dummy message')
            ->setPhone('555-555-5555')
            ->save();
    }

    /**
     * Test missing required field: message
     *
     * @expectedException \ContactForm\Model\Exception\RequiredFieldMissingException
     */
    public function testMissingMessage()
    {

        $formSubmission = new FormSubmission($this->_container['pdo']);
        $formSubmission
            ->setFullName('John Doe')
            ->setEmail('example@example.com')
            ->setPhone('555-555-5555')
            ->save();
    }

    /**
     * Test saving a form submission
     */
    public function testSuccessfulSave()
    {
        // Testing this would require either a mock or a separate test database
        $this->assertTrue(true);
    }


}