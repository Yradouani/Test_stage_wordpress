<?php

/**
 * Create agency custom post type.
 * post_type: Service
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    die();
}

$labels = array(
    'name' => 'Services',
    'singular_name' => 'Service',
    'menu_name' => 'Services',
    'all_items' => 'Tous les services',
    'add_new' => 'Ajouter un nouveau service',
    'add_new_item' => 'Ajouter un nouveau service',
    'edit_item' => 'Modifier le service',
    'new_item' => 'Nouveau service',
    'view_item' => 'Voir le service',
    'search_items' => 'Rechercher des services',
    'not_found' => 'Aucun service trouvé',
    'not_found_in_trash' => 'Aucun service trouvé dans la corbeille',
    'parent_item_colon' => '',
);

$args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => false,
    'rewrite' => array('slug' => 'services'),
    'menu_position' => 5,
    'menu_icon' => 'dashicons-book-alt',
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'show_in_rest' => true,
    'taxonomies' => ['services_types']
);

register_post_type('services', $args);

/*Refresh permalink - remove on production*/
flush_rewrite_rules();
