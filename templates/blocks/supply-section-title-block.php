<?php
/**
 * Block template file: templates/blocks/supply-section-title-block.php
 *
 * Supply Section Title Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-section-title-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-section-title-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$section_title = get_field('section_title');
$section_ID = get_field('section_id');

if(empty($section_ID)){
    $section_ID = slugify($section_title);
}
?>
<div id="<?php echo esc_attr( $section_ID ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="section-title left-offset d-flex" id="<?php echo esc_attr( $id ); ?>">
        <div class="vr-line"></div>
        <h5><?php echo $section_title; ?></h5>
    </div>
</div>