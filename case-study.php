<?php
/**
 * The Template for displaying all external pages.
 */

get_header();

// settings
$classes = '';
$client_logo = '';
$deep_dive = '';
$header_video = '';
$header_video_mobile = '';
$url_to_work = '';
$title_of_work_performed = '';
$intro_blurb = '';
$header_image = '';
$classes .= 'case-study ';
$prevPost = '';
$nextPost = '';
$subClasses = '';
// start
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); 
            $prevPost = get_previous_post();
            $nextPost = get_next_post();

            $client_logo = get_field( 'client_logo' );

            if ( have_rows( 'header_media' ) ) :
                while ( have_rows( 'header_media' ) ) : the_row();
                    $header_video =  get_sub_field( 'video' );
                    $header_video_mobile = get_sub_field( 'video_mobile' );
                    $header_image = get_sub_field( 'image' ); 
                endwhile;
            endif;
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <?php if($header_video) : ?>
                <div class="header-container fold" data-class="header">
                    <?php echo video_containers($header_video, $header_video_mobile, '4x3', '1x1'); ?>
                </div>

            <?php else : ?>
                <?php if ( $header_image ) : ?>
                    <div class="header-container ratio ratio-16x9 fold" data-class="header">
					    <img src="<?php echo esc_url( $header_image['url'] ); ?>" alt="<?php echo esc_attr( $header_image['alt'] ); ?>" />
                    </div>
				<?php endif; ?>
                
			<?php endif; ?>
            <section class="entry " id="content">
                    <div class="container editor-content nav-catch">
                        <?php the_content(); ?>
                    </div>
                <div class="single-case-studies__pagination supply-pagination container  fadeNoScroll">
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
                        <div class="col-md-6 position-relative">
                            <?php $right_case_study = get_field( 'right_case_study' ); ?>
                            <?php if ( $right_case_study ) : ?>
                                <?php $post = $right_case_study; ?>
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
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </article>
<?php 
    endwhile;
endif;

wp_reset_postdata();?>
<div>
<?php get_footer();
