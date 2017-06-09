<?php

use ContactForm\App;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

$app = new App();
$app->run(Request::createFromGlobals());