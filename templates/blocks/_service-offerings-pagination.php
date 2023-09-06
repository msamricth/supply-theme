<?php
/**
 * Block template file: templates/blocks/_service-offerings-pagination.php
 *
 * Supply Pagination Block Sub Template for Service Offerings
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
global $post;
$prevPost = get_previous_post();
$nextPost = get_next_post();
$left_case_study = '';
$right_case_study = '';
$foldUtils = '';
$post_id = '';
$current_post = get_queried_object();
$post_id = $current_post ? $current_post->ID : null;	
$args = [];
$currentID = get_the_ID();
$count=0;

if (isset($post_type)) {
    $args = array(
        'post_type' => $post_type
    );   
} else {
    $args = array(
        'post_type' => array('service-offerings')
    ); 
}  
$currentOffering = '';
$the_query = new WP_Query( $args );
?>


<div class="single-service-offerings__pagination supply-pagination fadeNoScroll">
    <?php if(get_field('pagination_heading')){ ?>
        <h6 class="pe-4"><?php the_field('pagination_heading'); ?></h6>
    <?php } ?>
    <div class="accordion accordion-flush subnav bg-transparent" id="pagination">
        <?php if ( $the_query->have_posts() ) :
         while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
         $post_id = url_to_postid(get_the_permalink());
             $slug = get_post_field( 'post_name', $post_id );
             if (isset($currentID)) {
                 $postID = get_the_ID();
                 if($currentID == $postID) {
                     $currentOffering = 'true';
                 } else {

                    $currentOffering = '';
                 }
             } 
             if(empty($currentOffering)){ ?>
             <div class="accordion-item">
                <h5 class="accordion-header">
                <button class="accordion-button collapsed justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#pagination-<?php echo $count;?>" aria-expanded="false" aria-controls="pagination-<?php echo $count;?>">
                    <?php the_title(); ?>
                    <div class="accordion-icon"></div>
                </button>
                </h5>
                <div id="pagination-<?php echo $count;?>" class="accordion-collapse collapse" data-bs-parent="#pagination">
                    <div class="accordion-body">
                        <div class="accordion-body--text">
                            <?php echo the_so_excerpt($post_id);?>
                        </div>
                        <a href="<?php echo get_the_permalink(); ?>" id="subnav-<?php echo $post_id; ?>" data-slug="/<?php echo $slug;?>" class="d-flex  internal-link" title="<?php echo get_the_title(); ?>" rel="bookmark" data-title="<?php the_title(); ?>">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
             <?php  }
         endwhile; 
         wp_reset_postdata();
      endif; 
      ?>
    </div>
</div>