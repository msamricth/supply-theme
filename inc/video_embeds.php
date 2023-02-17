<?php
// Supplys video functions 
function Video_embed ($videoURL = null){
    $current_post = get_queried_object();
    $post_id = $current_post ? $current_post->ID : null;
    $reels = get_field('reels', $post_id);
    $videoACF = get_field('reels', $post_id);
    $video = '';
    $embed = '';
    if(empty($videoURL)){
        if($reels){
            // Load value.
            // Use preg_match to find iframe src.
            preg_match('/src="(.+?)"/', $reels, $matches);
            $video = $matches[1];
        }
    } else {
        preg_match('/src="(.+?)"/', $videoURL, $matches);
        $video = $matches[1];
    }
    $embed .= '<div class="ratio ratio-16x9 video-embed fadeNoScroll">';
    $embed .= '<div class="preview-video"><iframe class="videofx" src="'. $video.'?h=1fa258310d&amp;background=1&amp;loop=1&amp;app_id=122963" frameBorder="0" allow="autoplay; picture-in-picture; fullscreen" allowfullscreen></iframe></div><button id="play-button">PLAY REEL</button>';
   // $embed .= '<div class="video-block" data-video="'. $video.'?autoplay=1&loop=1"></div>';
   $embed .= '<iframe class="iframe-video d-none" id="vimeoFrame" src="'. $video.'" frameBorder="0" allowfullscreen allow="autoplay; picture-in-picture; fullscreen"></iframe>';
    $embed .= '</div>';
    return $embed;
    
}
function background_video ($videoURL = null, $placerholder = null, $eagerLoad = null){
    $current_post = get_queried_object();
    $post_id = $current_post ? $current_post->ID : null;
    $reels = get_field('reels', $post_id);
    $videoACF = get_field('reels', $post_id);
    $video = '';
    $embed = '';
    $vimeoTitle = '';
    $vimeoDescription = '';
    $vimeoThumbnail = '';
    $video_placeholder = '';
    $video_placeholder_mobile = '';
    if(empty($videoURL)){
        if($reels){
            // Load value.
            // Use preg_match to find iframe src.
            preg_match('/src="(.+?)"/', $reels, $matches);
            $video = $matches[1];
        }
    } else {
        
        if(strpos($videoURL, 'vimeo') !== false){
            preg_match('/src="(.+?)"/', $videoURL, $matches);
            if($matches) {
                $video = $matches[1];
            }
        }
    }
    if(strpos($videoURL, 'vimeo') !== false){
        $vimeoID = str_replace('https://player.vimeo.com/video/','', $video);
        $vimeoID = substr($vimeoID, 0, strpos($vimeoID, "?"));
        $request = wp_remote_get( 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $vimeoID );
        
        $response = wp_remote_retrieve_body( $request );
        
        $video_array = json_decode( $response, true );
        if($video_array){
            $vimeoTitle =  $video_array['title'];
        // $vimeoDescription =  $video_array['description'];
        // $vimeoThumbnail = $video_array['thumbnail_large'];
        }

    
    //  $embed .="<script>console.log('".$vimeoID."');</script>";
    // if ((get_field( 'lazy_load_videos', 'option' ) == 1 ) || $eagerLoad):
    //       $embed .= '<iframe loading="lazy" id="video'.$vimeoID.'" class="videofx" src="" data-src="'. $video.'?&amp;background=1&amp;loop=1" frameBorder="0" allow=" picture-in-picture"></iframe>';
    //       $embed .='<img src="https://vumbnail.com/'.$vimeoID.'.jpg" id="img-video'.$vimeoID.'"/>';
    //  else:
            $embed .= '<iframe loading="lazy" data-videotitle="'.$vimeoTitle.'" title="'.$vimeoTitle.'" id="video'.$vimeoID.'" class="videofx vimeo" src="'. $video.'?&amp;background=1&amp;muted=1&amp;loop=1&maxheight=200vh&maxwidth=200vw&title=0&byline=0&portrait=0&autopause=0" frameBorder="0" allow=" picture-in-picture"></iframe>';
    } else {
        $embed .= '<video  id="video'.rand(5, 15).'" class="videofx selfhosted lazy" ';
        if($placerholder){
            $embed .='poster="'.esc_url( $placerholder['url'] ).'"';
          }
          $embed .='  autoplay muted playsinline loop background  allow="picture-in-picture"> <source data-src="'.$videoURL.'" type="video/mp4"></video>';
    }
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