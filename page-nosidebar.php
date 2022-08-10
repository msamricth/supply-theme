<?php
/**
 * Template Name: Page (No Sidebar)
 * Description: Page template with no sidebar.
 *
 */

get_header();

the_post();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
		<?php get_template_part('templates/_header', 'partials'); ?>
	<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
			'after'  => '</div>',
		) );
		edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
	?>
</div><!-- /#post-<?php the_ID(); ?> -->
<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

get_footer();
