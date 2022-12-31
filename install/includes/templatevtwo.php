<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| GOJASA DATABASE STRUCT
|
| By Juwendi
| maswend.2020@gmail.com
| 08991585001
| -------------------------------------------------------------------
*/

$active_group = "default";
$active_record = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => "%HOSTNAME%",
	'username' => "%USERNAME%",
	'password' => "%PASSWORD%",
	'database' => "%DATABASE%",
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'development'),
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