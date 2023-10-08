<?php

/**
 * Init metaboxes.
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    exit();
}


require get_template_directory() . '/inc/metaboxes/metabox-color.php';
require get_template_directory() . '/inc/metaboxes/metabox-price.php';
require get_template_directory() . '/inc/metaboxes/metabox-image.php';
