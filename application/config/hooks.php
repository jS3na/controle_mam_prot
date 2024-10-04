<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}


// compress output
$hook['display_override'][] = [
    'class' => '',
    'function' => 'compress',
    'filename' => 'compress.php',
    'filepath' => 'hooks',
];

$hook['pre_system'][] = [
    'class' => 'WhoopsHook',
    'function' => 'bootWhoops',
    'filename' => 'whoops.php',
    'filepath' => 'hooks',
    'params' => [],
];

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */
