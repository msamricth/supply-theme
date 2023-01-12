<?php
/**
 * Block template file: templates/blocks/supply-pagination-block.php
 *
 * Supply Pagination Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
global $post;
$prevPost = get_previous_post();
$nextPost = get_next_post();
// Create id attribute allowing for custom "anchor" value.
$id = 'supply-pagination-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-pagination-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$left_case_study = '';
$right_case_study = '';
$classes .= ' fadeNoScroll';
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
                        } else {
                            $foldColor = 'light';
                        }
                    }
                    $foldClass = 'bg-' . $foldColor;
                    $foldUtils .=' data-class="'. $foldClass .'"';
            }
            
        endwhile;

else:
    

endif; 
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" <?php echo $foldUtils; ?>>
    <div class="single-case-studies__pagination supply-pagination fadeNoScroll">
        <h5 class="cp1 pe-4">More Work</h5>
        <div class="row g-0">
            <div class="col-md-6 position-relative">
                <?php $left_case_study = get_field( 'left_case_study' ); ?>
                <?php if ( $left_case_study ) : ?>
                        <?php $post = $left_case_study; ?>
                        <?php setup_postdata( $post ); 
                            $post_type = get_post_type();
                            get_template_part('templates/_content', $post_type);
                            ?> 
                        <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <?php if ( $prevPost ) : ?>
                        <?php $post = $prevPost->ID; ?>
                        <?php setup_postdata( $post ); 
                            $post_type = get_post_type();
                            get_template_part('templates/_content', $post_type);
                            ?> 
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            
            <div class="col-md-6 position-relative right-case-study">
                <?php $right_case_study = get_field( 'right_case_study' ); ?>
                <?php if ( $right_case_study ) : ?>
                    <?php $post = $right_case_study; ?>
                    <!--acf field-->
                    <?php setup_postdata( $post ); 
                        $post_type = get_post_type();
                        get_template_part('templates/_content', $post_type);
                        ?> 

                    <?php wp_reset_postdata(); ?>
            
                <?php else: ?>
                    <?php if ( $nextPost ) : ?>
                        <?php $post = $nextPost->ID; ?>
                        <!--automated data not acf field-->
                        <?php setup_postdata( $post ); 
                        
                            $post_type = get_post_type();
                            get_template_part('templates/_content', $post_type);
                            ?> 
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>