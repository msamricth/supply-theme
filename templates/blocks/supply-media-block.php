<?php
/**
 * Block template file: templates/blocks/supply-media2-block.php
 *
 * Supply Media V2 Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-media-v2-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-media-a';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
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
if (have_rows('media')):
    while (have_rows('media')):
        the_row();
        $video_ratio = get_sub_field('video_ratio');
        if (get_sub_field('make_full_screen') == 1):
            $classes .= "fullscreen_media";
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
                    $media_block_video = get_sub_field('video_uploaded');
                    $self_host_video = '';
                else:
                    $media_block_video = get_sub_field('video');
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
                    $media_block_video_mobile = get_sub_field('video_mobile_uploaded');
                else:
                    $media_block_video_mobile = get_sub_field('video_mobile');
                endif;
                $mobileplaceholder = get_sub_field('video_placeholder');

            endwhile;
        endif;
    endwhile;
endif;


?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php

    if ($media_block_video): 
        echo customRatio($mobile_ratio);
        echo customRatio($video_ratio);

        $blockContent .= video_containers($media_block_video, $media_block_video_mobile, $video_ratio, $mobile_ratio, $placerholder, $mobileplaceholder); 

    else: 
        if ($placerholder): 
            if($video_ratio == 'fullw'){
                $blockContent .= image_containers($placerholder, $mobileplaceholder, $video_ratio, $mobile_ratio); 
            } else {
                $blockContent .= image_containersNR($placerholder, $mobileplaceholder); 
            }
        endif; 
    endif; 

    if ( have_rows( 'column_placement' ) ) :
        while ( have_rows( 'column_placement' ) ) : the_row();
            echo supply_grid($blockContent, 'col-dlg-12');
        endwhile;
    endif;
    if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        echo '<button style="position: absolute;right: 10%;padding: 2rem;top: 20%;">Click here to edit this Media Block(v2) </button>';
    } 
?>
</div>