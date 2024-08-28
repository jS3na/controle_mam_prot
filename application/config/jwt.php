<?php

defined('BASEPATH') or exit('No direct script access allowed');


$config['jwt_key'] = $_ENV['API_JWT_KEY'];


$config['jwt_algorithm'] = 'HS256';


$config['token_expire_time'] = $_ENV['API_TOKEN_EXPIRE_TIME'];
