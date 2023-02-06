<!--- test header template -->
<?php

$header_video = '';
$header_video_mobile = '';
$headercontainer = '';
$mobile_ratio = '';
$header_image = '';
$subClasses = '';
$video_ratio = '';
$headerMedia = '';
$header_content = '';
$video_ratio = '';
$placerholder = '';
$mobileplaceholder = '';
$self_host_video = '';
$header_type =  get_field( 'header_type' );
$client_logo = get_field('client_logo');
$title_of_work_performed = get_field('title_of_work_performed');
if (have_rows('header_media')):
    while (have_rows('header_media')):
        the_row();
        $video_ratio = get_sub_field('video_ratio');
        if (get_sub_field('make_full_screen') == 1):
            $headercontainer .= "fullscreen_media";
            $video_ratio = 'fullw';
            $mobile_ratio = 'fullw';
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
                        if ($video_ratio)
                        {
                        }
                        else
                        {
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
            while (have_rows('video_mobile')):
                the_row();
                if (have_rows('options')):
                    while (have_rows('options')):
                        the_row();
                        if (get_sub_field('self_host_video') == 1):
                            $self_host_video = 'true';
                        endif;
                        if ($mobile_ratio)
                        {
                        }
                        else
                        {
                            $mobile_ratio = get_sub_field('video_ratio');
                        }

                        
                    endwhile;
                endif;

                if ($self_host_video):
                    $header_video_mobile = get_sub_field('video_uploaded');
                else:
                    $header_video_mobile = get_sub_field('video');
                endif;
                $mobileplaceholder = get_sub_field('video_placeholder');

            endwhile;
        endif;
    endwhile;
endif;

if(strpos($header_type, 'xs') !== false){}
switch ( $header_type ) {
    case 'casestudy':
        $headerMedia= true;
        break;
        
    case 'standardmedia':
        $headerMedia= true;
        break;
        
    case 'basic':
        break;
        default:
}
if ($client_logo):
    $header_content .= '<header class="page-header">';
    $header_content .= '<div class="container">';

    $header_content .= '<img class="img-responsive client-logo" src="' . esc_url($client_logo['url']) . '" alt="' . esc_attr($client_logo['alt']) . '" />';

    if ($title_of_work_performed):
        $header_content .= '<h3 class="card-title cp1">' . $title_of_work_performed . '</h3>';
    else:
        $header_content .= '<h3 class="card-title cp1">' . get_the_title() . '</h3>';
    endif;
    $header_content .= '</div>';
    $header_content .= '</header>';
endif;

if ($header_video): 
    echo customRatio($mobile_ratio);
    echo customRatio($video_ratio);?>
            <div class="header-container cp3 fold <?php echo $headercontainer; ?>" data-class="header">
                <?php echo video_containers($header_video, $header_video_mobile, $video_ratio, $mobile_ratio, $placerholder, $mobileplaceholder) . "\n" . $header_content; ?>
            </div>

        <?php
else: ?>
    <?php if ($placerholder): ?>
                    <div class="header-container cp3 fold  <?php echo $headercontainer; ?>" data-class="header">
                        <?php echo image_containers($placerholder, $mobileplaceholder, $video_ratio, $mobile_ratio); ?>
                        <?php echo $header_content; ?>
                    </div>
    <?php endif; ?>
            <?php
endif; ?>  
            
            
