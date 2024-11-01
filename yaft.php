<?php
/*
Plugin Name: Yet Another Flickr Template
Plugin URI: http://lulabox.org
Description: Yet Another Flickr Template manager... what else? :)
Author: Luca Lulani
Version: 0.1
Author URI: http://lulabox.org
*/

$yaft_options_page = get_option('siteurl') . '/wp-admin/admin.php?page=yaft-yet-another-flickr-template/options.php';

function yaft_options() 
{
	add_options_page('YAFT', 'YAFT', 10, 'yaft-yet-another-flickr-template/options.php');
}

add_action('admin_menu', 'yaft_options');

require_once(dirname(__FILE__).'/classes.php');

$yaft_api_key = get_option('yaft_api_key');
$yaft_nsid = get_option('yaft_nsid');
$yaft_use_lightbox = get_option('yaft_use_lightbox');
$yaftFlickr = new YaftFlickr($yaft_api_key);

?>