<?php
get_header()
?>
<div id="main-container" class="m-auto">
    <h1><?php the_title() ?></h1>
    <?php do_action('display_message'); ?>
    <p id="home-text" class="fw-bold">Cliquez sur le domaine qui vous correspond :</p>
    <?php
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    );
    $services = new WP_Query($args);
    if ($services->have_posts()) {
        echo '<div id="services-container" class="d-flex w-100 flex-wrap container"><div class="row">';
        while ($services->have_posts()) {
            $services->the_post();
            $service_id = get_the_ID();
            $terms = get_the_terms($service_id, 'services_types');
            echo '<a class="col-md-6 text-white" id="' . get_post_field('post_name', get_the_ID()) . '" href="' . get_permalink() .
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
    }
    ?>
    <div class="d-flex justify-content-center flex-column align-items-center my-3">
        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="fw-bold fs-5">
            Tous les services
        </a>
        <a href="<?php echo esc_url(home_url('/services-types/')); ?>" class="fw-bold fs-5">
            Tous les types de services
        </a>
    </div>
    <div id="quote">
        <!-- consectetur adipiscing elit. Nunc convallis sem eu scelerisque bibendum. Sed bibendum auctor libero porttitor dignissim. Curabitur id nisi convallis, porta mauris vitae, ultricies nunc. Ut suscipit faucibus tempus. Aenean magna felis, sodales eleifend metus consectetur, bibendum interdum nunc.
        <span>Pierre qui roule n’amasse pas mousse.</span>
        <div id="author">Alexis JUSKIWIESKI</div> -->
        <?php the_content(); ?>
    </div>
</div>
<?php get_footer() ?>