<?php
/**
 * Block template file: templates/blocks/supply-call-to-action.php
 *
 * Supply Logo Garden Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-call-to-action-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$post_id = '';
$current_post = get_queried_object();
$post_id = $current_post ? $current_post->ID : null;	
$scheme = get_field('background_color', $post_id);
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-call-to-action';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .= ' cp-4 fadeNoScroll';
$ctaTitle = get_field( 'cta_title' ); 
$cta_link = get_field( 'cta_link' ); 
$ctaCustumLinkText = get_field( 'cta_link_text' ); 

$foldUtils = '';
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo get_block_settings($classes) ?>">
    <?php get_template_part('templates/_cta', 'partials'); ?>
</div>