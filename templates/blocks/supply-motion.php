<?php
/**
 * Block template file: template-parts/blocks/supply-motion.php
 *
 * Supply Media Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-motion-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$utils = '';
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-motion lottie-master-container';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$main_options_checked_values = get_field( 'main_options' );
$main_options = 'preserveAspectRatio="xMaxYMid meet" ';
if ( $main_options_checked_values ) :
	foreach ( $main_options_checked_values as $main_options_value ) :
        $main_options .= esc_html( $main_options_value ).' ';
	endforeach;
endif;
if(get_field( 'motion_background' )){
    $main_options .= 'background="'.get_field( 'motion_background' ).'" ';
} else {
    $main_options .= 'background="transparent" ';
}
if(get_field( 'speed' )){
    $main_options .= 'speed="'.get_field( 'speed' ).'"';
}

if ($main_options !== '' && str_contains($main_options, 'autoplay')) {
} else {
    $classes .= ' fold non-autoplay';
    $utils = 'data-class="bg-play-animation"';
}
$extras = '';
$extras .= get_container_scheme();
$blockContent = '';

if ($main_options !== '' && str_contains($main_options, 'controls')) {
    $style_output = '<style>#lottie-'. esc_attr( $id ).'{';
        if(get_field( 'toolbar_height' )){
            $style_output .= '--lottie-player-toolbar-height: '.get_field( 'toolbar_height' );
        }
        if(get_field( 'toolbar_background_color' )){
            $style_output .= '--lottie-player-toolbar-background-color: '.get_field( 'toolbar_background_color' );
        }
        if(get_field( 'toolbar_icon_color' )){
            $style_output .= '--lottie-player-toolbar-icon-color: '.get_field( 'toolbar_icon_color' );
        }
        if(get_field( 'toolbar_icon_hover_color' )){
            $style_output .= '--lottie-player-toolbar-icon-hover-color: '.get_field( 'toolbar_icon_hover_color' );
        }
        if(get_field( 'toolbar_icon_active_color' )){
            $style_output .= '--lottie-player-toolbar-icon-active-color: '.get_field( 'toolbar_icon_active_color' );
        }
        if(get_field( 'seeker_track_color' )){
            $style_output .= '--lottie-player-seeker-track-color: '.get_field( 'seeker_track_color' );
        }
        if(get_field( 'seeker_thumb_color' )){
            $style_output .= '--lottie-player-seeker-thumb-color: '.get_field( 'seeker_thumb_color' );
        }
    $style_output .= '}</style>';
    enqueue_footer_markup($style_output);  
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ).'" '.$utils; ?>">
    <?php
    if ( get_field( 'mobile_json' ) ) {
        $blockContent .= '<div class="d-md-none">';
        $blockContent .= '<lottie-player class="lottiedottie" id="lottie-'. esc_attr( $id ).'" src="'.get_field( 'mobile_json' ).'" '. $main_options .'>';
        $blockContent .= '</lottie-player>';
        $blockContent .= '</div>';
        
        if ( get_field( 'primary_json' ) ) :
            $blockContent .= '<div class="d-none d-md-block">';
            $blockContent .= '<lottie-player class="lottiedottie" id="lottie-'. esc_attr( $id ).'" src="'.get_field( 'primary_json' ).'" '. $main_options .'>';
            $blockContent .= '</lottie-player>';
            $blockContent .= '</div>';
        endif;
    } else {
        if ( get_field( 'primary_json' ) ) :
            $blockContent .= '<lottie-player  class="lottiedottie" id="lottie-'. esc_attr( $id ).'" src="'.get_field( 'primary_json' ).'" '. $main_options .'>';
            $blockContent .= '</lottie-player>';
        endif;
    }
    if ( have_rows( 'column_placement' ) ) :
        while ( have_rows( 'column_placement' ) ) : the_row();
            echo supply_grid($blockContent, 'col-dlg-12', $extras);
        endwhile;
    endif;
    if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        //echo '<button style="position: absolute;right: 10%;padding: 2rem;top: 20%;">Click here to edit this Media Block </button>';
        //echo '<script src="'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>';
    } 
?>
</div>
   