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
function background_video ($videoURL = null){
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
    $embed .= '<iframe class="videofx" src="'. $video.'?&amp;background=1&amp;loop=1" frameBorder="0" allow="autoplay; picture-in-picture"></iframe>';
    return $embed;
}
function video_containers($videoURL, $videoMURL = null, $ratio = null, $mobile_ratio = null) {
    $classes = '';
    $mobileVideo = '';
    $desktopVideo = '';
    if($videoMURL){
        if($mobile_ratio){}else{
            $mobile_ratio = 'mobile';
        }
        $mobileVideo .= '<div class="d-dlg-none ratio ratio-'. $mobile_ratio . '">' . background_video($videoMURL) . '</div>';
        $classes .= "d-none d-dlg-block";
    }
    if($ratio) {
        $classes .= ' ratio-' . $ratio;
    } else {
        $classes .= ' ratio-16x9';
    }
    $desktopVideo .= '<div class="ratio ' . $classes .'">' . background_video($videoURL)  . '</div>';
    $desktopVideo .= $mobileVideo;
    return $desktopVideo;
}
function image_containers( $imageObject,  $imageObjectMobile = null) {
    $classes = '';
    $mobileImage = '';
    $desktopImage = '';
    if( $imageObjectMobile){
        $mobileImage .= '<img class="d-dlg-none" src="'.esc_url( $imageObjectMobile['url'] ).'" alt="'. esc_attr( $imageObjectMobile['alt'] ).'" />';
        $classes .= "d-none d-dlg-block";
    } else {
        $classes .= "main-image";
    }
    $desktopImage .= '<img class="'.$classes.'" src="'.esc_url( $imageObject['url'] ).'" alt="'. esc_attr( $imageObject['alt'] ).'" />';
    $desktopImage .= $mobileImage;
    return $desktopImage;
}

