<?php
/**
 * The template for displaying content in the single.php template.
 *
 */

 $share_text = get_field('share_text','options'); 
 $fold_utils = '';
 if(empty( $share_text)){
	$share_text = 'Share this article';
 }
 $scheme = get_field('background_color');
	if($scheme){
		if(strpos($scheme, 'pattern') !== false){
			$scheme = 'bg-light bg-pattern';
		} else {
			$scheme = 'bg-'. $scheme . ' ';
		}
	} else {
		$scheme = 'bg-light';
	}
	$fold_classes = 'fold article-content text-dark '.$scheme;
	$fold_utils = 'data-class="'.$scheme.'"';
	if(strpos($scheme, 'custom') !== false){
		$custom_text_color = get_field('custom_text_color');
		$custom_bg_color = get_field('custom_bg_color');
		if($custom_bg_color){
			$fold_utils .= ' data-bg="'.$custom_bg_color.'"';
			//$fold_classes = 'fold';
		}
		if($custom_text_color) {
			$fold_utils .= ' data-color="'.$custom_text_color.'"';
		}
	
	}
?>

<div class="<?php echo $fold_classes; ?>" <?php echo $fold_utils; ?>>
	<div class="container">
		<div class="row">
			<div class="order-1 order-md-2 col-md-9 offset-md-1 col-3xl-6 col-dlg-7 col-4xl-6 entry-content" id="article">
				<?php
					
					the_content();

					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'supply' ) . '</span>', 'after' => '</div>' ) );
				?>
				<p class="d-md-none"><span class="seperator"></span></p>
			</div><!-- /.entry-content -->
			<div class="order-2 order-md-1 col-md-2 col-dlg-3 offset-dlg-1">
				
			
				<div class="sidbar-meta">
					<div class="contents">
						<?php the_title('<span class="h6 d-none d-dlg-block">','</span>'); ?>
						<h5 class="d-md-none"><?php echo $share_text; ?></h5>
						<?php echo supply_share_buttons(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
	if ( is_admin() ) { ?><style>.d-none {display:none !important} </style> <?php } ?>
<section class="d-none estimate" id="estimate-<?php the_ID(); ?>"><?php echo wp_strip_all_tags( get_the_content() ); ?></section>
