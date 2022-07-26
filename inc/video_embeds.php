<?php
// Supplys video functions 
function Video_embed ($videoURL = null){
    $current_post = get_queried_object();
    $post_id = $current_post ? $current_post->ID : null;
    $reels = get_field('reels', $post_id);
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
        $video = $videoURL;
    }
    $embed .= '<div class="ratio ratio-16x9 video-embed fadeNoScroll">';
    $embed .= '<div class="preview-video"><iframe src="'. $video.'?h=1fa258310d&amp;title=0&amp;byline=0&amp;portrait=0&amp;playsinline=0&amp;muted=1&amp;autoplay=1&amp;autopause=0&amp;controls=0&amp;loop=1&amp;app_id=122963" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><button id="play-button"></button>';
   // $embed .= '<div class="video-block" data-video="'. $video.'?autoplay=1&loop=1"></div>';
   $embed .= '<iframe class="iframe-video" id="vimeoFrame" src="'. $video.'" frameborder="0" allowfullscreen allow="autoplay"></iframe>';
    $embed .= '</div>';
    return $embed;
    
}