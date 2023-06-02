<?php 
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
    $client_logo = get_field('client_logo');
    $title_of_work_performed = get_field('title_of_work_performed');
    if (empty($title_of_work_performed)):
        $title_of_work_performed = get_the_title();
    endif;
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

    $classes .= ' cp3';
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

                            

    $header_media .= '<header class="page-header fold" data-class="header">';
    
    $header_media .= '<div class="container">';
    if ($client_logo):
        $header_media .= '<img class="img-responsive client-logo" src="' . esc_url($client_logo['url']) . '" alt="' . esc_attr($client_logo['alt']) . '" />';
        $header_media .= '<h3 class="card-title cp1">' . $title_of_work_performed . '</h3>';
    endif;
    $header_media .= '</div></header>';
                            
    $header_media .='</div>';    ?>

<!--case study-->
<div id="header-<?php the_ID(); ?>" class="casestudy cp3 header-container">
    <?php echo $header_media; ?>
</div>             