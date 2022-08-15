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
		<div class="nav-catch">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
					'after'  => '</div>',
				) );
				edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
			?>
		</div>
</div><!-- /#post-<?php the_ID(); ?> -->
<?php
get_footer();
