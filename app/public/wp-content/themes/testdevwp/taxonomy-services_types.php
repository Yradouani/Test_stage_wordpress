<?php

/**
 * Template for displaying services for a specific service type.
 */

get_header(); ?>

<?php
// Get the current taxonomy term object
$term = get_queried_object();

// Set up a new query for the services that belong to this term
$args = array(
    'post_type' => 'services',
    'tax_query' => array(
        array(
            'taxonomy' => 'services_types',
            'field' => 'term_id',
            'terms' => $term->term_id,
        ),
    ),
    'orderby' => 'title',
    'order' => 'ASC'
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <div id="main-container" class="m-auto">
        <h1><?php echo single_term_title(); ?></h1>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="service-block" style="background: <?= (get_post_meta(get_the_ID(), 'color-service', true) ? get_post_meta(get_the_ID(), 'color-service', true) : "#080D0D") ?>;"><?php the_title(); ?></div>
        <?php endwhile;
        wp_reset_postdata();
        ?>
    </div>

<?php else : ?>

    <p>No services found for this type.</p>

<?php endif;

wp_reset_postdata();

get_footer(); ?>