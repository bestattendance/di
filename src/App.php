<?php

namespace ContactForm;

use ContactForm\Controller\ContactFormController;
use Symfony\Component\HttpFoundation\Request;
use Pimple\Container;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Runs the model-view-controller application.  Assumes that there is one and only one route, which is for
 * the contact page.  This route knows how to handle GET and POST requests.
 *
 * Class App
 * @package ContactForm
 */
class App
{

    /**
     * @var Request
     */
    protected $_request;

    /**
     * Dependency Injection Container
     * @var Container
     */
    protected $_container;

    /**
     * Initialize the application.  Configure the IOC container.
     * (In a more complex application this would be factored out into its own class or service)
     */
    public function __construct()
    {
        $this->_container = new Container();

        // Create a Twig service provider
        $this->_container['twig'] = function($c) {
            $loader = new Twig_Loader_Filesystem(__DIR__ . '/View');
            $twig = new Twig_Environment($loader);
            return $twig;
        };
    }

    /**
     * Runs the application.
     *
     * @param Request $request      The Request object
     * @return void
     */
    public function run(Request $request)
    {
        $this->_request = $request;

        // Assume that there is one and only one route in the application, which is the contact form.
        $contactFormController = new ContactFormController($this->_container);
        $response = $contactFormController->showContactFormAction($request);
        $response->prepare($this->_request);
        $response->send();
    }

}