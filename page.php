<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
 *
 */

get_header();

the_post();
?>
<div class="row">
	<div class="col-md-8 order-md-2 col-sm-12">
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
		<?php get_template_part('templates/_header', 'partials'); ?>
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
		</div><!-- /#post-<?php the_ID(); ?> -->
	</div><!-- /.col -->
</div><!-- /.row -->
<?php
get_footer();
