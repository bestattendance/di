<?php

namespace ContactForm\Test;

use PHPUnit\Framework\TestCase;
use ContactForm\App;
use Pimple\Container;

/**
 * Class ContactFormTestCase
 * @package ContactForm\Test
 */
class ContactFormTestCase extends TestCase
{

    /**
     * In this case, we are using the same container for unit tests as we are for development, because no emailing
     * or database access will be tested.  If we were to test the email or database access functionality, we would
     * create mocks or a separate test database, and put that into the container instead.
     *
     * @var Container
     */
    protected $_container;

    /**
     * Initializes a new App instance.
     */
    public function setUp()
    {
        parent::setUp();

        // Get an initialized inversion of control container
        $app = new App();
        $this->_container = $app->getContainer();
    }
}