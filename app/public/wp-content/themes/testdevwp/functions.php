<?php

function testdevwp_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
}
add_action('after_setup_theme', 'testdevwp_supports');

function testdevwp_register_assets()
{
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style('load_css', get_theme_file_uri('/style.css'));
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false);
    wp_enqueue_style('bootstrap-cdn-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-cdn-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', 'jquery', false, true);

    if (is_page_template('page-templates/page-contact.php')) {
        wp_enqueue_script('contact-script', get_template_directory_uri() . '/dist/bundle.js', array('jquery', 'media-upload'), '1.0', true);
        wp_localize_script(
            'contact-script',
            'ajaxRequest',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'      => wp_create_nonce('testdevwp-nonce'),
                'pleaseWait' => esc_html__('Please wait...', 'testdevwp'),
                'readmore'   => esc_html__('Read more ...', 'testdevwp'),
                'readless'   => esc_html__('Read less ...', 'testdevwp'),
                'req'        => esc_html__('Please fill in required fields!', 'nrj-ingenierie'),
            )
        );
        wp_script_add_data('contact-script', 'type', 'module');
        wp_script_add_data('contact-script', 'defer', true);
    }
}
add_action('wp_enqueue_scripts', 'testdevwp_register_assets');

function testdevwp_register_admin_script()
{
    wp_enqueue_media();
    wp_enqueue_script('media-grid');
    wp_enqueue_script('media');
    wp_enqueue_script('admin-script', get_template_directory_uri() . '/dist/admin.js', array('jquery', 'media-upload'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'testdevwp_register_admin_script');

function paginate($services, $service_type)
{
    // Display paging
    if ($services->max_num_pages > 1) {
        echo '<nav aria-label="Page navigation w-75 example" class="paginate-nav">';
        echo '<ul class="pagination w-75 justify-content-center position-relative">';

        $prev_text = '<i class="fa-solid fa-chevron-left"></i>';
        $next_text = '<i class="fa-solid fa-chevron-right"></i>';

        $paged = get_query_var('paged') ?: 1;
        $big = 999999999;
        $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
        if (!empty($service_type) && (!stripos($base, '/services/service-type/' . $service_type))) {
            $base = str_replace('/page/', '/service-type/' . $service_type . '/page/', $base);
        }

        $paginate_links = paginate_links(array(
            'base' => $base,
            'format' => '/page/%#%',
            'current' => $paged,
            'total' => $services->max_num_pages,
            'prev_text' => $prev_text,
            'next_text' => $next_text,
            'mid_size' => 2,
            'type' => 'array'
        ));

        $page_numbers = '';
        $prev_link = '';
        $next_link = '';

        foreach ($paginate_links as $link) {
            if (strpos($link, 'prev') !== false) {
                $prev_link = '<li class="page-item prev position-absolute start-0">' . $link . '</li>';
            } elseif (strpos($link, 'next') !== false) {
                $next_link = '<li class="page-item next position-absolute end-0">' . $link . '</li>';
            } else {
                if (strpos($link, 'current') !== false) {
                    $link = str_replace('page-numbers', 'page-numbers current-page', $link);
                }
                $page_numbers .= '<li class="page-item">' . $link . '</li>';
            }
        }
        if ($prev_link !== "") {
            echo $prev_link;
        }
        echo '<div class="page-numbers-container"><ul class="pagination">' . $page_numbers . '</ul></div>';
        if ($next_link !== "") {
            echo $next_link;
        }

        echo '</ul>';
        echo '</nav>';
    }
}

/*--------------Custom message-----------*/
function add_cutom_message_in_menu()
{
    add_menu_page(
        'Message Display',
        'Message Display',
        'manage_options',
        'my-customization',
        'customization_message'
    );
}
add_action('admin_menu', 'add_cutom_message_in_menu');

add_image_size('service_thumbnail', 350, 350, ['center', 'center']);


/*----------------------send message-------------*/
function send_message()
{
    // get form data
    $firstname = wp_strip_all_tags($_POST['firstname']);
    $lastname = wp_strip_all_tags($_POST['lastname']);
    $email = ($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        wp_send_json_error(array('message' => esc_html__('Email invalid', 'testdevwp')));;
    }
    $parameters = vn_check_req_values(
        array(
            'firstname',
            'lastname',
            'email',
            'subject',
            'message'
        )
    );
    if (empty($parameters)) {
        wp_send_json_error(array('message' => esc_html__('Please fill in required fields!', 'testdevwp')));
    }

    $parameters['firstname'] = ucfirst($parameters['firstname']);
    $parameters['lastname'] = strtoupper($parameters['lastname']);

    //prefix all input names by "form_leads_" to have post meta key like this = form_leads_inputname
    $meta_input = array_combine(
        array_map(function ($key) {
            return 'form_leads_' . $key;
        }, array_keys($parameters)),
        $parameters
    );


    $sent_admin  = WP_Mail::init()
        ->to('yasmine.radouani@outlook.fr')
        ->from(sprintf('%1$s %2$s <%3$s>', $firstname, $lastname, $email))
        ->subject(esc_html__('Contact from your website', 'testdevwp'))
        ->template(
            get_template_directory() . '/inc/email-templates/template-contact.php',
            $parameters
        )
        ->send();

    if (!$sent_admin) {
        wp_send_json_error(array('message' => esc_html__('Error! Message was not sent! Please contact us by phone.', 'testdevwp')));
    } else {
        wp_send_json_success(array(
            'message' => esc_html__('Message successfully sent', 'testdevwp'),
            'redirect' => home_url('/confirmation/')
        ));
    }
}
add_action('wp_ajax_send_message', 'send_message');
add_action('wp_ajax_nopriv_send_message', 'send_message');

/**
 * Custom query vars to search program
 */
if (!function_exists('testdevwp_programs_query_vars')) {
    function testdevwp_programs_query_vars($query_vars)
    {
        $query_vars[] = 'service-type';
        $query_vars[] = 'paged';
        return $query_vars;
    }

    add_filter('query_vars', 'testdevwp_programs_query_vars');
}

if (!function_exists('testdevwp_programs_rewrite_rules')) {
    function testdevwp_programs_rewrite_rules()
    {

        $page_id = url_to_postid('/services/');

        add_rewrite_rule('^services/service-type/([^/]*)/page/([^/]*)/?', 'index.php?page_id=' . $page_id . '&service-type=$matches[1]&paged=$matches[2]', 'top');
        add_rewrite_rule('^services/service-type/([^/]*)/?', 'index.php?page_id=' . $page_id . '&service-type=$matches[1]', 'top');
        add_rewrite_rule('^services/page/([^/]*)/?', 'index.php?page_id=' . $page_id . '&paged=$matches[1]', 'top');
        // add_rewrite_rule('^services/service-type/([^/]*)/page/([^/]*)/?', 'index.php?service-type=$matches[1]&paged=$matches[2]', 'top');
    }
    add_action('init', 'testdevwp_programs_rewrite_rules', 10, 0);
}
flush_rewrite_rules();

/**
 * Custom taxonomies.
 */
require get_template_directory() . '/inc/taxonomies/init.php';

/**
 * Custom post types.
 */
require get_template_directory() . '/inc/post-types/init.php';

/**
 * Gutenberg blocks.
 */
require get_template_directory() . '/inc/gutenberg-blocks/init.php';

/**
 * Metaboxes.
 */
require get_template_directory() . '/inc/metaboxes/init.php';

/**
 * Visions Nouvelles functions.
 */
require get_template_directory() . '/inc/vn-functions.php';

/**
 * Classes
 */
require get_template_directory() . '/inc/classes/class-wp-mail.php';
