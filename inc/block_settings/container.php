<?php
/**
 * Block template file: inc/block_settings/container.php
 *
 * 
 * Configures the container type, column width and offset in Block Settings
 *
 * @package Supply Theme
 * @since v9
 */

if ( ! function_exists( 'supply_grid' ) ) :
	/**
	 * Supply Grid  - Advance - functions
	 *
	 * @since v5 - updated v9
	 */


    function supply_grid($content, $defaults = null, $extras = null){
        $row = 'row';
        $classes = '';
        $post_id = '';
        $breakpoint_aspect = '';
        $columns = ''; 
        $offset = '';
        $foldUtils = '';
        $container = '';
        $fullWidthAll = '';
        $customText = '';
        $current_post = get_queried_object();
        $post_id = $current_post ? $current_post->ID : null;	
        $scheme = get_field('background_color', $post_id);
        $fold = '';
        if(empty($extras)){
        // $extras =  get_block_settings();
        } 
        if(str_contains($extras,'bypass')){
        //  $extras =  get_block_settings($extras);

        } else {
            if ( get_post_type() === 'service-offerings' ) { 
                $defaults = 'col-md-12';
            }
        }
        
    
        if ( have_rows( 'column_settings' ) ) { 
            while ( have_rows( 'column_settings' ) ) : the_row(); 
                if ( get_sub_field( 'full_width_content_container' ) == 1 ) : 
                    $fullWidthAll = 1;
                    $row .=' full-width-row';
                endif; 
                if ( have_rows( 'breakpoints_optional' ) ) : 
                    while ( have_rows( 'breakpoints_optional' ) ) : the_row();
                    $breakpoint_aspect = get_sub_field( 'breakpoint_aspect' ); 
                    $varBA = '';
                    if(strpos($breakpoint_aspect, 'xs') !== false){
                        $varBA = '-';
                    } else {
                        $varBA = '-'.$breakpoint_aspect.'-';
                    }
                        if ( get_sub_field( 'hide_media' ) == 1 ) : 
                            // echo 'true'; 
                            $row .=' d-'. $breakpoint_aspect.'-none';
                        else : 
                        endif; 
                        $columns = get_sub_field( 'width_in_columns' ); 
                        $offset = get_sub_field( 'offset_in_columns' ); 
                        if(empty($fullWidthAll)){
                            if ( get_sub_field( 'full_width' ) == 1 ) : 
                                $row .=' full-width-row-'. $breakpoint_aspect .' g'.$varBA.'0';
                            else : 
                            endif;
                        }
                        if($columns) {
                            if(strpos($columns, 'container') !== false){
                                $classes .= ' col-' . $breakpoint_aspect . '-12';
                            } else {
                                
                                if(strpos($breakpoint_aspect, 'xs') !== false){
                                    $classes .= ' col-' . $columns;
                                } else {
                                    $classes .= ' col-' . $breakpoint_aspect . '-' . $columns;
                                }
                                if($offset) {
                                    if(strpos($offset, 'Center') !== false){
                                        if(strpos($breakpoint_aspect, 'xs') !== false){
                                            $classes .= ' mx-auto';
                                        } else {
                                            $classes .= ' mx-'. $breakpoint_aspect .'-auto';
                                        }
                                    } else {
                                        $classes .= ' offset-'.$breakpoint_aspect. '-' . $offset;
                                    }
                                }
                            }
                        } else {
                            if($defaults){
                                $classes = $defaults;
                            } else {
                                $classes .= ' col-md-10 col-lg-8 mx-auto';
                            }
                        }
                    endwhile; 
                else : 
                    if($defaults){
                        $classes = $defaults;
                    } else {
                        $classes .= ' col-md-10 col-lg-8 mx-auto';
                    }
                endif; 
            endwhile;
            
            if(empty($foldClass)){
            // call ajax function that records previous fold then runs to php function that updates fold acf field

            }
            if($foldUtils){
            //   $container .= '<div class="'.$fold.'" '.$foldUtils.'>'; sunlighting fold inside the container
            }
            $container .= '<div class="' . $row . '">';
            $container .= '<div class="' . $classes . ' ' . $extras.'">';
                if($content) {$container .= $content; } else {
                    $container .= '<h3>Something seems wrong here - this function requires the <i>"$content"</i> variable to have content</h3>';
                }
            $container .= '</div>';
            $container .= '</div>';
            
            if($foldUtils){
            //   $container .= '</div>';
            }
        } else { 
            $container = supply_grid_sh($content, $defaults);
        }
        return $container;
        
        
    }
endif;
if ( ! function_exists( 'supply_grid_sh' ) ) :
	/**
	 * Supply Grid - Basic - functions
	 *
	 * @since v5 - updated v9
	 */


    function supply_grid_sh($content, $defaults=null, $extras=null){
        $row = 'row';
        $classes = '';
        $container ='';
            if($defaults){
                $classes = $defaults;
            } else {
                $classes .= 'col-md-10 mx-auto col-dlg-12 col-xl-10';
            }
            $container .= '<div class="' . $row . '">';
            $container .= '<div class="' . $classes . ' '.$extras. '">';
                if($content) {$container .= $content; } else {
                    $container .= '<h3>Something seems wrong here - this function requires the <i>"$content"</i> variable to have content</h3>';
                }
            $container .= '</div>';
            $container .= '</div>';

        return $container;
    }
endif;