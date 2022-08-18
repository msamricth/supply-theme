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
$classes .=' fadeNoScroll';
$blockContent = '';
$i = 0;

$blockContent .= '<div id="'. esc_attr( $id ) .'" class="'. esc_attr( $classes ) .'">';
    if ( have_rows( 'supply_stats' ) ) : 
        $blockContent .= '<div class="row justify-content-between">';
            while ( have_rows( 'supply_stats' ) ) : the_row();
                $blockContent .= '<div class="col-md-4 px-md-0 col-xxl-3">';
                    $blockContent .= '<h4 class="stats">';
                        $blockContent .= get_sub_field( 'number' );
                    $blockContent .= '</h4>';
                    $blockContent .= '<p>'.get_sub_field( 'statement' ).'</p>';
                $blockContent .= '</div>';
                $i++;
            endwhile;
        $blockContent .= '</div>';
        else :
    endif;
$blockContent .= '</div>';
if ( have_rows( 'container_+_column_settings' ) ) :
    while ( have_rows( 'container_+_column_settings' ) ) : the_row();   
        echo supply_grid($blockContent, 'col-md-10 mx-auto col-dlg-12 col-xl-10');
    endwhile;
else:
    echo supply_grid_sh($blockContent, 'col-md-10 mx-auto col-dlg-12 col-xl-10');
endif;
?>

