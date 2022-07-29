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
        
        if ( have_rows( 'settings' ) ) :
            while ( have_rows( 'settings' ) ) : the_row();
                if ( get_sub_field( 'deep_dive' ) == 1 ) :
                    $deep_dive = 1;
                    $classes .= 'bg-dark text-white';
                endif;
                $client_logo = get_sub_field( 'client_logo' );

                if ( have_rows( 'header_media' ) ) :
                    while ( have_rows( 'header_media' ) ) : the_row();
                        $header_video =  get_sub_field( 'video' );
                        $header_video_mobile = get_sub_field( 'video_mobile' );
                        $header_image = get_sub_field( 'image' ); 
                    endwhile;
                endif;
                $url_to_work = get_sub_field( 'url_to_work' );
                $title_of_work_performed = get_sub_field( 'title_of_work_performed' );
                $intro_blurb = get_sub_field( 'intro' );
                
            endwhile;
        endif;

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
            <section class="entry py-9">
                <div class="light-fold fold">
                    <?php if ( $client_logo ) : ?>
                        <img src="<?php echo esc_url( $client_logo['url'] ); ?>" alt="<?php echo esc_attr( $client_logo['alt'] ); ?>" />
                    <?php endif; ?>
                    
                    <?php if ( $client_logo ) : ?>
                        <h3 class="entry-title"><?php echo $title_of_work_performed; ?></h3>
                    <?php else :?>
                        <h3 class="entry-title"><?php the_title(); ?></h3>
                    <?php endif; ?>

                    <?php if ( $intro_blurb ) : ?> 
                        <p><?php echo $intro_blurb; ?></p>
                    <?php endif; ?>

                    <?php if ( $url_to_work ) : ?> 
                        <p><a href="<?php echo $url_to_work; ?>" target="_blank"><?php the_title(); ?></a></p>
                    <?php endif; ?>
                </div>
            </section>
        </article>
<?php 
    endwhile;
endif;

wp_reset_postdata();

get_footer();
