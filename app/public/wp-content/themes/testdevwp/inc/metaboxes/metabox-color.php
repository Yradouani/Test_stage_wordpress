<?php

/**
 * Color metaboxes.
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    exit();
}

function add_color_services()
{
    add_meta_box('add_color', 'Couleur du service', 'service_render_color', 'services', 'side');
}
function service_render_color()
{
    global $post;
    $color_service = get_post_meta($post->ID, 'color-service', true);
?>
    <div style="display: flex; flex-direction: column;">
        <label><input type="radio" name="color-service" value="#4AB7CD" <?php checked($color_service, "#4AB7CD"); ?>> Bleu</label>
        <label><input type="radio" name="color-service" value="#FFCE00" <?php checked($color_service, "#FFCE00"); ?>> Jaune</label>
        <label><input type="radio" name="color-service" value="#7DA44A" <?php checked($color_service, "#7DA44A"); ?>> Vert</label>
        <label><input type="radio" name="color-service" value="#080D0D" <?php checked($color_service, "#080D0D"); ?>> Noir</label>
        <label><input type="radio" name="color-service" value="#FF0000" <?php checked($color_service, "#FF0000"); ?>> Rouge</label>
    </div>
<?php
}

add_action('add_meta_boxes', 'add_color_services');

function save_service_color($post_id)
{
    if (array_key_exists('color-service', $_POST) && current_user_can('edit_post', $post_id)) {
        $color_service = $_POST['color-service'];
        update_post_meta($post_id, 'color-service', $color_service);
    }
}

add_action('save_post', 'save_service_color');
