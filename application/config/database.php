<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Database Configuration
|--------------------------------------------------------------------------
|
| This file contains the database configuration for different environments.
| The configuration is based on environment variables for security.
|
*/

// Get environment from environment variable or default to development
$environment = getenv('ENVIRONMENT') ?: 'development';

$active_group = 'default';
$query_builder = TRUE;
switch ($environment) {
    case 'production':
        // Production database configuration
        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => getenv('DB_HOST') ?: '139.84.175.208',
            'username' => getenv('DB_USER') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: 'root',
            'database' => getenv('DB_NAME') ?: 'stagin_hms_db',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => TRUE,
            'db_debug' => FALSE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
        
    case 'development':
    default:
        // Development database configuration
        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => getenv('DB_HOST') ?: 'localhost',
            'username' => getenv('DB_USER') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: '',
            'database' => getenv('DB_NAME') ?: 'hmsindiaivf_dev',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => TRUE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
}
