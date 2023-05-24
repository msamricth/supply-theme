<?php
/**
 * The template for displaying content in the single.php template.
 *
 */

 $share_text = get_field('share_text','options'); 
 if(empty( $share_text)){
	$share_text = 'Share this article';
 }
?>


<div class="container">
	<div class="row">
		<div class="order-1 order-md-2 col-md-9 offset-md-1 col-4xl-7 col-dlg-8 col-xl-7 col-4xl-6 entry-content" id="article">
			<?php
				
				the_content();

				wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'supply' ) . '</span>', 'after' => '</div>' ) );
			?>
			<p class="d-md-none"><span class="seperator"></span></p>
		</div><!-- /.entry-content -->
		<div class="order-2 order-md-1 col-md-2 col-dlg-3 offset-4xl-1">
			
		
			<div class="sidbar-meta">
				<?php the_title('<span class="h6 d-none d-dlg-block">','</span>'); ?>
				<h5 class="d-md-none"><?php echo $share_text; ?></h5>
				<?php echo supply_share_buttons(); ?>
			</div>
		</div>
	</div>
</div>

<?php edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
	if ( is_admin() ) { ?><style>.d-none {display:none !important} </style> <?php } ?>
<section class="d-none estimate" id="estimate-<?php the_ID(); ?>"><?php echo wp_strip_all_tags( get_the_content() ); ?></section>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
	<div class="d-flex">
		<div class="toast-body">
		Article url copied!
		</div>
		<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	</div>
  </div>
</div>