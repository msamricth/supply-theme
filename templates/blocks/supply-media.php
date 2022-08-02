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
$classes = 'block-supply-media';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$vimeoVideo = get_field('vimeo_video');
$mediaSizing = get_field( 'sizing' );
$image = get_field( 'image' );
$video_ratio = get_field('video_ratio');
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
<?php if ( $image ) : 
        ?>
    
    <img src="<?php echo esc_url( $image['url'] ); ?>" class="<?php if($mediaSizing) { echo $mediaSizing; } ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
<?php endif; ?>
<?php if ( $vimeoVideo ) : ?> 
    <div class="ratio <?php echo $video_ratio; ?>">
        <?php echo background_video($vimeoVideo); ?>
    </div>
<?php endif; ?>
</div>