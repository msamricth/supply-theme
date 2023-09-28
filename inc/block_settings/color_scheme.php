<?php
/**
 * Block template file: inc/block_settings/color_scheme.php
 *
 * 
 * Configures the Background Color and Text Color (Color Scheme) when changed in Block Settings
 *
 * @package Supply Theme
 * @since v9
 */

if ( ! function_exists( 'get_container_scheme_function' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v8.0
	 */
	function get_container_scheme_function($containerColor, $text_color = null, $background_color = null) {
        $output = '';
        if($containerColor == "custom"){
            if (str_contains($background_color, "#")) {
                $background_color = $background_color;
            } else {
                $background_color = '#'. $background_color;
            }
            $output = randClassName();
            $styles = '.'.$output.'{background-color:'.$background_color.';';
            $output .= ' bg-custom';
            if(empty($text_color)){
                $rgb = HTMLToRGB($background_color);
                $hsl = RGBToHSL($rgb);
                if($hsl->lightness > 200) {
                // this is light colour!
                    $output .= ' text-primary';
                } else {
                    $output .= ' text-white';
                }
            } else {
                $styles .=' color:'.$text_color.';';
            }
            $styles .='}';
            enqueue_footer_styles($styles);
        } else {
            $output .= ' bg-' . $containerColor;
        }
		return $output;
    }

endif;

if ( ! function_exists( 'get_container_scheme' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function get_container_scheme() {
        $output = "";


        $containerColor = get_field( 'container_color' );
        $background_color = get_field( 'container_color_bg_color' );
        $text_color = get_field('container_color_custom_text_color');

        //container settings fieldgroup
        $container_settings = get_field('container_settings');
        if((empty($containerColor)) && ($container_settings)){
            $containerColor = get_field('container_settings_container_color');
            $background_color = get_field('container_settings_container_color_bg_color');
            $text_color = get_field('container_settings_container_color_custom_text_color');
        }
        
        //column_placement field group
        $column_placement = get_field('column_placement');
        if((empty($containerColor)) && ($column_placement)){
            $containerColor = get_field('column_placement_container_color');
            $background_color = get_field('column_placement_container_color_bg_color');
            $text_color = get_field('column_placement_container_color_custom_text_color');
        }

        //in aa row SUB field group
        if(empty($containerColor)){
            $containerColor = get_sub_field( 'container_color' );
            $background_color = get_sub_field( 'container_color_bg_color' );
            $text_color = get_sub_field('container_color_custom_text_color');
        }

        
        if($containerColor){$output = get_container_scheme_function($containerColor, $text_color, $background_color);}
		return $output;
    }

endif;