<?php

/**
 * Create taxonomy.
 * taxonomy: services_types
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    die();
}

$labels = array(
    'name' => 'Types de services',
    'singular_name' => 'Type de service',
    'search_items' => 'Rechercher des types de services',
    'all_items' => 'Tous les types de services',
    'parent_item' => 'Type de service parent',
    'parent_item_colon' => 'Type de service parent :',
    'edit_item' => 'Modifier le type de service',
    'update_item' => 'Mettre à jour le type de service',
    'add_new_item' => 'Ajouter un nouveau type de service',
    'new_item_name' => 'Nom du nouveau type de service',
    'menu_name' => 'Types de services',
);

$args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'public' => true,
    'rewrite' => array('slug' => 'services-types'),
    'show_in_rest' => true,
);

register_taxonomy('services_types', 'services', $args);

// Add image field to services_types during add term
function add_image_services_types_creation()
{
?>
    <div class="form-field d-flex">
        <label for="services_types_image"><?php esc_html_e('Image', 'text-domain'); ?></label>
        <input type="hidden" name="services_types_image" id="services_types_image" value="" />
        <button class="ms-4 mb-4 button button-primary services-types-image-upload" data-target="#services_types_image"><?php esc_html_e('Sélectionner une image', 'text-domain'); ?></button>
    </div>
<?php
}
add_action('services_types_add_form_fields', 'add_image_services_types_creation');

// Add image to services_types
function add_image_field_to_services_types_edit_form($term)
{
    $imageId = get_term_meta($term->term_id, 'services_types_image', true);
?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="services_types_image"><?php esc_html_e('Image', 'text-domain'); ?></label>
        </th>
        <td>
            <input type="hidden" name="services_types_image" id="services_types_image" value="<?php echo esc_attr($imageId); ?>" />
            <div id="update-img-container">
                <?php
                if (esc_attr($imageId)) {
                    echo wp_get_attachment_image($imageId, 'thumbnail', false, array('class' => 'services-types-image-preview', 'style' => 'width: 100%;'));
                }
                ?>
            </div>
            <button class="button button-primary services-types-image-upload" data-target="#services_types_image"><?php esc_html_e('Sélectionner une image', 'text-domain'); ?></button>
            <button class="button services-types-image-remove"><?php esc_html_e('Supprimer l\'image', 'text-domain'); ?></button>
        </td>
    </tr>
<?php
}
add_action('services_types_edit_form_fields', 'add_image_field_to_services_types_edit_form');

// Add custom column header
function add_services_types_column_header($columns)
{
    $columns['services_types_image'] = 'Photo';
    return $columns;
}
add_filter('manage_edit-services_types_columns', 'add_services_types_column_header');

// Add custom column content
function add_services_types_column_content($content, $column_name, $term_id)
{
    if ($column_name === 'services_types_image') {
        $imageId = get_term_meta($term_id, 'services_types_image', true);
        if (esc_attr($imageId)) {
            $content = wp_get_attachment_image($imageId, 'thumbnail', false, array('class' => 'services-types-image-preview', 'style' => 'width: 50px; height: auto !important; max-width: 100%;'));
        }
    }
    return $content;
}
add_filter('manage_services_types_custom_column', 'add_services_types_column_content', 10, 3);

function save_services_types_image($term_id)
{
    if (isset($_POST['services_types_image']) && $_POST['services_types_image'] !== '') {
        $image = sanitize_text_field($_POST['services_types_image']);
        update_term_meta($term_id, 'services_types_image', $image);
    } else {
        delete_term_meta($term_id, 'services_types_image');
    }
}
add_action('edited_services_types', 'save_services_types_image');

function save_services_types_image_new($term_id)
{
    error_log('save_services_types_image_new called');

    if (isset($_POST['services_types_image']) && '' !== $_POST['services_types_image']) {
        $image = sanitize_text_field($_POST['services_types_image']);
        $result = add_term_meta($term_id, 'services_types_image', $image, true);

        if (is_wp_error($result)) {
            error_log('Error saving services_types_image: ' . $result->get_error_message());
        }
    }
}
add_action('create_services_types', 'save_services_types_image_new');
