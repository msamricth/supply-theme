<?php
/**
 * Template Name: Not found
 * Description: Page template 404 Not found.
 *
 */

get_header();
$padding_block = '';
$fofTitle = '';
$link = '';
$linkClass = '';
$linkTitle = '';
$search_enabled = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
if ( have_rows( '404_page_settings', 'option' ) ) : 
	while ( have_rows( '404_page_settings', 'option' ) ) : the_row(); 
		$fofTitle = get_sub_field( '404_title' ); 
		$linkTitle = get_sub_field( 'link_text' );
		$page_lookup = get_sub_field( 'page_lookup' ); 
		$linkURL = get_sub_field( 'url' );
		if ( have_rows( 'options' ) ) :
			while ( have_rows( 'options' ) ) : the_row(); 
				$padding_block = get_sub_field( 'padding_bottom' ); 

				if ( get_sub_field( 'use_url' ) == 1 ) {
					if (isset($linkURL)) {
						$link = $linkURL;
					}
					if(empty($linkTitle)){
						$linkTitle = 'Learn More';
					}
				} else {
					if ( $page_lookup ) : 
						$link = get_permalink( $page_lookup );
						if(empty($linkTitle)){
							$linkTitle = get_the_title( $page_lookup );
						}
					endif; 
				}
				if ( get_sub_field( 'external_url' ) == 1 ) :
					$linkClass = 'link-up';
				endif;
			endwhile;
		endif;
	endwhile; 
endif; 
if(empty($fofTitle)){
	$fofTitle = 'Not Found';
}
?>

<div id="post-0" class="content error404 not-found fold" data-class="bg-pattern">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 mx-auto"> 
				<div class="entry-content text-center">
					<h1 class="text-small-cp"><?php echo $fofTitle; ?></h1>
					<div class="text-center <?php echo esc_attr( $padding_block ); ?>">
						<a class="<?php echo esc_html($linkClass); ?>" <?php if($linkClass){ echo 'target="_blank"'; }?> href="<?php echo esc_url( $link); ?>">
							<?php echo esc_html( $linkTitle ); ?>
						</a>
					</div>

					<div>
					</div>
				</div><!-- /.entry-content -->
			</div><!-- /#post-0 -->
<?php
get_footer();
