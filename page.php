<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the right side.
 *
 */

get_header();

the_post();


?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
	<?php get_template_part('templates/_page_header'); ?>
		<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
					'after'  => '</div>',
				)
			);
			edit_post_link( esc_html__( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
		?>
	</div>
	<?php get_sidebar( 'primary' ); ?>
</div><!-- /#post-<?php the_ID(); ?> -->
<?php
get_footer();
