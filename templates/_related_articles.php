<?php 

$post_IDs = '';
$classes = 'related-articles ';
$background_color = get_field('articles__background_color');
if(empty($background_color)){
    $background_color = '#213333';
}
if($background_color == "light"){
    
    $background_color = '#ffffff';
}
$rgb = HTMLToRGB($background_color);
$hsl = RGBToHSL($rgb);
if($hsl->lightness > 200) {
// this is light colour!
    $classes .= ' text-primary';
} else {
    $classes .= ' text-white';
}


$scheme = get_field('background_color');
// Create class attribute allowing for custom "className" and "align" values.
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$classes .=' fadeNoScroll';

$related_posts = get_field( 'related_post' ); 
if ( $related_posts ) : 
	foreach ( $related_posts as $related_post_id ) : 
        $post_IDs .= $related_post_id . ', ';
	endforeach; 
endif; 

       // for debug in future use var_dump echo '<script>console.log('.$post_IDs.');</script>';


$post_IDs = array_map( 'trim', explode( ',', $post_IDs ) ); // right

    if ( get_field( 'use_default_loop' ) == 1 ) : 
        $args = array(
            'post_type' => array('post'),
            'posts_per_page' => 2
        );   
    else :
        $args = array(
            'post_type' => array('post'),
            'posts_per_page' => 2,
            'post__in' => $post_IDs
            
        );

       // for debug in future use var_dump echo '<script>console.log('.$post_IDs.');</script>';
    endif; 


?>
<?php
$the_query = new WP_Query( $args ); ?>
<div class="<?php echo $classes; ?>" style="background-color: <?php echo $background_color; ?>">
    <?php if ( $the_query->have_posts() ) : $postCount = 1; ?>
        <div class="container posts-loop-section">
            <div class="row">
                <div class="col-md-12 col-dlg-11 offset-dlg-1">
                    <h4>Related Articles</h4>
                </div>
                <?php while ( $the_query->have_posts() ) : $postCount++; $the_query->the_post(); ?>
                    <div class="col-md-6 col-dlg-5<?php if($postCount == 2) { ?> offset-dlg-1<?php } ?>">
                        <?php $post_type = get_post_type(); get_template_part('templates/_content', $post_type); ?>
                    </div>  
                    <?php if($postCount == 2) { ?><p class="d-md-none sep-con"><span class="seperator"></span></p><?php } ?>
                <?php  endwhile; ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>