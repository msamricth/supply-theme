<?php
/**
 * The Template for displaying all external pages.
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
        $redirect_URL = get_field( 'url' ); 
        echo '<script>window.location.replace("'.$redirect_URL.'");</script>';
	endwhile;
endif;

wp_reset_postdata();

get_footer();
