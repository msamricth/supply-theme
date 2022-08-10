<?php
/**
 * The template for displaying the archive loop.
 */

supply_content_nav( 'nav-above' );

if ( have_posts() ) :
?>
	<div class="row">
	<?php
		while ( have_posts() ) :
			the_post();
			$post_type = get_post_type();
			if ( $post_type )
			{
				get_template_part('templates/_content', $post_type);
			} else {
				/**
				 * Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', 'index' ); // Post format: content-index.php
			}
		endwhile;
	?>
	</div>
<?php
endif;

wp_reset_postdata();

supply_content_nav( 'nav-below' );
