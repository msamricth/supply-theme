<?php
/**
 * Block template file: templates/blocks/supply-padding-block.php
 *
 * Supply Padding Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-padding-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-padding-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$foldUtils = '';
$post_id = '';
$current_post = get_queried_object();
$post_id = $current_post ? $current_post->ID : null;	
$scheme = get_field('background_color', $post_id);
    if ( have_rows( 'fold_settings' ) ) :
        $classes .= ' fold';
        while ( have_rows( 'fold_settings' ) ) : the_row(); 
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
            if(get_sub_field( 'fold_color' )){
                    $foldColor = get_sub_field('fold_color');        
                    if(strpos($foldColor, 'page') !== false){
                        if($scheme){
                            $foldColor = $scheme;
                        }
                    }
                    $foldClass = 'bg-' . $foldColor;
                    $foldUtils .=' data-class="'. $foldClass .'"';
            }
            
        endwhile;

else:
    
if($scheme){
    $foldUtils .=' data-class="bg-'. $scheme .'"';
} else {
    $foldUtils .=' data-class="bg-light"';
}
endif; 
$padding_size = get_field( 'padding_size' ); 
?>

<?php if ( have_rows( 'custom_size' ) ) : ?>
    <style type="text/css">
        <?php while ( have_rows( 'custom_size' ) ) : the_row(); ?>
            <?php echo '#' . $id; ?> .padding-block {
                padding-bottom:<?php the_sub_field( 'custom_size' ); ?>px;
            }
            <?php if ( have_rows( 'breakpoint_overrides' ) ) : ?>
                <?php while ( have_rows( 'breakpoint_overrides' ) ) : the_row(); ?>
                @media (min-width: <?php the_sub_field( 'breakpoint' ); ?>){
                    <?php echo '#' . $id; ?> .padding-block {
                        padding-bottom:<?php the_sub_field( 'custom_size' ); ?>px;
                    }
                }
                <?php endwhile; ?>
            <?php else : ?>
                <?php // No rows found ?>
            <?php endif; ?>
        <?php endwhile; ?>
    </style>
<?php endif; ?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" <?php echo $foldUtils;?>>
    <div class="padding-block <?php echo $padding_size; ?>"></div>
    <?php    if ( is_admin() ) {
    // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
    echo '<button style="padding: 2rem;margin-top: 20px;">Click here to edit this Padding Block </button>';
} 
?>
</div>