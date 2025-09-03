<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Configuration for Production Environment
|--------------------------------------------------------------------------
|
| This file contains email configuration settings specific to the
| production environment. These settings override the main config.php
| email settings when ENVIRONMENT is set to 'production'.
|
*/

// Production Email Settings (Live SMTP)
$config['mail_host'] = 'mail.indiaivf.website';
$config['mail_username'] = 'billings@indiaivf.website';
$config['mail_password'] = 'qYlSbaXXsn&9';
$config['mail_from_emailid'] = 'info@indiaivf.website';
$config['mail_from_name'] = 'IndiaIVF';
$config['mail_port'] = 587;
$config['mail_encryption'] = 'tls';
$config['mail_debug'] = false;

// Security settings for production
$config['mail_verify_peer'] = true;
$config['mail_verify_peer_name'] = true;
$config['mail_allow_self_signed'] = false;
