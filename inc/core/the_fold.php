<?php
/**
 * Block template file: inc/core/the_fold.php
 *
 * 
 * Template functions for the fold
 *
 * @package Supply Theme
 * @since v9
 */

if ( ! function_exists( 'get_fold_classes' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v9.0
	 */
	function get_fold_classes($foldColor = null, $customColor = null) {
        
        $post_id = ''; 
        $output = '';
        $current_post = get_queried_object();
        $post_id = $current_post ? $current_post->ID : null;
        $classes = '';	
        $fold_off = get_field('fold_on', $post_id);
        if($foldColor){
            $classes .= 'fold'; 
        }else {
            if(empty($fold_off)) {
               // $classes .='fold';
            }
        }
        if($customColor){
            $classes .= ' fold-custom';
        }
		return $classes;
    }

endif;
if ( ! function_exists( 'get_fold_utilities' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v9.0
	 */
	function get_fold_utilities($foldColor = null, $customColor=null, $customText = null) {
        $foldUtils = '';
        $foldClass = '';
        $post_id = ''; 
        $output = '';
        $current_post = get_queried_object();
        $post_id = $current_post ? $current_post->ID : null;
        $scheme = get_field('background_color', $post_id);
        $fold_off = get_field('fold_on', $post_id);

        if($foldColor){
                
            if(strpos($foldColor, 'page') !== false){
                if($scheme){
                    $foldColor = $scheme;
                }
            }
            $foldClass = 'bg-' . $foldColor;
        }else {
            if(empty($fold_off)) {
                if($scheme){
              //      $foldClass ='bg-'. $scheme;
                } else {
                  //  $foldClass .='bg-light';
                }
            }
        }
        if($customColor){
            $foldUtils .= get_custom_fold($customColor, $customText);
        }
        $foldUtils .=' data-class="'. $foldClass;

		return $foldUtils;
    }

endif;
if ( ! function_exists( 'get_custom_fold' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v9.0
	 */
	function get_custom_fold($customColor=null, $customText = null) {
        if (str_contains($customColor, "#")) {
            $customColor = $customColor;
        } else {
            $customColor = '#'. $customColor;
        }
        if($customText) {
            $customText = 'data-color="'.$customText.'"';
        } else {
            $rgb = HTMLToRGB($customColor);
            $hsl = RGBToHSL($rgb);
            if($hsl->lightness > 200) {
            // this is light colour!
                $customText = 'data-color="#111512"';
            } else {
                $customText = 'data-color="#ffffff"';
            }
        }
        $output=' data-bg="'.$customColor.'" '. $customText;
		return $output;
    }

endif;
if ( ! function_exists( 'get_fold' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function get_fold($foldColor = null, $foldOnly = null, $utilityOnly = null) {
        $foldUtils = '';
        $classes = '';
        $foldColor = get_field( 'fold_color' );
        $customColor = get_field( 'custom_bg_color' );
        $customText = get_field('custom_text_color');

        //container settings fieldgroup
        $container_settings = get_field('container_settings');
        if((empty($foldColor)) && ($container_settings)){
            $foldColor = get_field('container_settings_fold_color');
            $customColor = get_field('container_settings_custom_bg_color');
            $customText = get_field('container_settings_custom_text_color');
        }

        //fold_settings field group
        $fold_settings = get_field('fold_settings');
        if((empty($foldColor)) && ($fold_settings)){
            $foldColor = get_field('fold_settings_fold_color');
            $customColor = get_field('fold_settings_custom_bg_color');
            $customText = get_field('fold_settings_custom_text_color');
        }

        //column_placement field group
        $column_placement = get_field('column_placement');
        if((empty($containerColor)) && ($column_placement)){
            $foldColor = get_field('column_placement_fold_color');
            $customColor = get_field('column_placement_custom_bg_color');
            $customText = get_field('column_placement_custom_text_color');
        }

        //in aa row SUB field group
        if(empty($foldColor)){
            $foldColor = get_sub_field( 'fold_color' );
            $customColor = get_sub_field( 'custom_bg_color' );
            $customText = get_sub_field('custom_text_color');
        }
        $classes = get_fold_classes($foldColor, $customColor);
        $foldUtils =  get_fold_utilities($foldColor, $customColor, $customText);
        if($foldOnly){
            $output = $classes;
        }
        if($utilityOnly){
            $output = $foldUtils;
        }
        if(empty($foldOnly) && empty($utilityOnly)) {
            $output = $classes .'" '.$foldUtils;
        }
		return $output;
    }

endif;