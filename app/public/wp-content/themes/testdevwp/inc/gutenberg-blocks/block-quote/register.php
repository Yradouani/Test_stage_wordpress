<?php

/**
 * Create Gutenberg Blocks with ACF Pro.
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    exit();
}
if (!function_exists('acf_register_block_type')) {
    return;
}

/**
 * Edit this fields:
 * $block_name
 * $block_slug
 * $block_icon
 * $block_keywords
 * $block_stuffs (Block fields.)
 * $mode (Optional)
 *
 * Don't edit this fields!
 * $block_unique_slug
 * $block_unique
 */

$block_name        = esc_html__('Citation', 'testdevwp');
$block_slug        = 'quote'; // Must be same with block folder but without block- prefix.
$block_icon        = '';
$block_keywords    = array('testdevwp', 'quote', 'citation');
$mode              = 'preview'; // preview or edit.
$block_unique_slug = 'testdevwp-' . $block_slug;
// $block_unique      = 'field_' . vn_sanitize_with_underscore( $block_unique_slug ) . '_'; // Unique must be real unique for all block fields. And must start with field_ prefix.
$block_unique      = 'field_' . sanitize_title($block_unique_slug) . '_'; // Unique must be real unique for all block fields. And must start with field_ prefix.
$block_stuffs      = array(
    array(
        'key'       => $block_unique . 'content_tab',
        'label'     => esc_html__('Content', 'testdevwp'),
        'type'      => 'tab',
        'placement' => 'top',
    ),
    array(
        'key'        => $block_unique . 'content',
        'name'       => 'content',
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => array(
            array(
                'key'   => $block_unique . 'texte',
                'label' => esc_html__('Texte', 'testdevwp'),
                'name'  => 'texte',
                'type'  => 'wysiwyg',
            ),
            array(
                'key'   => $block_unique . 'auteur',
                'label' => esc_html__('Auteur', 'testdevwp'),
                'name'  => 'auteur',
                'type'  => 'text',
            ),
        ),
    ),
);


/**
 * Register block.
 */
add_action(
    'acf/init',
    function () use ($block_unique_slug, $block_slug, $block_name, $block_icon, $block_keywords, $mode) {

        acf_register_block_type(
            array(
                'name'            => $block_unique_slug,
                'title'           => $block_name,
                'render_template' => get_template_directory() . '/inc/gutenberg-blocks/block-' . $block_slug . '/render.php',
                'category'        => 'testdevwp',
                'icon'            => $block_icon,
                'mode'            => $mode,
                'keywords'        => $block_keywords,
                'supports'        => array(
                    'align'    => array('wide', 'full'),
                    'anchor'   => true,
                    'html'     => false,
                    'multiple' => true,
                    'reusable' => false,
                ),
                'example'         => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array('preview' => get_template_directory_uri() . '/inc/gutenberg-blocks/block-' . $block_slug . '/preview.png'),
                    ),
                ),
            )
        );
    }
);


/**
 * Add block fields.
 */
add_action(
    'acf/init',
    function () use ($block_unique, $block_stuffs, $block_name, $block_unique_slug, $mode) {
        acf_add_local_field_group(
            array(
                'key'      => $block_unique . 'block',
                'title'    => $block_name,
                'fields'   => $block_stuffs,
                'location' => array(
                    array(
                        array(
                            'param'    => 'block',
                            'operator' => '==',
                            'value'    => 'acf/' . $block_unique_slug,
                        ),
                    ),
                ),
                'active'   => true,
            )
        );
    }
);
