<?php
/*
Template Name: Services
*/
get_header();
// Check search field 
$paged = get_query_var('paged') ?: 1;
$args = array(
    'post_type' => 'services',
    'posts_per_page' => 4,
    'order' => 'ASC',
    'orderby' => 'title',
    'paged' => $paged,
    // 'pagination_args' => '',
);
if (!empty($_POST['search'])) {
    $search_query = sanitize_text_field($_POST['search']);
    $args['s'] = $search_query;
}

$service_type = "";
if (!empty($_POST['service_type']) && $_POST['service_type'] !== 'all') {
    $service_type = sanitize_text_field($_POST['service_type']);
} else {
    $service_type = (get_query_var('service-type')) ?: "";
}

if (!empty($service_type)) {
    $args['tax_query'] = array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'services_types',
            'field' => 'slug',
            'terms' => $service_type,
        ),
    );
}
$services = new WP_Query($args);
?>

<!-- Display search and category filter form -->
<div id="search-container" class="w-75 m-auto">
    <form action="<?= get_permalink() ?>" method="post" class="d-flex justify-content-between p-3">
        <div class="d-flex flex-column w-25">
            <label for="search" class="mb-2">Votre recherche</label>
            <input type="search" name="search" id="search" placeholder="Recherche" class="p-2 search-border" value="<?php if (isset($_POST['search']) && $_POST['search'] !== "") {
                                                                                                                        echo $_POST['search'];
                                                                                                                    } ?>">
        </div>
        <div class="d-flex flex-column w-25 position-relative">
            <label for="category" class="mb-2">Catégories</label>
            <select name="service_type" id="category" class="p-2 bg-white custom-select search-border position-absolute bottom-0 w-100">
                <option value="all" <?php if (!isset($_POST['service_type']) || $_POST['service_type'] == "" && !get_query_var('service-type'))
                                        echo "selected" ?>>Tous les types de services</option>
                <option value="service-cool" <?php if ((isset($_POST['service_type']) && $_POST['service_type'] == "service-cool") || (get_query_var('service-type') == "service-cool"))
                                                    echo "selected" ?>>Service cool
                </option>
                <option value="service-fun" <?php if (isset($_POST['service_type']) && $_POST['service_type'] == "service-fun" || (get_query_var('service-type') == "service-fun"))
                                                echo "selected" ?>>Service fun
                </option>
                <option value="service-relou" <?php if (isset($_POST['service_type']) && $_POST['service_type'] == "service-relou" || (get_query_var('service-type') == "service-relou"))
                                                    echo "selected" ?>>Service relou
                </option>
            </select>
        </div>
        <div class="w-25 position-relative">
            <input type="submit" value="Rechercher" class="w-100 position-absolute bottom-0 border-0 text-white p-2 search-btn">
        </div>
    </form>
</div>
<?php

if ($services->have_posts()) {
    echo '<div id="services-container" class="d-flex w-75 flex-wrap container"><div class="row d-flex justify-content-center w-100 m-auto">';
    while ($services->have_posts()) {
        $services->the_post();
        $service_id = get_the_ID();
        $service_title = get_the_title();

        $terms = get_the_terms($service_id, 'services_types');
        echo '<a class="col-md-6 w-100 text-white service-box my-4" href="' . get_permalink() .
            '" style="background: ' . (get_post_meta(get_the_ID(), 'color-service', true) ? get_post_meta(get_the_ID(), 'color-service', true) : "#080D0D") . ';"><div><span class="version-title fw-bold">' . get_the_title() . '</span>';
        if ($terms && !is_wp_error($terms)) {
            echo '<span class="version-type fw-bold">Type : ';
            for ($i = 0; $i < count($terms); $i++) {
                if ($i >= 1) {
                    echo ', ';
                }
                echo $terms[$i]->name;
            }
            echo '</span>';
        }
        echo '</div></a>';
    }
    echo '</div></div>';
    wp_reset_postdata();

    // Display paginate
    paginate($services, $service_type);
} else {
    echo "<div class='text-center my-5 p-5'>Aucun résultat ne correspond à votre recherche</div>";
}
?>
<?php get_footer(); ?>