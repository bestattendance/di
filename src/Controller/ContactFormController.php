<?php

namespace ContactForm\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handles HTTP requests to the contact form page.
 *
 * Class ContactFormController
 * @package ContactForm\Controller
 */
class ContactFormController extends AppControllerAbstract
{

    public function showContactFormAction(Request $request)
    {
        /** @var $this->_container['twig'] Twig_Environment */
        return new Response($this->_container['twig']->render('/ContactForm/contact.twig', []));
    }
}