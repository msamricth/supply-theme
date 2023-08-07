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

?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo get_block_settings($classes) ?>">
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
                    <?php if ( $nextPost ) : ?>
                        <?php $post = $nextPost->ID; ?>
                        <?php setup_postdata( $post ); 
                            $post_type = get_post_type();
                            get_template_part('templates/_content', $post_type);
                            ?> 
                        <?php wp_reset_postdata(); ?>
                    <?php else: 
                        if ( empty( $nextPost ) ) {
                            $args = array(
                                'numberposts' => 1, 'post_type' => 'case-studies', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => '1'
                            );
                            $first_post = $last_post = null;
                            // last post
                            $last_post_query = new WP_Query( $args + array( 'order' => 'ASC' ) );
                            if ( $last_posts = $last_post_query->get_posts() ) {
                                $last_post = array_shift( $last_posts );
                            }
                            $post = $last_post->ID; 
                             
                            setup_postdata( $post ); 
                                $post_type = get_post_type();
                                get_template_part('templates/_content', $post_type);
                                
                            wp_reset_postdata(); 
                        }
                    endif; ?>
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
                    <?php if ( $prevPost ) : ?>
                        <?php $post = $prevPost->ID; ?>
                        <!--automated data not acf field-->
                        <?php setup_postdata( $post ); 
                        
                            $post_type = get_post_type();
                            get_template_part('templates/_content', $post_type);
                            ?> 
                        <?php wp_reset_postdata(); ?>
                        <?php else: 
                        if ( empty( $prevPost ) ) {
                            $args = array(
                                'numberposts' => 1, 'post_type' => 'case-studies', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => '1'
                            );
                            $first_post = $last_post = null;
                            // get first post
                            $first_post_query = new WP_Query( $args + array( 'order' => 'DESC' ) );
                            if ( $first_posts = $first_post_query->get_posts() ) {
                                $first_post = array_shift( $first_posts );
                            }
                            $post = $first_post->ID;
                            
                            setup_postdata( $post ); 
                                $post_type = get_post_type();
                                get_template_part('templates/_content', $post_type);
                                
                            wp_reset_postdata(); 
                        }
                    endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>