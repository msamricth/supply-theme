<?php
/**
 * Block template file: templates/blocks/supply-split-block.php
 *
 * Supply Split Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-split-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$scheme = get_scheme('offerings');
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-split';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .= ' bottom-half';
if (! is_admin() ) { ?>


</div>
</div>
</div>
</div>
<?php } ?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo get_block_settings($classes) ?>">
<?php 
    if ( is_admin() ) {
    // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
    echo '<div style="text-align: center">Edit the settings for your Supply Split container in the right hand sidebar.</div>';
} 
?>
    <?php if(empty(get_field('turn_off_lines'))){ echo get_background_lines(); } ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-dlg-9 col-xl-8 offset-dlg-3 the-content">
                <InnerBlocks />
            </div>
        </div>
    </div>
</div>
<?php if (! is_admin() ) { ?>     
    <div class="top-half--continued <?php echo $scheme;?>">
        <div class="container">
            <div class="row">
                <div class="col-12 col-dlg-9 col-xl-8 offset-dlg-3 the-content">
<?php } ?>