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
$subClasses = 'bg-dark text-white';
// start
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); 
            $prevPost = get_previous_post();
            $nextPost = get_next_post();
            if ( get_field( 'deep_dive' ) == 1 ) :
                $deep_dive = 1;
                $classes .= ' ' . $subClasses;
            endif;
            $client_logo = get_field( 'client_logo' );

            if ( have_rows( 'header_media' ) ) :
                while ( have_rows( 'header_media' ) ) : the_row();
                    $header_video =  get_sub_field( 'video' );
                    $header_video_mobile = get_sub_field( 'video_mobile' );
                    $header_image = get_sub_field( 'image' ); 
                endwhile;
            endif;
            $url_to_work = get_field( 'url_to_work' );
            $title_of_work_performed = get_field( 'title_of_work_performed' );
            $intro_blurb = get_field( 'intro' );
            if ( $url_to_work ) : 
            endif;
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <?php if($header_video) : ?>
                <div class="header-container">
                    <?php echo video_containers($header_video, $header_video_mobile, '4x3'); ?>
                </div>

            <?php else : ?>
                <?php if ( $header_image ) : ?>
                    <div class="header-container ratio ratio-16x9">
					    <img src="<?php echo esc_url( $header_image['url'] ); ?>" alt="<?php echo esc_attr( $header_image['alt'] ); ?>" />
                    </div>
				<?php endif; ?>
                
			<?php endif; ?>
            <section class="entry fold-container <?php echo $subClasses; ?>" id="content">
                <?php if(!$deep_dive):?><div class="fold" data-class="bg-light"></div><?php else:?><div class="fold" data-class="bg-dark"></div><?php endif; ?>
                <div class="container fadeNoScroll fold"<?php if(!$deep_dive):?> data-class="bg-light"<?php else: ?> data-class="bg-dark"<?php endif; ?>>
                    <div class="row">
                        <div class="col-md-12 col-xl-10 offset-xl-1">
                            <?php if ( $client_logo ) : ?>
                                <img class="img-responsive client-logo fadeNoScroll" src="<?php echo esc_url( $client_logo['url'] ); ?>" alt="<?php echo esc_attr( $client_logo['alt'] ); ?>" />
                            <?php endif; ?>
                            <?php if ( $title_of_work_performed ) : ?>
                                <h3 class="entry-title fadeNoScroll"><?php echo $title_of_work_performed; ?></h3>
                            <?php else :?>
                                <h3 class="entry-title fadeNoScroll"><?php the_title(); ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-xl-7 offset-xl-1 case-study-left">         
                            <?php if ( $intro_blurb ) : ?> 
                                <div class="intro-content">
                                    <?php echo $intro_blurb; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $url_to_work ) : ?>  
                                <p>
                                    <a href="<?php echo $url_to_work; ?>" target="_blank" class="link-up">
                                        <?php the_title(); ?>
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4 col-dlg-3 offset-dlg-1 col-xl-2 case-study-right">
                            <div class="row mx-sm-0 g-1 g-sm-0">
                                <?php $i = 0; $j = count( get_field('add_new_specialty') );?>
                                <?php if ( have_rows( 'add_new_specialty' ) ) : ?>
                                <ul class="col-sm-4 specialties col-lg-12 mb-0">
                                    <?php while ( have_rows( 'add_new_specialty' ) ) : the_row(); ?>
                                        <li><?php the_sub_field( 'specialty' ); ?></li>
                                        <?php if ( ( $i + 1 ) == ceil($j / 2) ) echo '</ul><ul class="col-sm-4 mb-0 specialties col-lg-12">'; ?>
                                    <?php $i++; endwhile; ?>
                                </ul>
                                <?php else : ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($deep_dive):?>
                    <div class="container editor-content nav-catch">
                        <?php the_content(); ?>
                    </div>
                    <?php endif;
                    if(!$deep_dive):
                        get_template_part('templates/case-studies/_light', 'content');
                    endif; ?>
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
