<?php
/**
 * Block template file: templates/blocks/supply-pagination-block.php
 *
 * Supply Pagination Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-pagination-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-pagination-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo get_block_settings($classes) ?>">
<?php  if (( get_post_type() === 'service-offerings' ) || (is_page( 'services' ))) {
        get_template_part('templates/blocks/_service-offerings-pagination');
    } else {
        get_template_part('templates/blocks/_case-study-pagination');
    
    } 
    if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        echo '<div style="text-align: center">Edit Pagination Block</div>';
    } 

    ?>
</div>