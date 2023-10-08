<?php

/**
 * Init custom taxonomies.
 *
 * @package testdevvwp
 */

if (!defined('ABSPATH')) {
    exit();
}

/**
 * Init post taxonomies WordPress loaded.
 */
function testdevvwp_init_taxonomies()
{
    require get_template_directory() . '/inc/taxonomies/services_types.php';
}

add_action('init', 'testdevvwp_init_taxonomies');
