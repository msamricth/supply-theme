<?php
/**
 * Sidebar Template.
 */
if ( is_active_sidebar( 'primary' ) ) : 
?>
<div id="sidebar-<?php the_ID(); ?>" class="sidebar offset-3xl-3 col-3xl-3 col-lg-4 col-dlg-3 col-xl-4 offset-dlg-1 order-1 order-dlg-2 cp3">
	<?php dynamic_sidebar( 'primary');
	if ( current_user_can( 'manage_options' ) ) :?>
		<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge badge-secondary"><?php esc_html_e( 'Edit', 'supply' ); ?></a></span><!-- Show Edit Widget link -->
	<?php endif; ?>
</div>
<?php endif; ?>