<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Configuration for Testing Environment
|--------------------------------------------------------------------------
|
| This file contains email configuration settings specific to the
| testing environment. These settings override the main config.php
| email settings when ENVIRONMENT is set to 'testing'.
|
*/
// Looking to send emails in production? Check out our Email API/SMTP product!
# Looking to send emails in production? Check out our Email API/SMTP product!
// Testing Email Settings (using Mailtrap for testing)
$config['mail_host'] = 'sandbox.smtp.mailtrap.io';
$config['mail_username'] = '35b5a4c11a8dac';
$config['mail_password'] = 'a91ad51ab60d7c';
$config['mail_from_emailid'] = 'test@indiaivf.website';
$config['mail_from_name'] = 'IndiaIVF (TEST)';
$config['mail_port'] = 2525;
$config['mail_encryption'] = 'tls';
$config['mail_debug'] = true;
