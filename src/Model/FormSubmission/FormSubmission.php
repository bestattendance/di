<?php

namespace ContactForm\Model\FormSubmission;

use \ContactForm\Model\AppModelAbstract;
use ContactForm\Model\Exception\RequiredFieldMissingException;

/**
 * Active Record implementation of a FormSubmission object (I stay away from Active Record for most projects, but
 * it will suffice for this application).  Only the CREATE method is implemented, per the requirements.
 *
 * Class FormSubmission
 * @package ContactForm\Model
 */
class FormSubmission extends AppModelAbstract
{

    /**
     * An array containing error messages, indexed by field name.
     * @var array
     * @readonly
     */
    protected $_errors;

    /*******************************************************************************************************************
     * FIELDS
     ******************************************************************************************************************/

    /**
     * @var integer
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_fullName;

    /**
     * @var string
     */
    protected $_email;

    /**
     * @var string
     */
    protected $_message;

    /**
     * @var string
     */
    protected $_phone;


    /*******************************************************************************************************************
     * PUBLIC METHODS
     ******************************************************************************************************************/

    /**
     * Validates, and saves the form submission.
     *
     * @return void
     * @throws RequiredFieldMissingException
     */
    public function save()
    {
        $this->_assertValid();

        // Usually I use a higher level abstraction like a DBAL or ORM for data management.  For this project,
        // PDO is sufficient.
        $sql = "INSERT INTO form_submissions (full_name, email, message, phone) VALUES "
             . "(:fullName, :email, :message, :phone)";
        $stmt = $this->_pdo->prepare($sql);

        // Bind parameters to prevent SQL injection
        $stmt->bindValue(':fullName', $this->_fullName, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->_email, \PDO::PARAM_STR);
        $stmt->bindValue(':message', $this->_message, \PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->_phone, \PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }


    /*******************************************************************************************************************
     * PROTECTED METHODS
     ******************************************************************************************************************/

    /**
     * Asserts that all required fields have been entered.
     *
     * @return void
     * @throws RequiredFieldMissingException
     */
    protected function _assertValid()
    {
        // Using a hand-rolled validator, since we are not using a broader framework or ORM layer.
        $this->_errors = [];
        if (empty($this->_fullName)) {
            $this->_errors['full_name'] = 'Required field missing: full name';
        }
        if (empty($this->_email)) {
            $this->_errors['email'] = 'Required field missing: email';
        }
        if (empty($this->_message)) {
            $this->_errors['message'] = 'Required field missing: message';
        }

        if (count($this->_errors)) {
            throw new RequiredFieldMissingException('One or more required fields were missing');
        }
    }

    /*******************************************************************************************************************
     * ACCESSORS AND MUTATORS
     ******************************************************************************************************************/

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $fullName
     * @return $this
     */
    public function setFullName($fullName)
    {
        $this->_fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->_fullName;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->_message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }
}