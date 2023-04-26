<?php
// Supplys video functions 

//Basic required prestructure setup video url formatting 
function VideoFM($url = null){
    $video = '';
    $current_post = get_queried_object();
    $post_id = $current_post ? $current_post->ID : null;
    $reels = get_field('reels', $post_id);
    if(empty($url)){
        if($reels){
            // Load value.
            // Use preg_match to find iframe src.
            preg_match('/src="(.+?)"/', $reels, $matches);
            $video = $matches[1];
        }
    } else {
        if(strpos($url, 'vimeo') !== false){
            preg_match('/src="(.+?)"/', $url, $matches);
            if($matches) {
                $video = $matches[1];
            }
        }
    }
    return $video;
}
//vimeo formatting
function VimeoVideo($video = null, $classes = null, $backgroundvideoOff = null){
    $output = '';
    $vimeoTitle = '';
    $vimeoID = str_replace('https://player.vimeo.com/video/','', $video);
    $vimeoID = substr($vimeoID, 0, strpos($vimeoID, "?"));
    $request = wp_remote_get( 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $vimeoID );
    $response = wp_remote_retrieve_body( $request );
    $video_array = json_decode( $response, true );
    $options = '';
    if($video_array){
        if(isset($video_array['title']) ? $video_array['title'] : null){
            $vimeoTitle =  $video_array['title'];
        } else {
            $vimeoTitle = 'RAVT-'.rand(5, 15);
        }
        
    }
    if(empty($classes)){
        $classes = 'videofx';
    }
    if(empty($backgroundvideoOff)){
        $options = '?&amp;background=1&amp;muted=1&amp;loop=1&maxheight=200vh&maxwidth=200vw&title=0&byline=0&portrait=0&autopause=0';
    } 
    $classes .= ' vimeo lazy';
    $output .= '<iframe loading="lazy" data-videotitle="'.$vimeoTitle.'" title="'.$vimeoTitle.'" id="video'.$vimeoID.'" class="'.$classes.'" src="'. $video . $options.'" frameBorder="0" allow="autoplay; picture-in-picture; fullscreen"></iframe>';
    return $output;
}
//selfhosting formating
function selfHostVideo($videoURL = null, $placerholder = null, $classes = null, $id = null){
    $output = '';
    if(empty($classes)){
        $classes = 'videofx';
    } 
    $classes .= ' selfhosted lazy';
    $output .= '<video  id="video'.rand(5, 15).'" class="'.$classes.'" ';
    if($placerholder){
        $output .='poster="'.esc_url( $placerholder['url'] ).'"';
    }
    $output .='  autoplay muted playsinline loop background  allow="picture-in-picture"> <source data-src="'.$videoURL.'" type="video/mp4"></video>';

    return $output;
}
//Video embed with a playbutton
function Video_embed(){
    $playBTN = get_field( 'play_button', 'option' );
    $embed = '';
    $displayVideo = '';
    $previewVideo = '';
    $ratio = 'ratio-16x9';
    
    $video = VideoFM();
    $displayVideo = VimeoVideo($video, 'iframe-video d-none', 'vimeoFrame','true');
    $previewVideo = VimeoVideo($video);
    $embed .= '<div class="ratio '.$ratio.' video-embed fadeNoScroll">';
    $embed .= '<div class="preview-video reels--preview">'.$previewVideo.'</div><button id="play-button"><img src="'.$playBTN.'" /><span>Watch Video</span></button>';
   // $embed .= '<div class="video-block" data-video="'. $video.'?autoplay=1&loop=1"></div>';
    $embed .= $displayVideo;
    $embed .= '</div>';
    return $embed;
    
}
function reels($videoURL = null, $placerholder = null, $ratio = null, $PlaceholdervideoURL = null, $darkMode = null){
    
    if(empty($darkMode)){
        $playBTN = get_field( 'play_button', 'option' );
    } else {
        $playBTN = get_field( 'play_button_dark', 'option' );
    }
    $video = VideoFM($videoURL);
    $Placeholdervideo = '';
    $embed = '';
    $displayVideo = '';
    $previewVideo = '';
    if(empty($ratio)){
        $ratio = 'ratio-16x9';
    } else {
        $ratio .= ' ratio-' . $ratio;
    }
    $video = VideoFM($videoURL);
    if(strpos($videoURL, 'vimeo') !== false){
        $displayVideo = VimeoVideo($video, 'iframe-video d-none', 'vimeoFrame','true');
    } else {
        $displayVideo = selfHostVideo($videoURL, $placerholder, 'reels--reel iframe-video d-none');
    }
    if(empty($PlaceholdervideoURL)){
        if($placerholder){
            $previewVideo = '<img src="'.esc_url( $placerholder['url'] ).'" />';
        }
    } else {
        if(strpos($PlaceholdervideoURL, 'vimeo') !== false){
            $Placeholdervideo = VideoFM($PlaceholdervideoURL);
            $previewVideo = VimeoVideo($Placeholdervideo);
        } else {
            $previewVideo = selfHostVideo($PlaceholdervideoURL);
        }
    }
    $embed .= '<div class="ratio '.$ratio.' video-embed reels fadeNoScroll">';
    $embed .= '<div class="preview-video reels--preview ratio '.$ratio.' ">'.$previewVideo.'</div><button class="reels--button" id="play-button"><img src="'.$playBTN.'" /><span>Watch Video</span></button>';
    $embed .= $displayVideo;
    $embed .= '</div>';
    return $embed;
}
function muteBTN($darkMode = null){
    
    if(empty($darkMode)){
        $mute =  get_field( 'mute_button', 'option' );
        $unmute = get_field( 'unmute_button', 'option' );
    } else {
        $mute =  get_field( 'mute_button_dark', 'option' );
        $unmute = get_field( 'unmute_button_dark', 'option' );
    }
    $output = '';
    $output .= '<button class="mute-button" role="button" data-bs-toggle="button"><img class="mute" src="'.$mute.'" /><img class="d-none unmute" src="'.$unmute.'" /></button>';
    return $output;
}
function background_video($videoURL = null, $placerholder = null, $eagerLoad = null){
    $embed = '';
    $video = VideoFM($videoURL);
    if(strpos($videoURL, 'vimeo') !== false){
        $embed .= VimeoVideo($video);
    } else {
        $embed .= selfHostVideo($videoURL, $placerholder);
    }
	//endif; 
    return $embed;
}
function backgroundVideo($videoURL = null, $placerholder = null, $ratio = null, $mute = null, $darkMode = null){
    $embed = '';
    $classes = '';
    $video = VideoFM($videoURL);
    if(empty($ratio)){
        $ratio = 'ratio-16x9';
    } else {
        $ratio .= ' ratio-' . $ratio;
    }
    if($mute == 1) {
        $ratio .= ' mute-controls';
    }
    $embed .= '<div class="ratio supply-video ' . $ratio .'">';

    if($mute == 1) {
        $embed .= muteBTN($darkMode);
    }
    if(strpos($videoURL, 'vimeo') !== false){
        $embed .= VimeoVideo($video);
    } else {
        $embed .= selfHostVideo($videoURL, $placerholder);
    }
    $embed .= '</div>';
  
	//endif; 
    return $embed;
}
function video_containers($videoURL, $videoMURL = null, $ratio = null, $mobile_ratio = null, $placerholder = null, $mobileplaceholder = null) {
    $classes = '';
    $mobileVideo = '';
    $desktopVideo = '';
    if($videoMURL){
        if($mobile_ratio){}else{
            $mobile_ratio = 'mobile';
        }
        $mobileVideo .= '<div class="d-md-none supply-video ratio ratio-'. $mobile_ratio . '">' . background_video($videoMURL, $mobileplaceholder) . '</div>';
        $classes .= "d-none d-md-block";
    }
    if($ratio) {
        $classes .= ' ratio-' . $ratio;
    } else {
        $classes .= ' ratio-16x9';
    }
    $desktopVideo .= '<div class="ratio supply-video ' . $classes .'">' . background_video($videoURL, $placerholder)  . '</div>';
    $desktopVideo .= $mobileVideo;
    return $desktopVideo;
}
function image_containers( $imageObject,  $imageObjectMobile = null, $ratio = null, $mobile_ratio = null) {
    $classes = '';
    $mobileImage = '';
    $desktopImage = '';
    if( $imageObjectMobile){
        $classes .= 'd-none d-sm-block';
        if($mobile_ratio){}else{
            $mobile_ratio = 'mobile';
        }
        $mobileImage .= '<div class="d-sm-none supply-image ratio ratio-'. $mobile_ratio . '">';
        $mobileImage .= '<img src="'.esc_url( $imageObjectMobile['url'] ).'" alt="'. esc_attr( $imageObjectMobile['alt'] ).'" />';
        $mobileImage .= '</div>';
    } else {
        $classes .= "main-image";
    }
    
    if($ratio) {
        $classes .= ' ratio-' . $ratio;
    } else {
        $classes .= ' ratio-16x9';
    }
    $desktopImage .= '<div class="ratio supply-image ' . $classes .'">';
    $desktopImage .= '<img class="'.$classes.'" src="'.esc_url( $imageObject['url'] ).'" alt="'. esc_attr( $imageObject['alt'] ).'" />';
    $desktopImage .= '</div>';
    $desktopImage .= $mobileImage;
    if(is_array($imageObject)) {
        return $desktopImage;
    }
}
function image_containersNR( $imageObject,  $imageObjectMobile = null) {
    $classes = '';
    $mobileImage = '';
    $desktopImage = '';
    if( $imageObjectMobile){
        $classes .= 'd-none d-md-block';
        $mobileImage .= '<div class="d-md-none supply-image">';
        $mobileImage .= '<img src="'.esc_url( $imageObjectMobile['url'] ).'" alt="'. esc_attr( $imageObjectMobile['alt'] ).'" />';
        $mobileImage .= '</div>';
    } else {
        $classes .= "main-image";
    }
    
    $desktopImage .= '<div class=" supply-image ' . $classes .'">';
    $desktopImage .= '<img class="'.$classes.'" src="'.esc_url( $imageObject['url'] ).'" alt="'. esc_attr( $imageObject['alt'] ).'" />';
    $desktopImage .= '</div>';
    $desktopImage .= $mobileImage;
    if(is_array($imageObject)) {
        return $desktopImage;
    }
}
function video_containersNR($mainVideo, $mobileVideo) {
    $classes = '';
    $mobileVideoOutput = '';
    $output = '';
    if($mobileVideo){
        $mobileVideoOutput .= '<div class="d-md-none supply-video">' . $mobileVideo . '</div>';
        $classes .= "d-none d-md-block";
    }
    $output .= '<div class="supply-video ' . $classes .'">' . $mainVideo . '</div>';
    $output .= $mobileVideoOutput;
    return $output;
}
function media_block_main(){
    $output = '';
    $media_block_video = '';
    $media_block_video_mobile = '';
    $mobile_ratio = '';
    $media_block_image = '';
    $subClasses = '';
    $video_ratio = '';
    $blockStyles = '';
    $video_ratio = '';
    $placerholder = '';
    $mobileplaceholder = '';
    $blockContent = '';
    $self_host_video = '';
    $IsReels = '';
    $IsMute = '';
    $mainVideo = '';
    $mobileVideo = '';
    $PlaceholdervideoURL = '';
    $darkMode = '';
    if (have_rows('media')):
        while (have_rows('media')):
            the_row();
            $video_ratio = get_sub_field('video_ratio');
            if (get_sub_field('make_full_screen') == 1):
                $video_ratio = 'fullw';
                $mobile_ratio = 'fullw';
            endif;
            if ( get_sub_field( 'play_button' ) == 1 ) : 
                $IsReels = 1;
            endif; 

            if ( get_sub_field( 'mute_settings' ) == 1 ) : 
                $IsMute = 1;
            endif; 
            
            if ( get_sub_field( 'dark_layout' ) == 1 ) : 
                $darkMode = 1;
            endif;
            if (have_rows('video_desktop')):
                while (have_rows('video_desktop')):
                    the_row();
                    if (have_rows('options')):
                        while (have_rows('options')):
                            the_row();
                            if (get_sub_field('self_host_video') == 1):
                                $self_host_video = 'true';
                            endif;
                            if ($video_ratio) {
                            } else {
                                $video_ratio = get_sub_field('video_ratio');
                            }
                        endwhile;
                    endif;
                    if ($self_host_video):
                        $media_block_video = get_sub_field('video_uploaded');
                        $self_host_video = '';
                    else:
                        $media_block_video = get_sub_field('video');
                    endif;
                    
                    $PlaceholdervideoURL = get_sub_field( 'placeholder_video' );
                    
                    if(empty($PlaceholdervideoURL)){
                        $PlaceholdervideoURL = get_sub_field( 'placeholder_video_url');
                    }
                    $placerholder = get_sub_field('video_placeholder');
                   
                    if($IsReels){
                        $mainVideo = reels($media_block_video, $placerholder, $video_ratio, $PlaceholdervideoURL, $darkMode);
                    } else {
                        $mainVideo = backgroundVideo($media_block_video, $placerholder, $video_ratio, $IsMute, $darkMode);
                    }
                    
                endwhile;
            endif;
            
            if (have_rows('video_mobile')):
                while (have_rows('video_mobile')):
                    the_row();
                    if (have_rows('options')):
                        while (have_rows('options')):
                            the_row();
                            if (get_sub_field('self_host_video') == 1):
                                $self_host_video = 'true';
                            endif;
                            if ($mobile_ratio) {
                            } else {
                                $mobile_ratio = get_sub_field('video_ratio');
                            }

                            
                        endwhile;
                    endif;
                    $PlaceholdervideoURL = get_sub_field( 'placeholder_video' );
                    if ($self_host_video):
                        $media_block_video_mobile = get_sub_field('video_mobile_uploaded');
                    else:
                        $media_block_video_mobile = get_sub_field('video_mobile');
                    endif;
                    $mobileplaceholder = get_sub_field('video_placeholder');
                    if($IsReels){
                        $mobileVideo = reels($media_block_video_mobile, $mobileplaceholder, $mobile_ratio, $PlaceholdervideoURL, $darkMode);
                    } else {
                        $mobileVideo = backgroundVideo($media_block_video_mobile, $mobileplaceholder, $mobile_ratio, $IsMute, $darkMode);
                    }
                endwhile;
            endif;
            if ($media_block_video): 
                $output .= customRatio($mobile_ratio);
                $output .= customRatio($video_ratio);
                $output .= video_containersNR($mainVideo, $mobileVideo);
            else: 
                if ($placerholder): 
                    if($video_ratio == 'fullw'){
                        $output .= image_containers($placerholder, $mobileplaceholder, $video_ratio, $mobile_ratio); 
                    } else {
                        $output .= image_containersNR($placerholder, $mobileplaceholder); 
                    }
                endif; 
            endif; 
        endwhile;
    endif;

return $output;

}