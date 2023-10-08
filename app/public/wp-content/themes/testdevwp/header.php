<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>
    <header class="d-flex align-items-center justify-content-center 
    <?php
    if (is_front_page()) {
        echo 'header-home';
    } else if (is_tax('services_types') || is_page('services')) {
        echo 'service-type-header';
    } else {
        echo 'header-contact';
    }
    ?>" <?php if (is_singular('services')) echo 'style="background: ' . (get_post_meta(get_the_ID(), 'color-service', true) ? get_post_meta(get_the_ID(), 'color-service', true) : "#080D0D") . '"'; ?>>
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/VN.svg" alt="Logo"></a>
    </header>