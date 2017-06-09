<?php

namespace ContactForm\Model\FormSubmission;

use \ContactForm\Model\AppModelAbstract;

/**
 * Active Record implementation of a FormSubmission object (I stay away from Active Record for most projects, but
 * it will suffice for this application).  Only the CREATE method is implemented, per the requirements.
 *
 * Class FormSubmission
 * @package ContactForm\Model
 */
class FormSubmission extends AppModelAbstract
{

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


    /*******************************************************************************************************************
     * PROTECTED METHODS
     ******************************************************************************************************************/



    /*******************************************************************************************************************
     * ACCESSORS AND MUTATORS
     ******************************************************************************************************************/

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
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
     */
    public function setFullName($fullName)
    {
        $this->_fullName = $fullName;
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
     */
    public function setId($id)
    {
        $this->_id = $id;
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
     */
    public function setMessage($message)
    {
        $this->_message = $message;
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
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }
}