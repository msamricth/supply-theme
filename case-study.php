<?php
/**
 * The Template for displaying all external pages.
 */

get_header();

// settings
$classes = 'entry container editor-content';
$client_logo = '';
$deep_dive = '';
$header_video = '';
$header_video_mobile = '';
$url_to_work = '';
$title_of_work_performed = '';
$intro_blurb = '';
$header_image = '';
$classes .= 'case-study ';
$prevPost = '';
$nextPost = '';
$subClasses = '';
$video_ratio = '';
$blockStyles = '';
$header_content = '';
$video_ratio ='';

// start
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); 
            $prevPost = get_previous_post();
            $nextPost = get_next_post();

            $client_logo = get_field( 'client_logo' );
            $title_of_work_performed = get_field( 'title_of_work_performed' );
            if ( have_rows( 'header_media' ) ) :
                while ( have_rows( 'header_media' ) ) : the_row();
                    $header_video =  get_sub_field( 'video' );
                    $header_video_mobile = get_sub_field( 'video_mobile' );
                    $header_image = get_sub_field( 'image' ); 
                    $video_ratio = get_sub_field('video_ratio');
                    
                endwhile;
            endif;
            $presetRatios = array('21x9','16x9','4x3','3x2','fullw');

                    if(strpos(implode(" ",$presetRatios), $video_ratio) !== false){} else {
                    
                    $blockStyles .= '<style type="text/css">';
                    $blockStyles .= '.ratio-'.$video_ratio.' {';
                    $blockStyles .= '  --bs-aspect-ratio: calc('.$video_ratio.' * 100%);';
                    $blockStyles .= '} </style>';
                    echo $blockStyles;

                
            }
            $header_content .= '<header class="page-header">';
            $header_content .= '<div class="container">';
            if ( $client_logo ) :
                $header_content .= '<img class="img-responsive client-logo" src="'. esc_url( $client_logo['url'] ) .'" alt="'. esc_attr( $client_logo['alt'] ).'" />';
            endif;
            if ($title_of_work_performed):
                $header_content .= '<h3 class="card-title cp1">'.$title_of_work_performed.'</h3>';
            else :
                $header_content .= '<h3 class="card-title cp1">'.get_the_title().'</h3>';
            endif;    
            $header_content .= '</div>';
            $header_content .= '</header>';



            if($header_video) : ?>
            <div class="header-container cp3 fold" data-class="header">
                <?php echo video_containers($header_video, $header_video_mobile, $video_ratio, $video_ratio)."\n".
                $header_content;?>
            </div>

        <?php else : ?>
            <?php if ( $header_image ) : ?>
                <div class="header-container cp3 ratio ratio-16x9 fold" data-class="header">
                    <img src="<?php echo esc_url( $header_image['url'] ); ?>" alt="<?php echo esc_attr( $header_image['alt'] ); ?>" />
                    <?php echo $header_content;?>
                </div>
            <?php endif; ?>  
            
        <?php endif; ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <?php the_content(); ?>
        </div>
<?php 
    endwhile;
endif;

wp_reset_postdata();?>
<div>
<?php get_footer();
