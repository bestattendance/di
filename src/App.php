<?php

namespace ContactForm;

use ContactForm\Controller\ContactFormController;
use Symfony\Component\HttpFoundation\Request;
use Pimple\Container;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Zend\Config\Config;


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

        // Return a shared instance of a Twig_Environment
        $this->_container['twig'] = function($c) {
            $loader = new Twig_Loader_Filesystem(__DIR__ . '/View');
            return new Twig_Environment($loader);
        };

        // Return a shared instance of the Zend Config component
        // Application configurations are in /src/config.php
        $this->_container['config'] = function($c) {
            return new Config(include 'config.php');
        };

        // Return a shared instance of PDO.
        // I usually use a DBAL and sometimes an ORM on top of PDO, but for this project,
        // I will use PDO directly.
        $this->_container['pdo'] = function($c) {
            $dsn = 'mysql:dbname=' . $c['config']->db_name . ';host=' . $c['config']->db_host;

            try {
                $pdo = new \PDO($dsn, $c['config']->db_username, $c['config']->db_password);
            } catch (\PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            return $pdo;
        };

        // Using a full featured framework, there would be a much better way of instantiating model objects.
        $this->_container['FormSubmissionModel'] = $this->_container->factory(function($c) {

        });
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