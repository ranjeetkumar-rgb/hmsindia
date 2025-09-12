<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Production Environment Configuration
|--------------------------------------------------------------------------
|
| This file contains configuration settings specific to the production
| environment. These settings override the main config.php settings when
| ENVIRONMENT is set to 'production'.
|
*/

// Production-specific overrides
$config['base_url'] = getenv('BASE_URL') ?: 'https://infra.indiaivf.website/';
$config['log_threshold'] = 1; // Only errors in production
$config['cookie_secure'] = FALSE; // Disabled for HTTP access in production
$config['cookie_httponly'] = TRUE;
$config['csrf_protection'] = TRUE; // Enabled in production
$config['compress_output'] = TRUE;
$config['sess_expiration'] = 3600; // 1 hour in production
$config['sess_save_path'] = APPPATH . 'cache/sessions';

// Production email settings (if not already set in email.php)
$config['mail_debug'] = false;
