<?php
/**
 * Block template file: templates/blocks/supply-media2-block.php
 *
 * Supply Media V2 Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-media-v2-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-media-a';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$INTLclasses ='supply-media ';
if (have_rows('media')):
    while (have_rows('media')):
        the_row();
        $video_ratio = get_sub_field('video_ratio');
        if (get_sub_field('make_full_screen') == 1):
            $INTLclasses .= "fullscreen_media";
        endif;
        if ( get_sub_field( 'dark_layout' ) == 1 ) : 
            $INTLclasses .= " dark_layout";
        endif; 
    endwhile;
endif;

$blockContent = '';
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php
    $blockContent .= '<div class="'.$INTLclasses.'">'.media_block_main().'</div>';


    if ( have_rows( 'column_placement' ) ) :
        while ( have_rows( 'column_placement' ) ) : the_row();
            echo supply_grid($blockContent, 'col-dlg-12');
        endwhile;
    endif;
    if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        echo '<button style="position: absolute;right: 10%;padding: 2rem;top: 20%;">Click here to edit this Media Block(v2) </button>';
    } 
?>
</div>