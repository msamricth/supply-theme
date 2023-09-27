<?php
/**
 * Block template file: templates/blocks/supply-separator-block.php
 *
 * Supply Separator Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-separator-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-separator-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .= " ";
$blockContent = '';
$extras = get_block_settings();
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo get_block_settings('supply-separator-block'); ?>">
    <?php
    $blockContent .='<div class="'. esc_attr( $classes ) .'"></div>';
    if ( have_rows( 'container_settings' ) ) : 
        while ( have_rows( 'container_settings' ) ) : the_row(); 
                
            echo supply_grid($blockContent, 'col-dlg-12 fadeNoScroll');
        endwhile;
    else:
        echo supply_grid_sh($blockContent, 'col-dlg-12 fadeNoScroll');
    endif;
    if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        echo '<div style="text-align: center">This is where a spacer would display on the front-end. <a>Click here to change this.</a></div>';
    } 
    ?>
</div>