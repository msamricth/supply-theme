<?php
/**
 * Sidebar Template.
 */
$post_slug = get_post_field( 'post_name', get_post() ); 

if ( is_active_sidebar( 'widget_area_for_page_'.$post_slug ) ) : 
?>
</div>
</div>
</div>
<div id="sidebar-<?php the_ID(); ?>">
	<?php dynamic_sidebar( 'widget_area_for_page_'.$post_slug );
	if ( current_user_can( 'manage_options' ) ) :?>
		<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge badge-secondary"><?php esc_html_e( 'Edit', 'supply' ); ?></a></span><!-- Show Edit Widget link -->
	<?php endif; ?>
<?php endif; ?>