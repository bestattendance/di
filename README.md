# Installation Instructions

## System Requirements
*(I usually use Vagrant with Puppet for running and configuring development environments)*
- PHP version **7.0** or higher installed and running
- MySQL version 5.5 or higher installed and running on localhost listening on the default MySQL port 3306
- [Composer](https://getcomposer.org/) is **installed globally**
- PHP has mbstring, openssl, pdo, dom, and intl extensions loaded and enabled.
- MySQL PDO driver is installed and enabled.

## INSTALLATION INSTRUCTIONS:
*(I usually use phing to automate builds and database migrations to manage schemas, but wanted to break this out for you to see how I build my projects manually)*

### Create the following database and user:
```
CREATE USER 'contactform'@'localhost' IDENTIFIED BY 'contactform';
CREATE DATABASE `contactform`;
GRANT ALL PRIVILEGES ON contactform.* TO 'contactform'@'localhost';
```


### Create the following database:

```
USE contactform;
CREATE TABLE IF NOT EXISTS `form_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `message` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### Install the application
- Clone the public git repository into a clean directory: `git clone git@github.com:bestattendance/dealerinspire.git .`
- Install dependencies: `composer install`












# Dealer Inspire PHP Code Challenge

Welcome to the Dealer Inspire PHP Code challenge. 
(reminder/note to self: insert some sort of cheering people image? maybe that's lame...)

## Getting Started

First thing's first - you'll need to fork this git repository to somewhere else. 
Make sure that your source code is publicly available in a git repository when 
you're done.  (Like Bitbucket or GitHub.  If you're super-nerdy and host your 
own public repo, just make sure the server is up 24/7 - our code-review monkeys
like to work in the middle of the night.)  

You don't have to host a working copy of the code, we'll be checking it out locally 
to review it.  That's a good reminder - we'll be testing your code by running the following
commands:

```
cd your-repo-checkout
phpunit
php -S 127.0.0.1:9999 -t public
```

Our working directory will be your git repo checkout.  We'll run PHPUnit in that directory.
If all the tests pass, we may browse to it using the built-in PHP server, expecting
your publicly browsable code in the `public` folder.

## What's Provided

We've provided this repository for you to fork.  Inside, you'll find a Bootstrap-based 
template HTML file with a placeholder for your challenge.  You are not expected to make any
design changes or add anything to the template.  However, we'd expect that the code challenge part
(it's a form) at least matches the style of this website. (The styling is built into the 
template.)

## The Challenge

Please create a contact form in the contact form page of the website template.  Your contact
form should contain the following required fields:

- Full Name
- Email
- Message

You should also have the following non-required fields:

- Phone

Once valid information is received from the form, two processes should occur.

First, email a copy of the contact request to `guy-smiley@example.com`

Second, keep a copy of the contact form in a database so that we can review the contact form later. 
You do not need to provide an interface to access that data (for example, there will be no admin login).

## Expectations

Your contact form should be in valid HTML in our template. It should match the style of the template.

Your back-end processing should be done in PHP. You may use a framework, or plain PHP - either is fine.

Your contact form data should be validated.

One copy of the data should be emailed to the owner (listed above).  You can choose either HTML or plaintext email (or a combination).
 
One copy of the data should be kept in a MySQL, MongoDB or Postgres database.

Some indication that the contact form has been sent should be given.

You should have PHPUnit-compatible unit tests for your application.

Provide either a database schema file or a programmatic way of creating your database / tables.
 
The completed work is available in a public git repository for us to checkout and review.