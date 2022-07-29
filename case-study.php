<?php
/**
 * The Template for displaying all external pages.
 */

get_header();

// settings
$classes = '';
$client_logo = '';
$deep_dive = '';
$header_video_desktop = '';
$header_video_mobile = '';
$url_to_work = '';
$title_of_work_performed = '';
$intro_blurb = '';
$header_image = '';
$classes .= 'case-study ';

// start
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); 
            if ( get_field( 'deep_dive' ) == 1 ) :
                $deep_dive = 1;
                $classes .= 'bg-dark text-white';
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

        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <?php if($header_video) : ?>
                <div class="header-container ratio ratio-16x9 <?php if($header_video_mobile){echo 'd-none d-md-block';} ?>">
                <?php echo background_video($header_video); ?>
                </div>
                <div class="header-container d-md-none ratio ratio-4x3">
                    <?php echo background_video($header_video_mobile); ?>
                </div>

            <?php else : ?>
                <?php if ( $header_image ) : ?>
                    <div class="header-container ratio ratio-16x9">
					    <img src="<?php echo esc_url( $header_image['url'] ); ?>" alt="<?php echo esc_attr( $header_image['alt'] ); ?>" />
                    </div>
				<?php endif; ?>
                
			<?php endif; ?>
            <section class="entry py-9" id="content">
                <?php if(!$deep_dive):?><div class="fold" data-class="bg-light"></div><?php endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ( $client_logo ) : ?>
                                <img class="img-responsive client-logo" src="<?php echo esc_url( $client_logo['url'] ); ?>" alt="<?php echo esc_attr( $client_logo['alt'] ); ?>" />
                            <?php endif; ?>
                            <?php if ( $title_of_work_performed ) : ?>
                                <h3 class="entry-title"><?php echo $title_of_work_performed; ?></h3>
                            <?php else :?>
                                <h3 class="entry-title"><?php the_title(); ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-3xl-9">         
                            <?php if ( $intro_blurb ) : ?> 
                                <p><?php echo $intro_blurb; ?></p>
                            <?php endif; ?>

                            <?php if ( $url_to_work ) : ?> 
                                <p><a href="<?php echo $url_to_work; ?>" target="_blank"><?php the_title(); ?></a></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4 col-3xl-3">
                        <?php if ( have_rows( 'add_new_specialty' ) ) : ?>
                            <ul class="specialties">
                            <?php while ( have_rows( 'add_new_specialty' ) ) : the_row(); ?>
                                <li><?php the_sub_field( 'specialty' ); ?></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php else : ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </article>
<?php 
    endwhile;
endif;

wp_reset_postdata();

get_footer();
