<?php

/**
 * Price metaboxes.
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    exit();
}

/* Add service price */
function add_price_services()
{
    add_meta_box('add_price', 'Prix du service en €', 'service_render_price', 'services', 'side');
}

function service_render_price()
{
    global $post;
    $price_service = get_post_meta($post->ID, 'price-service', true);
?>
    <input type="number" id="price-service" name="price-service" value="<?php echo $price_service; ?>">
<?php
}

add_action('add_meta_boxes', 'add_price_services');

function save_service_price($post_id)
{
    if (array_key_exists('price-service', $_POST) && current_user_can('edit_post', $post_id)) {
        $price_service = $_POST['price-service'];
        update_post_meta($post_id, 'price-service', $price_service);
    }
}

add_action('save_post', 'save_service_price');
