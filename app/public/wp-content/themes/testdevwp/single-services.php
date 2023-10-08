<?php get_header() ?>
<div id="main-container" class="m-auto">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $types = get_the_terms(get_the_ID(), 'services_types');
            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0];
    ?>
            <h1><?php the_title(); ?></h1>
            <?php
            if ($types) {
                echo '<div class="single-version-type">Type : ';
                for ($i = 0; $i < count($types); $i++) {
                    if ($i >= 1) {
                        echo ', ';
                    }
                    echo '<a href="' . esc_url(get_term_link($types[$i]->term_id)) . '">' . esc_html($types[$i]->name) . '</a>';
                }
                echo '</div>';
            }
            ?>
            <div id="content-container">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('service_thumbnail');
                } ?>
                <div class="single-service-description">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php if (get_post_meta(get_the_ID(), 'price-service', true)) { ?>
                <div id="service-price">Prix du service : <span><?= get_post_meta(get_the_ID(), 'price-service', true) ?>€</span></div>
            <?php
            } ?>
    <?php
        }
    }
    ?>
</div>

<?php get_footer() ?>