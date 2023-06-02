
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
    $header_type =  get_field( 'header_type' );


                        if( $header_type == 'casestudy' ) {
                            
$client_logo = get_field('client_logo');
                            $title_of_work_performed = get_field('title_of_work_performed');
                            if (empty($title_of_work_performed)):
                                $title_of_work_performed = get_the_title();
                            endif;
                            $header_media .= '<header class="page-header fold" data-class="header">';
                           
                            $header_media .= '<div class="container">';
                            if ($client_logo):
                                $header_media .= '<img class="img-responsive client-logo" src="' . esc_url($client_logo['url']) . '" alt="' . esc_attr($client_logo['alt']) . '" />';
                                $header_media .= '<h3 class="card-title cp1">' . $title_of_work_performed . '</h3>';
                            endif;
                            $header_media .= '</div></header>';
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
if ( ! function_exists( 'supply_excrpt' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function supply_excerpt($limit) {

        $excerpt = explode(' ', get_the_excerpt(), $limit);

        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
  
        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
  
		printf($excerpt);
	}
endif;

if ( ! function_exists( 'supply_share_buttons' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function supply_share_buttons() {
        $permalink = get_the_permalink();
		$output = '<ul class="social-nav share-buttons cp2"><li><a class="mt-0 ms-0 copy-to-clipboard" href="#" title="Copy to clipboard"><i class="fa-solid fa-link" aria-hidden="true"></i></a></li><li><a class="" href="https://www.linkedin.com/sharing/share-offsite/?url='.$permalink.'" target="_blank" title="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a></li><li><a class="" href="https://www.facebook.com/sharer/sharer.php?u='.$permalink.'" target="_blank" title="Share on Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a></li><li><a class="twitter-share-button mb-0 me-0" href="https://twitter.com/intent/tweet" target="_blank" title="share on Twitter"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a></li></ul>';
		return $output;
    }

endif;

if ( ! function_exists( 'supply_entry_meta' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function supply_entry_meta($value = null) {
		$author_id = get_the_author_meta( 'ID' ); 
		$role = get_field('role__position_at_supply', $author_id);
		$newAuthorID = 'user_'.$author_id;
		$role = get_field('role__position_at_supply', $newAuthorID);
		$author = get_the_author();
		$permalink = get_the_permalink();
		$output = '<div class="entry-meta mt-0">'.supply_share_buttons().'<span class="font-weight-bold h6 author-meta vcard d-block">'.$author.'</span><span class="sep h8 text-capitalize">'.$role.'</span></div>';
		return $output;
	}
	//old text 
	/**
	 * <div class="entry-meta"><span class="font-weight-bold author-meta vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span><br /><span class="sep h8 text-capitalize cp2">%4$s</span><ul class="social-nav share-buttons"><li><a class="" id="copy-to-clipboard" href="#" target="_blank" title="Copy to clipboard"><i class="fa-solid fa-link" aria-hidden="true"></i></a></li><li><a class="" href="https://www.linkedin.com/sharing/share-offsite/?url=%5$s" target="_blank" title="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a></li><li><a class="" href="https://www.facebook.com/sharer/sharer.php?u=%5$s" target="_blank" title="Share on Facebook"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a></li><li><a class="twitter-share-button" href="https://twitter.com/intent/tweet" target="_blank" title="share on Twitter"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a></li></ul></div>
	 */
endif;

function copyURLIcon(){
    $output = '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect width="30" height="30" rx="15" fill="black"/><g clip-path="url(#clip0_654_12973)">
    <path d="M11.5546 22.1438C10.1176 22.0575 8.88033 21.3463 8.22174 19.8332C7.56847 18.3316 7.79569 16.9065 8.88299 15.6779C9.55933 14.9142 10.3076 14.2137 11.0354 13.4971C11.449 13.0899 12.0543 13.0944 12.4413 13.4793C12.8416 13.8767 12.8372 14.4759 12.412 14.9107C11.7437 15.5934 11.0505 16.2513 10.3945 16.9448C9.38093 18.0151 9.86555 19.7434 11.275 20.099C11.986 20.2786 12.6135 20.0866 13.1354 19.5656C13.7949 18.9059 14.4499 18.2418 15.1139 17.5866C15.4467 17.2586 15.8497 17.1928 16.2437 17.3768C16.621 17.5528 16.8677 17.9351 16.7949 18.3485C16.755 18.5752 16.6449 18.825 16.4887 18.9904C15.8079 19.7069 15.1103 20.4084 14.3967 21.0912C13.6591 21.797 12.7609 22.1331 11.5555 22.1446L11.5546 22.1438Z" fill="white"/>
    <path d="M22.1482 11.5575C22.1367 12.7684 21.7745 13.6885 21.0378 14.4477C20.3801 15.1252 19.71 15.7893 19.0381 16.4525C18.5907 16.8952 17.9863 16.9148 17.5833 16.5147C17.1653 16.0995 17.1946 15.5066 17.6605 15.0363C18.2863 14.4051 18.9183 13.7819 19.5413 13.148C20.3517 12.3239 20.3775 11.1352 19.6097 10.3769C18.8402 9.61678 17.6694 9.65857 16.8449 10.4782C16.2306 11.089 15.6218 11.7051 15.0076 12.3159C14.5123 12.8093 13.9336 12.8519 13.5075 12.4314C13.0886 12.018 13.1241 11.4064 13.6007 10.9263C14.2425 10.28 14.8762 9.62567 15.533 8.99536C17.7537 6.86615 21.3112 7.86541 22.0328 10.8196C22.1038 11.1086 22.126 11.4099 22.1482 11.5575Z" fill="white"/>
    <path d="M18.0358 13.1107C17.9728 13.2254 17.8912 13.4939 17.7181 13.6708C16.3911 15.0257 15.0491 16.3655 13.7035 17.7025C13.2801 18.1239 12.6606 18.1257 12.2736 17.7363C11.8849 17.3452 11.8937 16.7273 12.3127 16.3041C13.6485 14.9581 14.9887 13.6166 16.3317 12.2777C16.6512 11.9586 17.087 11.883 17.4625 12.0599C17.8423 12.2386 18.019 12.5498 18.0358 13.1107Z" fill="white"/>
    </g>
    <defs>
    <clipPath id="clip0_654_12973">
    <rect width="14.2857" height="14.2857" fill="white" transform="translate(7.85718 7.85718)"/>
    </clipPath>
    </defs>
    </svg>';
    return $output;
}
function facebookIcon(){
    $output = '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect width="30" height="30" rx="15" fill="black"/><path d="M18.3422 15.8924L18.7493 13.3082H16.2416V11.6285C16.2416 10.9219 16.5917 10.2314 17.7112 10.2314H18.8673V8.0308C18.1941 7.92354 17.5137 7.8655 16.8319 7.85718C14.768 7.85718 13.4205 9.09678 13.4205 11.3378V13.3082H11.1327V15.8924H13.4205V22.1429H16.2416V15.8924H18.3422Z" fill="white"/></svg>';
    
    return $output;
}
function twtterIcon() {
    $output = '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="black"/><path d="M22.1429 10.5696C21.6173 10.8029 21.0524 10.9601 20.4596 11.0309C21.0649 10.6684 21.5298 10.094 21.7483 9.40948C21.1822 9.74519 20.5548 9.98924 19.8869 10.1208C19.353 9.55114 18.5905 9.19519 17.7477 9.19519C15.8554 9.19519 14.4649 10.9607 14.8923 12.7934C12.4572 12.6714 10.2977 11.5047 8.85182 9.7315C8.08396 11.0488 8.45361 12.772 9.75837 13.6446C9.27861 13.6291 8.82623 13.4976 8.43158 13.2779C8.39944 14.6357 9.37265 15.9059 10.7822 16.1886C10.3697 16.3005 9.91789 16.3267 9.45837 16.2386C9.83099 17.4029 10.9131 18.25 12.1965 18.2738C10.9643 19.2398 9.41194 19.6714 7.85718 19.488C9.1542 20.3196 10.6953 20.8047 12.35 20.8047C17.7917 20.8047 20.8661 16.2089 20.6804 12.0869C21.253 11.6732 21.75 11.1571 22.1429 10.5696Z" fill="white"/></svg>';
    return $output;
}
function linkinIcon() {
    $output = '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="black"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.0582 9.94574C11.0582 10.7213 10.4348 11.3497 9.66537 11.3497C8.89597 11.3497 8.27258 10.7213 8.27258 9.94574C8.27258 9.17073 8.89597 8.54175 9.66537 8.54175C10.4348 8.54175 11.0582 9.17073 11.0582 9.94574ZM11.069 12.4724H8.26099V21.4579H11.069V12.4724ZM12.7614 12.4722H15.5515V13.6825C16.7286 11.504 21.7393 11.3429 21.7393 15.7682V21.4578H18.938V16.7409C18.938 13.9037 15.552 14.1183 15.552 16.7409V21.4578H12.7614V12.4722Z" fill="white"/></svg>';
    return $output;
}