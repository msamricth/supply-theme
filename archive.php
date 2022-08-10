<?php
/**
 * The Template for displaying Archive pages.
 */

get_header();

if ( have_posts() ) :
?>
<header class="page-header">
	<h1 class="page-title">
		<?php
		if( is_post_type_archive('careers') )
		{
			echo '<h3>Careers</h3>';
		} else {
			if ( is_day() ) :
				printf( esc_html__( 'Daily Archives: %s', 'supply' ), get_the_date() );
			elseif ( is_month() ) :
				printf( esc_html__( 'Monthly Archives: %s', 'supply' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'supply' ) ) );
			elseif ( is_year() ) :
				printf( esc_html__( 'Yearly Archives: %s', 'supply' ), get_the_date( _x( 'Y', 'yearly archives date format', 'supply' ) ) );
			else :
				esc_html_e( 'Blog Archives', 'supply' );
			endif;
		} ?>
	</h1>
</header>
<?php
	get_template_part( 'archive', 'loop' );
else :
	// 404.
	get_template_part( 'content', 'none' );
endif;

wp_reset_postdata(); // End of the loop.

get_footer();
