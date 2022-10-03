
<?php
// Add to existing function.php file
//Supply Theme functions @extends ACF Blocks

function bg_pattern() {  
        if ( get_field( 'background_image', 'option' ) ) : ?>
            <style>
                .bg-pattern {
                    background-image: url('<?php the_field( 'background_image', 'option' ); ?>');
                }
            </style>
    <?php
        endif;
}
add_action('wp_head', 'bg_pattern', 100);
add_filter( 'excerpt_more', '__return_empty_string' ); 
function enqueue_footer_markup($markup){
	add_action('wp_footer', function () use ($markup){
		echo $markup;
	}, 99, 1);
}

//Supply Grid functions
function supply_grid($content, $defaults = null){
    $row = 'row';
    $classes = '';
    $breakpoint_aspect = '';
    $columns = ''; 
    $offset = '';
    $foldUtils = '';
    $container = '';
    $fullWidthAll = '';
    if ( have_rows( 'column_settings' ) ) : 
        while ( have_rows( 'column_settings' ) ) : the_row(); 
            if ( get_sub_field( 'full_width_content_container' ) == 1 ) : 
                $fullWidthAll = 1;
                $row .=' full-width-row';
            endif; 
            if ( have_rows( 'breakpoints_optional' ) ) : 
                while ( have_rows( 'breakpoints_optional' ) ) : the_row();
                $breakpoint_aspect = get_sub_field( 'breakpoint_aspect' ); 
                    if ( get_sub_field( 'hide_media' ) == 1 ) : 
                        // echo 'true'; 
                        $row .=' d-'. $breakpoint_aspect.'-none';
                    else : 
                    endif; 
                    $columns = get_sub_field( 'width_in_columns' ); 
                    $offset = get_sub_field( 'offset_in_columns' ); 
                    if(empty($fullWidthAll)){
                        if ( get_sub_field( 'full_width' ) == 1 ) : 
                            $row .=' full-width-row-'. $breakpoint_aspect;
                        else : 
                        endif;
                    }
                    if($columns) {
                        if(strpos($columns, 'container') !== false){
                            $classes .= ' col-' . $breakpoint_aspect . '-12';
                        } else {
                            $classes .= ' col-' . $breakpoint_aspect . '-' . $columns;
                            if($offset) {
                                if(strpos($offset, 'Center') !== false){
                                    $classes .= ' mx-'. $breakpoint_aspect .'-auto';
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
            if ( get_sub_field( 'add_fold' ) == 1 ) : 
                $row .= ' fold';
                if(get_sub_field( 'custom_bg_color' )){
                        $customColor = get_sub_field( 'custom_bg_color' );
                        $row .= ' fold-custom';
                        $foldUtils .= ' data-color="'. $customColor .'"';
                }
                if(get_sub_field( 'color' )){
                        $foldClass = get_sub_field( 'color' );
                        $foldUtils .=' data-class="'. $foldClass .'"';
                }
            endif; 
        endwhile;
        $container .= '<div class="' . $row . '"'.$foldUtils.'>';
        $container .= '<div class="' . $classes . '">';
            if($content) {$container .= $content; } else {
                $container .= '<h3>Something seems wrong here - this function requires the <i>"$content"</i> variable to have content</h3>';
            }
        $container .= '</div>';
        $container .= '</div>';
    else : 
        $container ."<h3>Something seems wrong here - this function requires for the fields for this component to define this function within a loop";
    endif; 
    return $container;
}
function supply_grid_sh($content, $defaults=null){
    $row = 'row';
    $classes = '';
    $container ='';
        if($defaults){
            $classes = $defaults;
        } else {
            $classes .= 'col-md-10 mx-auto col-dlg-12 col-xl-10';
        }
        $container .= '<div class="' . $row . '">';
        $container .= '<div class="' . $classes . '">';
            if($content) {$container .= $content; } else {
                $container .= '<h3>Something seems wrong here - this function requires the <i>"$content"</i> variable to have content</h3>';
            }
        $container .= '</div>';
        $container .= '</div>';

    return $container;
}