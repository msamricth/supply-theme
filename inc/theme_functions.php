
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
    $title = '';
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
            $blockStyles .= '.'.$ratio.':before, .ratio-'.$ratio.':before {';
            $blockStyles .= '  --bs-aspect-ratio: calc('.$ratioHeight.' / '.$ratioWidth.' * 100%);';
            $blockStyles .= '} </style>';
            return $blockStyles;
        }
    }
}
function get_header_media(){
    $post_id = '';
    $current_post = get_queried_object();
    $post_id = $current_post ? $current_post->ID : null;
    $header_media = '';
    $mobile_ratio = '';
    $video_ratio = '';
    $classes = '';
    $self_host_video = '';
    $video_ratio = '';
    $header_video = '';
    $placerholder = '';
    $mobile_ratio = '';
    $header_video_mobile = '';
    $mobileplaceholder	 = '';
    $video_lg ='';
    $video_lg_ratio ='';
    $video_lg_class = '';
    if (have_rows('header_media')):
        while (have_rows('header_media')):
            the_row();
            if (get_sub_field('make_full_screen') == 1):
                $classes .= "fullscreen_media";
                $video_lg_class ='fullscreen_media';
                $video_ratio = 'fullw';
                $mobile_ratio = 'fullw';
                $video_lg_ratio = 'fullw';
            endif;
            if (have_rows('video_desktop')):
                $self_host_video = '';
                while (have_rows('video_desktop')):
                    the_row();
                    if (have_rows('options')):
                        while (have_rows('options')):
                            the_row();
                            if (get_sub_field('self_host_video') == 1):
                                $self_host_video = 'true';
                            endif;

                            if (empty($video_ratio)) {
                                $video_ratio = get_sub_field('video_ratio');
                            }
                        endwhile;
                    endif;
                    if ($self_host_video):
                        $header_video = get_sub_field('video_uploaded');
                        $self_host_video = '';
                    else:
                        $header_video = get_sub_field('video');
                    endif;
                    $placerholder = get_sub_field('video_placeholder');
                endwhile;
            endif;
            if (have_rows('video_mobile')):
                $self_host_video = '';
                while (have_rows('video_mobile')):
                    the_row();
                    if (have_rows('options')):
                        while (have_rows('options')):
                            the_row();
                            if (get_sub_field('self_host_video') == 1):
                                $self_host_video = 'true';
                            endif;
    
                            if (empty($mobile_ratio)) {
                                $mobile_ratio = get_sub_field('video_ratio');
                            }
                        endwhile;
                    endif;
    
                    if ($self_host_video):
                        $header_video_mobile = get_sub_field('video_mobile_uploaded');
                    else:
                        $header_video_mobile = get_sub_field('video_mobile');
                    endif;
                    $mobileplaceholder = get_sub_field('video_placeholder');
    
                endwhile;
            endif;
            if (have_rows('video_lg')):
                $self_host_video = '';
                while (have_rows('video_lg')):
                    $video_lg_placeholder = '';
                    the_row();
                    if (have_rows('options')):
                        while (have_rows('options')):
                            the_row();
                            if (get_sub_field('self_host_video') == 1):
                                $self_host_video = 'true';
                            endif;
    
                            if (empty($video_lg_ratio)) {
                                $video_lg_ratio = get_sub_field('video_ratio');
                            }
                            
                        endwhile;
                    endif;
                    
                    
                    if ($self_host_video):
                        $video_lg = get_sub_field('video_mobile_uploaded');
                    else:
                        $video_lg = get_sub_field('video_mobile');
                    endif;
                    if($video_lg){
                        
                        $classes .= " d-3xl-none";
                        $header_media .= customRatio($video_lg_ratio);
                        $header_media .='<div class="header-container__media '.$video_lg_class.' d-none d-3xl-block fold" data-class="header">';
                        
                        $video_lg_placeholder = get_sub_field('video_placeholder');
                        $header_media .= video_containers($video_lg, '', $video_lg_ratio, '', $video_lg_placeholder); 
                        $header_media .= '</div>';
                    }

                endwhile;
            endif;
        endwhile;
    endif;

    $header_media .='<div class="header-container__media '.$classes.' fold" data-class="header">';
    if(get_field('turn_on_overlay')){
        $headerOverlayBG = "background-color: ". get_field('overlay_color');
        $headerOverlayOpacity = get_field('opacity_level');
        if(empty($headerOverlayOpacity)){$headerOverlayOpacity = '0';} else {
            $headerOverlayOpacity = '.'.$headerOverlayOpacity;
        }
        $header_media .='<div class="header-overlay" style="opacity: '.$headerOverlayOpacity.'; '.$headerOverlayBG.'"></div>';
    }
    if(empty($header_video)){ 
        if($placerholder){
            $header_media .= image_containers($placerholder, $mobileplaceholder, $video_ratio, $mobile_ratio); 
        }
    } else {   
        
        $header_media .= customRatio($video_ratio);
        $header_media .= customRatio($mobile_ratio); 
        $header_media .= video_containers($header_video, $header_video_mobile, $video_ratio, $mobile_ratio, $placerholder, $mobileplaceholder);
    }
    $header_media .='</div>';    

    return $header_media;
               
}
function header_link(){ 
    $post_id = '';
    $current_post = get_queried_object();
    $post_id = $current_post ? $current_post->ID : null;
    $output = '';
    $cta_link = '';
    $cta_label = '';
    $cta_target = '';
    $useUrl = '';
    $header_cta = '';
    $ctapadding = '';
    if ( have_rows( 'header_link' ) ) : 
        while ( have_rows( 'header_link' ) ) : the_row();
            $page_lookup = get_sub_field( 'page_lookup' ); 
            $cta_label = get_sub_field( 'link_text' ); 
            $ctaClasses = '';
            if ( have_rows( 'options' ) ) : 
                while ( have_rows( 'options' ) ) : the_row(); 
                    if ( get_sub_field( 'use_url' ) == 1 ) : 
                        $useUrl = 1;         
                    endif; 
                    if ( get_sub_field( 'external_url' ) == 1 ) : 
                        $ctaClasses .= 'link-up ';
                        $cta_target = 'target="_blank"';
                    endif; 
                    $ctapadding .= get_sub_field( 'padding_bottom' );
                endwhile; 
            endif;
            if ( $useUrl == 1 ) : 
                $cta_link = get_sub_field( 'url' ); 
            else :              
                if ( $page_lookup ) :
                    if(empty($cta_label)){
                        $cta_label = get_the_title( $page_lookup );
                    }
                    $cta_link = get_permalink( $page_lookup );
                endif; 
            endif;  
            $ctaClasses .= ' h8';
            $output .= '<div class="header-link '.$ctapadding.'"><a href="'.esc_attr($cta_link).'" class="'. esc_attr( $ctaClasses ).'" '.$cta_target.'>'.$cta_label.'</a></div>';
        endwhile; 
    endif; 
    return $output;
}
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