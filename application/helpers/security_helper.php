<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * 
 *
 *
 * @author		
 * @copyright	
 * @license		
 *
 * @link		
 * @since		
 *
 * @f
 */

// ------------------------------------------------------------------------

/**
 * 
 *
 * @category	Helpers
 *
 * @author		
 *
 * @link		
 */

// ------------------------------------------------------------------------

/**
 * XSS Filtering
 *
 * @param	string
 * @param	bool	whether or not the content is an image file
 * @return string
 */
if (! function_exists('xss_clean')) {
    function xss_clean($str, $is_image = false)
    {
        $CI = &get_instance();

        return $CI->security->xss_clean($str, $is_image);
    }
}

// ------------------------------------------------------------------------

/**
 * Sanitize Filename
 *
 * @param	string
 * @return string
 */
if (! function_exists('sanitize_filename')) {
    function sanitize_filename($filename)
    {
        $CI = &get_instance();

        return $CI->security->sanitize_filename($filename);
    }
}

// --------------------------------------------------------------------

/**
 * Hash encode a string
 *
 * @param	string
 * @return string
 */
if (! function_exists('do_hash')) {
    function do_hash($str, $type = 'sha1')
    {
        if ($type == 'sha1') {
            return sha1($str);
        } else {
            return md5($str);
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Strip Image Tags
 *
 * @param	string
 * @return string
 */
if (! function_exists('strip_image_tags')) {
    function strip_image_tags($str)
    {
        $str = preg_replace("#<img\s+.*?src\s*=\s*[\"'](.+?)[\"'].*?\>#", '\\1', $str);
        $str = preg_replace("#<img\s+.*?src\s*=\s*(.+?).*?\>#", '\\1', $str);

        return $str;
    }
}

// ------------------------------------------------------------------------

/**
 * Convert PHP tags to entities
 *
 * @param	string
 * @return string
 */
if (! function_exists('encode_php_tags')) {
    function encode_php_tags($str)
    {
        return str_replace(['<?php', '<?PHP', '<?', '?>'], ['&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'], $str);
    }
}

/* End of file security_helper.php */
/* Location: ./system/helpers/security_helper.php */
