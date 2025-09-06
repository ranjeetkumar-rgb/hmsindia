<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$environment = defined('ENVIRONMENT') ? ENVIRONMENT : 'development';

switch ($environment) {
    case 'production':
        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => 'localhost',
            'username' => 'hmsindiaivf',
            'password' => 'Hmsindia@2025',
            'database' => 'hmsindiaivf',
            'dbdriver' => 'mysqli',
            'dbprefix' => 'hms_',
            'pconnect' => FALSE,
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
        
    case 'staging':
        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => 'localhost',
            'username' => 'hmsuser',
            'password' => 'ranjeet@india',
            'database' => 'hms_database',
            'dbdriver' => 'mysqli',
            'dbprefix' => 'hms_',
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
    case 'development':
    default:
        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'hmsindiaivf',
            'dbdriver' => 'mysqli',
            'dbprefix' => 'hms_',
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
