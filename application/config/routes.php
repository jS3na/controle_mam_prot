<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}


$route['default_controller'] = 'mapos';
$route['404_override'] = '';

// Rotas da API
if (filter_var($_ENV['API_ENABLED'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
    require APPPATH . 'config/routes_api.php';
}

/* End of file routes.php */
/* Location: ./application/config/routes.php */
