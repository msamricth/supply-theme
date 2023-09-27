<?php
/**
 * Block template file: template-parts/blocks/supply-media.php
 *
 * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED * SUNSETTED
 * 
 * USE ONLY FOR REFERENCE
 * 
 * Supply Media Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-media-' . $block['id'];
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
$vimeo_video_mobile = '';
$vimeoVideo = '';
$vimeoVideo = get_field('vimeo_video');
$image = get_field( 'image' );
$video_ratio = get_field('video_ratio');
$vimeo_video_mobile = get_field('vimeo_video_mobile');
$classes .= ' fadeNoScroll';
$blockContent = '';
$blockStyles = '';
$presetRatios = array('21x9','16x9','4x3','3x2','fullw');
$image_mobile = get_field('image_mobile');
$mobile_ratio = get_field('mobile_ratio');
if ( get_sub_field( 'make_full_screen' ) == 1 ) : 
    $video_ratio = 'fullw';
    $mobile_ratio = 'fullw';
else:
    if($mobile_ratio){echo customRatio($mobile_ratio);}
    if($video_ratio){echo customRatio($video_ratio);}
endif;

$extras = '';
$extras .= get_container_scheme();

?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php
    if($image_mobile){
        $blockContent .='<img src="'. esc_url( $image_mobile['url'] ) .'" class="img-responsive d-md-none" alt="'.esc_attr( $image_mobile['alt'] ) .'" />';
        if ( $image ) : 
            $blockContent .='<img src="'. esc_url( $image['url'] ) .'" class="img-responsive d-none d-md-block" alt="'.esc_attr( $image['alt'] ) .'" />';
        endif;
    } else {
        if ( $image ) : 
            $blockContent ='<img src="'. esc_url( $image['url'] ) .'" class="img-responsive" alt="'.esc_attr( $image['alt'] ) .'" />';
        endif;
    }
    if ( $vimeoVideo ) : 
        $blockContent = video_containers($vimeoVideo, $vimeo_video_mobile, $video_ratio, $mobile_ratio);
    endif;
    if ( have_rows( 'column_placement' ) ) :
        while ( have_rows( 'column_placement' ) ) : the_row();
            echo supply_grid($blockContent, 'col-dlg-12', $extras);
        endwhile;
    endif;
    if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        echo '<button style="position: absolute;right: 10%;padding: 2rem;top: 20%;">Click here to edit this Media Block </button>';
    } 
?>
</div>