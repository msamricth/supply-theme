<?php
/**
 * Block template file: templates/blocks/supply-content-block.php
 *
 * Supply Content Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-posts-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-posts-content-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$Utils = '';
$classes .=' fadeNoScroll';
$row = '';

    if ( have_rows( 'fold_settings' ) ) :
        while ( have_rows( 'fold_settings' ) ) : the_row(); 
            if(get_sub_field( 'custom_bg_color' )){
                    $customColor = get_sub_field( 'custom_bg_color' );
                    $customText = get_sub_field('custom_text_color');
                    if($customText) {
                        $customText = 'data-color="'.$customText.'"';
                    } else {
                        $customText = 'data-color="default"';
                    }
                    $row .= ' fold-custom';
                    $Utils .=' data-bg="'.$customColor.'" '. $customText;
            }
            if(get_sub_field( 'fold_color' )){
                    $row.= ' fold';
                    $foldClass = 'bg-' . get_sub_field( 'fold_color' );
                    $Utils .=' data-class="'. $foldClass .'"';
            }
            
        endwhile;
	endif; ?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
<?php 
$post_IDs = '';
$args = '';

if ( have_rows( 'define_your_own_loop' ) ) : 
    while ( have_rows( 'define_your_own_loop' ) ) : the_row(); 
        $post = get_sub_field( 'post' ); 
        if ( $post ) : 
            $post_IDs .= $post . ', ';
        endif; 
    endwhile; 
else : 
    // No rows found 
endif; ?>


<?php if ( get_field( 'use_default_loop' ) == 1 ) : 
    $args = array(
        'post_type' => array('post', 'external-link', 'case-studies'),
        'posts_per_page' => 4
    );   
else :
    $args = array(
        'post_type' => array('post', 'external-link', 'case-studies'),
        'posts_per_page' => 4,
        'post__in' => [$post_IDs]
    );
endif; ?>
<?php
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
    <div class="container home-loop-section fadeNoScroll cp4">
        <div class="row <?php echo $row?>" <?php echo $Utils;?>>
            <div class="col-dlg-10 offset-dlg-1">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $post_type = get_post_type();
                    $pclasses = 'cp3 fadeNoScroll ' . $row;
                    get_template_part('templates/_content', $post_type, array( 
                        'classes' => $pclasses,
                        'utilities' => $Utils,
                        ) 
                       );
                endwhile; ?>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
</div>