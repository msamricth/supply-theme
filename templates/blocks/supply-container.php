<?php
/**
 * Block template file: templates/blocks/supply-container.php
 *
 * Supply Container Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-container-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-container';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$subClasses = 'col-dlg-12';
$extras = '';
$extras .= get_padding($id) . ' ';
if(get_field('rm_subblock_padding')){
    $extras .='no-subblock-padding ';
}
$extras .= get_container_scheme();

$classes = esc_attr( $classes ) . ' ' . get_fold();
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo $classes; ?>">
<?php 
    if ( is_admin() ) {
    // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
    echo '<div style="text-align: center">Edit the settings for your Supply container in the right hand sidebar.</div>';
} 
$blockContent = '<InnerBlocks />';
echo supply_grid($blockContent, $subClasses, $extras);
?>


</div>