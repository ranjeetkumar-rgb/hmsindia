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
$config['mail_host'] = 'smtp.gmail.com';
$config['mail_username'] = 'ranjeet.kumar@indiaivf.in';
$config['mail_password'] = 'mslzfkpcdefvytld';
$config['mail_from_emailid'] = 'ranjeet.kumar@indiaivf.in';
$config['mail_from_name'] = 'IndiaIVF (DEV)';
$config['mail_port'] = 587;
$config['mail_encryption'] = 'tls';
$config['mail_debug'] = true;

// Security settings for production
$config['mail_verify_peer'] = true;
$config['mail_verify_peer_name'] = true;
$config['mail_allow_self_signed'] = false;
