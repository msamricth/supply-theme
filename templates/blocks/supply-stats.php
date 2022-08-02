<?php
/**
 * Block template file: 
 *
 * Supply Stats Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-stats-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-stats';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'supply_stats' ) ) : ?>
        <div class="row">
            <?php while ( have_rows( 'supply_stats' ) ) : the_row(); ?>
                <div class="col-md">
                    <h4 class="stats">
                        <?php the_sub_field( 'number' ); ?>
                    </h4>
                    <p><?php the_sub_field( 'statement' ); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
	<?php else : ?>
		<?php // No rows found ?>
	<?php endif; ?>
</div>