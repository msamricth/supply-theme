<?php
/**
 * Block template file: inc/core/wrapper.php
 *
 * 
 * Wrappers for each page type for the Supply Theme
 *
 * @package Supply Theme
 * @since v9
 */

if ( ! function_exists( 'supply_page_starter' ) ) :
	/**
	 * Constructs top of page structure for various Page Templates
	 *
	 * @since v4.5
	 */
    function supply_page_starter(){
        $output ='';
        $rowClasses ='';
        $column_class = '';
        $scheme = get_field('background_color');
        if ( get_field( 'dots_on' ) == 1 ) : 
            $foldData = 'bg-pattern';
        else:
            if($scheme){
                $foldData = 'bg-'. $scheme;
            } else {
                $foldData = 'bg-light';
            }
        endif;
        $rowClasses = 'row';
        if ( get_field( 'make_block_container_fold' ) == 1 ) : 
            $rowClasses .= ' fold" data-class="' . $foldData;
        endif;

            if ( get_field( 'full_width_page' ) == 1 ) : 
                $column_class = 'col-md-12 mx-auto';
            else : 
                $column_class = 'col-md-12 mx-auto col-dlg-12 col-xl-10';
            endif;
        
            $header_type =  get_field( 'header_type' );
            switch ( $header_type ) {
                case 'contact':
                    $column_class .= ' col-3xl-12 mx-3xl-0';
                    break;
                }           

        $output .='<div class="container">';
        $output .='<div class="'.$rowClasses.'">';
        $output .='<div class="'.$column_class.'">';

        if ( is_page_template( 'case-study.php' ) ) {
        
        } else if ( is_page_template( 'work.php' ) ) {
        } else if ( is_page_template( 'page-home.php' ) ) {
        } else {
            return $output;
        }


    }

endif;


if ( ! function_exists( 'supply_page_ending' ) ) :
	/**
	 * Constructs Bottom of page structure for various Page Templates
	 *
	 * @since v4.5
	 */
    function supply_page_ending(){
        $output ='';
        if ( is_page_template( 'page-full.php' ) ) {
            $output .='</div>';
        } else if ( is_page_template( 'page.php' ) ) {
            $output .='</div>';
            $output .='</div>';
            $output .='</div>';
            $output .='</div>';
        } else {
            $output .='</div>';
            $output .='</div>';
            $output .='</div>';
        }

        if ( is_page_template( 'case-study.php' ) ) {
        } else if ( is_page_template( 'work.php' ) ) {
        
        } else if ( is_page_template( 'page-home.php' ) ) {
        } else {
            echo $output;
        }
    }

endif;