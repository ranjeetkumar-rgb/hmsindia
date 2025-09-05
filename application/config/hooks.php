<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

/*
| -------------------------------------------------------------------------
| Enable/Disable System Hooks
| -------------------------------------------------------------------------
*/
$hook['enable_hooks'] = TRUE;

/*
| -------------------------------------------------------------------------
| Pre System Hook
| -------------------------------------------------------------------------
| This hook runs before the system is initialized
*/
$hook['pre_system'] = array(
    'class'    => 'Session_fix_hook',
    'function' => '__construct',
    'filename' => 'session_fix.php',
    'filepath' => 'hooks'
);
