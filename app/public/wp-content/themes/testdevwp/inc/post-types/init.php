<?php

/**
 * Init custom post types.
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    exit();
}

/**
 * Init post types after WordPress loaded.
 */
function testdevwp_init_post_types()
{
    require get_template_directory() . '/inc/post-types/post-type-service.php';
}

add_action('init', 'testdevwp_init_post_types');
