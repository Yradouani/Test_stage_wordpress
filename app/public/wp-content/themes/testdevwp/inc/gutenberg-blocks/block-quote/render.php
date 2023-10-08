<?php

/**
 * Block template.
 *
 * @package testdevwp
 */

if (!defined('ABSPATH')) {
    die();
}

/**
 * Block slug.
 * Will use on class names.
 */
$block_slug = 'quote';

/**
 * Don't edit this.
 * Editor preview image in Gutenberg screen.
 */
// if ( $preview = get_field( 'preview' ) ) {
// 	echo '<img src="' . esc_url( $preview ) . '" alt="Preview" style="width: 100%; height: auto;">';

// 	return;
// }

$content = get_field('content');

if (!empty($content['texte'])) :
?>
    <div class="<?php echo $block_slug; ?>">
        <blockquote><?php echo $content['texte']; ?></blockquote>
        <?php if (!empty($content['auteur'])) : ?>
            <cite><?php echo $content['auteur']; ?></cite>
        <?php endif; ?>
    </div>
<?php endif; ?>