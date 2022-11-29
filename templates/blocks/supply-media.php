<?php
/**
 * Block template file: template-parts/blocks/supply-media.php
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
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php if ( $image ) : 
        $blockContent ='<img src="'. esc_url( $image['url'] ) .'" class="img-responsive" alt="'.esc_attr( $image['alt'] ) .'" />';
    endif;
    if ( $vimeoVideo ) : 
            $blockContent = video_containers($vimeoVideo, $vimeo_video_mobile, $video_ratio);
    endif;
    if ( have_rows( 'column_placement' ) ) :
        while ( have_rows( 'column_placement' ) ) : the_row();
            echo supply_grid($blockContent, 'col-dlg-12');
        endwhile;
    endif;
    if ( is_admin() ) {
    // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
    echo '<button style="position: absolute;right: 10%;padding: 2rem;top: 20%;">Click here to edit this Media Block </button>';
} 
?>
</div>