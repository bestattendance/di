<?php

namespace ContactForm\Controller;

use Pimple\Container;

/**
 * Parent controller for all concrete controller classes in the application.
 *
 * Class AppControllerAbstract
 * @package ContactForm\Controller
 */
abstract class AppControllerAbstract
{

    /**
     * @var Container
     */
    protected $_container;

    /**
     * Inject dependencies and initialize the object.
     *
     * @param Container $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->_container = $container;
    }
}