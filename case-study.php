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
            </section>
        </article>
<?php 
    endwhile;
endif;

wp_reset_postdata();?>
<div>
<?php get_footer();
