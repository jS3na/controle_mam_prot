<?php

defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = true;
$db['default'] = [
    'dsn' =>  '',
    'hostname' => '10.10.86.67',
    'username' =>  'root',
    'password' =>  'mamsoft4684',
    'database' => 'banco',
    'dbdriver' => 'mysqli',
    'dbprefix' =>  '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' =>  'utf8',
    'dbcollat' =>  'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => [],
    'save_queries' => true,
];