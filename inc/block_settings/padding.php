<?php
/**
 * Block template file: inc/block_settings/padding.php
 *
 * 
 * Configures the padding for each block when the Padding is changed in Block Settings
 *
 * @package Supply Theme
 * @since v9
 */

if ( ! function_exists( 'get_padding_function' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v8.5
	 */
	function get_padding_function($blockID = null) {
        $style = '';
        $style_output = '';
        $output = '';
        
        $identifer = '.' . $blockID;
        if ( have_rows( 'custom_top' ) ) : 
            while ( have_rows( 'custom_top' ) ) : the_row(); 
                if ( have_rows( 'breakpoint_overrides' ) ) : 
                    while ( have_rows( 'breakpoint_overrides' ) ) : the_row(); 
                        $style_output.= '@media (min-width:  '.get_sub_field( 'breakpoint' ).' ){';
                        $style_output.= $identifer . '.cp-t-custom {--supply-padding-custom: '.get_sub_field( 'custom_size' ).'px;}';
                        $style_output.= '}';
                    endwhile; 
                endif; 
            endwhile; 
        endif; 
        if ( have_rows( 'custom_bottom' ) ) :  
            while ( have_rows( 'custom_bottom' ) ) : the_row(); 
                if ( have_rows( 'breakpoint_overrides' ) ) : 
                    while ( have_rows( 'breakpoint_overrides' ) ) : the_row(); 
                        $style_output.= '@media (min-width:  '.get_sub_field( 'breakpoint' ).' ){';
                        $style_output.= $identifer . '.cp-b-custom {--supply-padding-custom: '.get_sub_field( 'custom_size' ).'px;}';
                        $style_output.= '}';
                    endwhile; 
                endif; 
            endwhile;  
        endif;
        return $style_output;
        
    }

endif;
if ( ! function_exists( 'get_padding' ) ) :

	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v6.5
	 */
	function get_padding($blockID = null) {
        $output = '';
      //  $padding_size = get_field( 'padding_size' ); 
        $padding_top = get_field('padding_top');
        $padding_bottom = get_field('padding_bottom');

        //container settings fieldgroup
        $container_settings = get_field('container_settings');
        if((empty($padding_top)) && ($container_settings)){
            $padding_top = get_field('container_settings_padding_top');
        }
        if((empty($padding_bottom)) && ($container_settings)){
            $padding_bottom = get_field('container_settings_padding_bottom');
        }


        //fold_settings field group
        $fold_settings = get_field('fold_settings');
        if((empty($padding_top)) && ($fold_settings)){
            $padding_top = get_field('fold_settings_padding_top');
        }
        if((empty($padding_bottom)) && ($fold_settings)){
            $padding_bottom = get_field('fold_settings_padding_bottom');
        }

        //column_placement field group
        $column_placement = get_field('column_placement');
        if((empty($padding_top)) && ($column_placement)){
            $padding_top = get_field('column_placement_padding_top');
        }
        if((empty($padding_bottom)) && ($column_placement)){
            $padding_bottom = get_field('column_placement_padding_bottom');
        }



        if((empty($padding_top)) && (empty($padding_bottom))){
            
            if ( have_rows( 'container_settings' ) ):
                while ( have_rows( 'container_settings' ) ) : the_row();
                    $padding_top = get_sub_field('padding_top');
                    $padding_bottom = get_sub_field('padding_bottom');
                    if(($padding_top == 'cp-t-custom') || ($padding_bottom == 'cp-b-custom')) {
                         if(empty($blockID)){
                             $blockID = 'cp-'.randClassName();
                             $output .= $blockID . ' ';
                         }
                    }
                    $custom_padding = get_padding_function($blockID);
                endwhile;
            else:
                if ( have_rows( 'column_placement' ) ):
                    while ( have_rows( 'column_placement' ) ) : the_row();
                        $padding_top = get_sub_field('padding_top');
                        $padding_bottom = get_sub_field('padding_bottom');
                        if(($padding_top == 'cp-t-custom') || ($padding_bottom == 'cp-b-custom')) {
                             if(empty($blockID)){
                                 $blockID = 'cp-'.randClassName();
                                 $output .= $blockID . ' ';
                             }
                        }
                        $custom_padding = get_padding_function($blockID);
                    endwhile;
                endif;

                
            endif;
        }
        
        if(empty($padding_top)){
            $padding_top = get_sub_field('padding_top');
        }
        if(empty($padding_bottom)){
            $padding_bottom = get_sub_field('padding_bottom');
        }
        if(empty($custom_padding)){
            if(($padding_top == 'cp-t-custom') || ($padding_bottom == 'cp-b-custom')) {
                if(empty($blockID)){
                     $blockID = 'cp-'.randClassName();
                     $output .= $blockID . ' ';
                 }
            }
            $custom_padding = get_padding_function($blockID);
        }
        if($padding_top){
            $output .= $padding_top.' ';
        }
        if($padding_bottom){
            $output .= $padding_bottom;
        }
        
        if(($padding_top == 'cp-t-custom') || ($padding_bottom == 'cp-b-custom')) {
            enqueue_footer_styles($custom_padding);
        }
        
		return $output;
    }

endif;