<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * App current version
 */
$config['app_version'] = '4.47.0';

/**
 * Nome do sistema
 */
$config['app_name'] = 'ManTech';

/**
 * Descrição do sistema
 */
$config['app_subname'] = $_ENV['APP_SUBNAME'] ?? 'Sistema de Controle de Ordens de Serviço';

/**
 * Definição da hora local.
 */
date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo');


$config['base_url'] = $_ENV['APP_BASEURL'] ?? 'http://localhost/os/';

//$config['base_url'] = 'http:/home/vol10_1/infinityfree.com/if0_37196295/';


$config['index_page'] = 'index.php';


$config['uri_protocol'] = 'REQUEST_URI';


$config['url_suffix'] = '';


$config['language'] = 'english';


$config['charset'] = $_ENV['APP_CHARSET'] ?? 'UTF-8';


$config['enable_hooks'] = true;


$config['subclass_prefix'] = 'MY_';


$config['composer_autoload'] = true;


$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';


$config['enable_query_strings'] = false;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';


$config['allow_get_array'] = true;

$config['log_threshold'] = 1;


$config['log_path'] = '';


$config['log_file_extension'] = '';


$config['log_file_permissions'] = 0644;


$config['log_date_format'] = 'Y-m-d H:i:s';


$config['error_views_path'] = '';


$config['cache_path'] = '';


$config['cache_query_string'] = false;

$config['encryption_key'] = $_ENV['APP_ENCRYPTION_KEY'];


$config['sess_driver'] = $_ENV['APP_SESS_DRIVER'] ?? 'database';
$config['sess_cookie_name'] = $_ENV['APP_SESS_COOKIE_NAME'] ?? 'app_session';
$config['sess_expiration'] = $_ENV['APP_SESS_EXPIRATION'] ?? 7200;
$config['sess_save_path'] = $_ENV['APP_SESS_SAVE_PATH'] ?? 'ci_sessions';
$config['sess_match_ip'] = isset($_ENV['APP_SESS_MATCH_IP']) ? filter_var($_ENV['APP_SESS_MATCH_IP'], FILTER_VALIDATE_BOOLEAN) : false;
$config['sess_time_to_update'] = $_ENV['APP_SESS_TIME_TO_UPDATE'] ?? 300;
$config['sess_regenerate_destroy'] = isset($_ENV['APP_SESS_REGENERATE_DESTROY']) ? filter_var($_ENV['APP_SESS_REGENERATE_DESTROY'], FILTER_VALIDATE_BOOLEAN) : false;


$config['cookie_prefix'] = $_ENV['APP_COOKIE_PREFIX'] ?? '';
$config['cookie_domain'] = $_ENV['APP_COOKIE_DOMAIN'] ?? '';
$config['cookie_path'] = $_ENV['APP_COOKIE_PATH'] ?? '/';
$config['cookie_secure'] = isset($_ENV['APP_COOKIE_SECURE']) ? filter_var($_ENV['APP_COOKIE_SECURE'], FILTER_VALIDATE_BOOLEAN) : false;
$config['cookie_httponly'] = isset($_ENV['APP_COOKIE_HTTPONLY']) ? filter_var($_ENV['APP_COOKIE_HTTPONLY'], FILTER_VALIDATE_BOOLEAN) : false;


$config['csrf_protection'] = isset($_ENV['APP_CSRF_PROTECTION']) ? filter_var($_ENV['APP_CSRF_PROTECTION'], FILTER_VALIDATE_BOOLEAN) : true;
$config['csrf_token_name'] = $_ENV['APP_CSRF_TOKEN_NAME'] ?? 'MAPOS_TOKEN';
$config['csrf_cookie_name'] = $_ENV['APP_CSRF_COOKIE_NAME'] ?? 'MAPOS_COOKIE';
$config['csrf_expire'] = $_ENV['APP_CSRF_EXPIRE'] ?? 7200;
$config['csrf_regenerate'] = isset($_ENV['APP_CSRF_REGENERATE']) ? filter_var($_ENV['APP_CSRF_REGENERATE'], FILTER_VALIDATE_BOOLEAN) : true;
$config['csrf_exclude_uris'] = ['api.*+'];


$config['compress_output'] = isset($_ENV['APP_COMPRESS_OUTPUT']) ? filter_var($_ENV['APP_COMPRESS_OUTPUT'], FILTER_VALIDATE_BOOLEAN) : false;


$config['time_reference'] = $_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo';


$config['proxy_ips'] = $_ENV['APP_PROXY_IPS'] ?? '';


$config['global_xss_filtering'] = $_ENV['GLOBAL_XSS_FILTERING'] ? filter_var($_ENV['GLOBAL_XSS_FILTERING'], FILTER_VALIDATE_BOOLEAN) : true;
