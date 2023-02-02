
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

//Supply Grid functions
function supply_grid($content, $defaults = null){
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
        if(get_sub_field( 'fold_color' )){
            $foldColorTrue = '';
            $foldColor = get_sub_field('fold_color');
            if(strpos($foldColor, 'page') !== false){
                if($scheme){
                    $foldColorTrue = $scheme;
                }
            } else {
                $foldColorTrue = $foldColor;
            }
            $foldClass = 'bg-' . $foldColorTrue;
            $foldUtils .=' data-class="'. $foldClass .'"';
            $fold = 'fold';
        }
        if(get_sub_field( 'custom_bg_color' )){
                $customColor = get_sub_field( 'custom_bg_color' );
                $customText = get_sub_field('custom_text_color');
                if($customText) {
                    $customText = 'data-color="'.$customText.'"';
                } else {
                    $customText = 'data-color="default"';
                }
                $fold .= ' fold-custom';
                $foldUtils .=' data-bg="'.$customColor.'" '. $customText;
        }
        if(empty($foldClass)){
           // call ajax function that records previous fold then runs to php function that updates fold acf field

        }
        if($foldUtils){
           $container .= '<div class="'.$fold.'" '.$foldUtils.'>';
        }
        $container .= '<div class="' . $row . '">';
        $container .= '<div class="' . $classes . '">';
            if($content) {$container .= $content; } else {
                $container .= '<h3>Something seems wrong here - this function requires the <i>"$content"</i> variable to have content</h3>';
            }
        $container .= '</div>';
        $container .= '</div>';
        
        if($foldUtils){
            $container .= '</div>';
        }
    } else { 
        $container = supply_grid_sh($content, $defaults);
    }
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
function project_title_fromBlock($post_id = null) {
    $current_post = get_queried_object();
    if(empty($post_id)){
        $post_id = $current_post ? $current_post->ID : null;
    } 
    $post   = get_post($post_id);
    $post_title = get_the_title($post_id);
	$blocks = parse_blocks( $post->post_content );
	foreach( $blocks as $block ) {
		if( 'acf/case-study-intro' !== $block['blockName'] )
			continue;
            if( !empty( $block['attrs']['data']['title_of_work_performed'] ) ){
			    $title = $block['attrs']['data']['title_of_work_performed'];
            } else {
                $title = $post_title;
            }
            
	}
    echo $title;
}
function customRatio($ratio) {
    if($ratio){
        $blockStyles = '';
        // Use preg_match_all() function to check match
        preg_match_all('!\d+\.*\d*!', $ratio, $ratiomatches);
        $i = 0;
        $ratioWidth = '';
        $ratioHeight = '';
        foreach ($ratiomatches as $ratiomatch) {
            foreach ($ratiomatch as $ratiom) {
                if ($i == 0) {
                    $ratioWidth = $ratiom;
                } else {
                    $ratioHeight = $ratiom;
                }
                $i++;
            }
        }
        if($ratiomatches){
            if(empty($ratioWidth)) {
                if(empty($ratioHeight)) {
                    if(strpos($ratio, '.') !== false){
                        list($ratioWidth, $ratioHeight) = preg_split("/x/",$ratio);
                        $ratioWidth = preg_replace("/[^0-9\.]/", '', $ratioWidth);
                    }
                }
            }
        }
        $presetRatios = array('21x9','16x9','4x3','3x2','fullw');
        if(strpos(implode(" ",$presetRatios), $ratio) !== false){} else {
            $ratio = str_replace('.', '\.', $ratio);
            $blockStyles .= '<style type="text/css">';
            $blockStyles .= '.ratio-'.$ratio.':before {';
            $blockStyles .= '  --bs-aspect-ratio: calc('.$ratioHeight.' / '.$ratioWidth.' * 100%);';
            $blockStyles .= '} </style>';
            echo $blockStyles;
        }
    }
}