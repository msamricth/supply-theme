<?php
/**
 * Block template file: templates/blocks/supply-call-to-action.php
 *
 * Supply Logo Garden Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-call-to-action-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-call-to-action';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .= ' fadeNoScroll';
$ctaTitle = get_field( 'cta_title' ); 
$cta_link = get_field( 'cta_link' ); 
$ctaCustumLinkText = get_field( 'cta_link_text' ); 

$foldUtils = '';

if ( have_rows( 'fold_settings' ) ) :
    while ( have_rows( 'fold_settings' ) ) : the_row(); 
        if(get_sub_field( 'color' )){
            $classes.= ' fold';
                $foldClass = 'bg-' . get_sub_field( 'color' );
                $foldUtils .=' data-class="'. $foldClass .'"';
        }
        if(get_sub_field( 'custom_bg_color' )){
                $customColor = get_sub_field( 'custom_bg_color' );
                $customText = get_sub_field('custom_text_color');
                if($customText) {
                    $customText = 'data-color="'.$customText.'"';
                } else {
                    $customText = 'data-color="default"';
                }
                $classes .= ' fold-custom';
                $foldUtils .=' data-bg="'.$customColor.'" '. $customText;
        }
        
    endwhile;
endif; 

?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>"<?php echo $foldUtils; ?>>
    <div class="spacer cp4"></div>
    <?php get_template_part('templates/_cta', 'partials'); ?>
</div>