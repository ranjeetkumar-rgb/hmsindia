<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Configuration for Development Environment
|--------------------------------------------------------------------------
|
| This file contains email configuration settings specific to the
| development environment. These settings override the main config.php
| email settings when ENVIRONMENT is set to 'development'.
|
*/
// Looking to send emails in production? Check out our Email API/SMTP product!
// Looking to send emails in production? Check out our Email API/SMTP product!

// Development Email Settings (using Mailtrap for testing)
$config['mail_host'] = 'smtp.gmail.com';
$config['mail_username'] = 'ranjeet.kumar@indiaivf.in';
$config['mail_password'] = 'mslzfkpcdefvytld';
$config['mail_from_emailid'] = 'ranjeet.kumar@indiaivf.in';
$config['mail_from_name'] = 'IndiaIVF (DEV)';
$config['mail_port'] = 587;
$config['mail_encryption'] = 'ssl';
$config['mail_debug'] = true;
