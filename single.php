<?php
/**
 * The Template for displaying all single posts.
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php 
			get_template_part('templates/_page_header');
			
			get_template_part( 'content', 'single' ); 
			?>
		</article><!-- /#post-<?php the_ID(); ?> -->
		<?php get_template_part( 'templates/_related_articles' ); 		
	endwhile;
endif;

get_footer();
