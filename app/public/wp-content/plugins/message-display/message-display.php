<?php
/*
Plugin Name: Message Display
Description: Display message above list of services.
*/

function customization_message()
{
    $text = get_option('my_custom_text', 'Lorem ipsum dolor sit amet.');
    $url = admin_url('admin-post.php?action=save_customization');

    echo '<form method="post" action="' . esc_url($url) . '" style="margin: 50px auto;text-align: center;">';
    echo '<div><label for="custom_text">Votre message d\'accueil :</label></div>';
    echo '<div>';
    wp_editor($text, 'custom_text', array(
        'media_buttons' => false,
        'textarea_rows' => 15,
        'textarea_cols' => 150,
        'teeny'         => true,
        'quicktags'     => true
    ));
    echo '</div>';
    echo '<div><input type="submit" value="Valider"></div>';
    echo '</form>';
}

function my_customization_save()
{
    if (isset($_POST['custom_text'])) {
        update_option('my_custom_text', $_POST['custom_text']);
    }
    wp_redirect(admin_url('admin.php?page=my-customization'));
    exit;
}
add_action('admin_post_save_customization', 'my_customization_save');
add_action('display_message', 'get_message');

function get_message()
{
?> <div id="home-description"><?php echo apply_filters('the_content', get_option('my_custom_text')); ?></div>
<?php
}
