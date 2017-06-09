<?php

namespace ContactForm\Model;

/**
 * Parent Model class for all concrete Model classes in the application.
 *
 * Class ModelAbstract
 * @package ContactForm\Model
 */
class AppModelAbstract
{

    /**
     * @var \PDO
     */
    protected $_pdo;

    /**
     * Inject dependencies
     * @param $pdo \PDO
     */
    public function __construct($pdo)
    {
        $this->_pdo = $pdo;
    }
}