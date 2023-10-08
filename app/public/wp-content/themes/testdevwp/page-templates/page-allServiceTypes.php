<?php
/*
Template Name: Tous les types de services
*/
get_header();
?>
<div class="confirm-msg w-100 text-center">
    <h1 class="fw-bold"><?php the_title() ?></h1>
    <?php
    $terms = get_terms('services_types', array('hide_empty' => false));

    if (!empty($terms)) {
        echo '<div id="services-container" class="d-flex w-100 flex-wrap container"><div class="row w-100 d-flex justify-content-center">';
        foreach ($terms as $term) {
            $term_link = get_term_link($term);
            $imageId = get_term_meta($term->term_id, 'services_types_image', true);
            $image_style = '';
            if ($imageId) {
                $image_url = wp_get_attachment_image_src($imageId, 'thumbnail');
                if ($image_url) {
                    $image_style = 'background-image: url(' . esc_url($image_url[0]) . '); background-repeat: no-repeat; background-size: cover;';
                }
            } else {
                $image_style = 'background: #4AB7CD;';
            }
            echo '<a class="col-md-6 w-75 m-4 d-flex justify-content-center align-items-center text-white service-type-box" id="' . $term->slug . '" href="' . esc_url($term_link) . '" style="' . $image_style . '"><div><span class="version-title fw-bold">' . $term->name . '</span>';
            echo '</div></a>';
        }
        echo '</div></div>';
    }
    ?>
</div>
<?php get_footer(); ?>