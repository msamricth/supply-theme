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
$vimeo_video_mobile = '';
$vimeoVideo = '';
$vimeoVideo = get_field('vimeo_video');
$image = get_field( 'image' );
$video_ratio = get_field('video_ratio');
$vimeo_video_mobile = get_field('vimeo_video_mobile');
$width_in_columns = ''; 
$offset_in_columns = ''; 
$breakpoint_aspect = ''; 
$BA_width_in_columns = ''; 
$BA_offset_in_columns = ''; 
$BA_hide_media = ''; 
$row_class = "";
$sub_classes = '';
$classes .=' fadeNoScroll';
if ( have_rows( 'desktop_settings' ) ) : 
    while ( have_rows( 'desktop_settings' ) ) : the_row(); 
        $width_in_columns = get_sub_field( 'width_in_columns' ); 
        $offset_in_columns = get_sub_field( 'offset_in_columns' ); 
        if($width_in_columns) {
            
            if(strpos($width_in_columns, 'container') !== false){
              
            } else {
                $sub_classes .= ' col-dlg-' . $width_in_columns;
                if($offset_in_columns) {
                    if(strpos($offset_in_columns, 'Center') !== false){
                        $sub_classes .= ' mx-dlg-auto';
                    } else {
                        $sub_classes .= ' offset-dlg-' . $BA_offset_in_columns;
                    }
                }
            }
        } else {
            $sub_classes .= ' col-dlg-12';
        }
        if ( get_sub_field( 'display_guttercontainer_offset' ) == 1 ) : 
            $row_class .= 'container-dlg mx-auto';
        else : 
            // echo 'false'; 
        endif; 
    endwhile; 
endif; 
if ( have_rows( 'breakpoints_optional' ) ) : 
    while ( have_rows( 'breakpoints_optional' ) ) : the_row(); 
        $breakpoint_aspect = get_sub_field( 'breakpoint_aspect' ); 
        $BA_width_in_columns = get_sub_field( 'width_in_columns' ); 
        $BA_offset_in_columns = get_sub_field( 'offset_in_columns' ); 
        $BA_hide_media = get_sub_field( 'hide_media' ); 
        $sub_classes .= ' col-' . $breakpoint_aspect . '-' . $BA_width_in_columns;
        
        if($BA_offset_in_columns) {
            if(strpos($BA_offset_in_columns, 'Center') !== false){
                $sub_classes .= ' mx-'. $breakpoint_aspect . '-auto';
            } else {
                $sub_classes .= ' offset-'. $breakpoint_aspect . $BA_offset_in_columns;
            }
        }
        if ( get_sub_field( 'display_guttercontainer_offset' ) == 1 ) : 
            if(strpos($breakpoint_aspect, 'xs') !== false){
                $row_class .=  ' container';
            } else {
                $row_class .=  ' container-'. $breakpoint_aspect . '  mx-auto';
            }
        else : 
            // echo 'false'; 
        endif; 
    endwhile; 
else : 
    // No rows found 
endif; 
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="<?php echo $row_class; ?>">
        <div class="row g-0">
            <div class="<?php echo $sub_classes; ?>">
                <?php if ( $image ) : ?>    
                    <img src="<?php echo esc_url( $image['url'] ); ?>" class="img-responsive" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                <?php endif; ?>
                <?php if ( $vimeoVideo ) : ?> 
                    <?php echo video_containers($vimeoVideo, $vimeo_video_mobile, $video_ratio); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>