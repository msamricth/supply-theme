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

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-call-to-action';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .= ' fadeNoScroll';
$ctaTitle = get_field( 'cta_title' ); 
$cta_link = get_field( 'cta_link' ); 
$ctaCustumLinkText = get_field( 'cta_link_text' ); 
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="spacer cp4"></div>
    <?php get_template_part('templates/_cta', 'partials'); ?>
</div>