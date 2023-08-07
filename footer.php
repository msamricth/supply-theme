<?php 
	$scheme = get_field('background_color');
	$footerScheme = get_field('footer_color');
	$classes = "bg-dark text-white";
	$utilities = '';
	switch ( $footerScheme ) {
		case 'light':
			$classes = "bg-light text-dark";
			break;
		case 'pattern':
			$classes = "bg-pattern bg-light text-dark";
			break;
		case 'scheme':
			$classes = "bg-'. $scheme .' scheme";
			break;
		case 'custom':
			$classes = '';
			
			$custom_footer_color = get_field('custom_footer_color');
			$custom_footer_text_color = get_field('custom_footer_text_color');
			if(!empty($custom_footer_color)) {
				$utilities = 'style="background-color: ' . $custom_footer_color .';';
				if(empty($custom_footer_text_color)) {
					$rgb = HTMLToRGB($background_color);
					$hsl = RGBToHSL($rgb);
					if($hsl->lightness > 200) {
					// this is light colour!
						$classes = 'text-primary';
					} else {
						$classes = 'text-white';
					}
				} else {
					$utilities .= ' color: ' . $custom_footer_color .';';
				}
				$utilities .= '"';
			}
			break;
		default:
	}
	if(!empty($footerScheme)){
		$classes .= " override";
	}

	$foldUtils = '';
	if($scheme){
		$foldUtils .=' data-class="bg-'. $scheme .'"';
	} else {
		$foldUtils .=' data-class="bg-light"';
	}
	if ( get_field( 'make_block_container_fold' ) == 1 ) : 
		echo '<div class="fold"'.$foldUtils.'></div>';
	endif;
	if ( is_single() && 'post' == get_post_type() ) {
		echo '<div class="fold"'.$foldUtils.'></div>';
	}
	echo supply_page_ending();
	?>
	</main><!-- /#main -->
	<footer id="footer" class="<?php echo $classes;?> footer pt-6 pt-md-8 fadeNoScroll" <?php echo $utilities;?>>
		<div class="container">
			<div class="row">
				<?php
					if ( has_nav_menu( 'footer-menu' ) ) : // See function register_nav_menus() in functions.php
						/*
							Loading WordPress Custom Menu (theme_location) ... remove <div> <ul> containers and show only <li> items!!!
							Menu name taken from functions.php!!! ... register_nav_menu( 'footer-menu', 'Footer Menu' );
							!!! IMPORTANT: After adding all pages to the menu, don't forget to assign this menu to the Footer menu of "Theme locations" /wp-admin/nav-menus.php (on left side) ... Otherwise the themes will not know, which menu to use!!!
						*/
						wp_nav_menu(
							array(
								'theme_location'  => 'footer-menu',
								'container'       => 'nav',
								'container_class' => 'col-md-6 col-lg-3 col-3xl-3 pb-6 pb-md-0 ',
								'fallback_cb'     => '',
								'items_wrap'      => '<ul class="menu navbar-nav supply-underline nav d-block justify-content-end">%3$s</ul>',
								//'fallback_cb'    => 'WP_Bootstrap4_Navwalker_Footer::fallback',
								'walker'          => new WP_Bootstrap4_Navwalker_Footer(),
							)
						);
					endif; ?>
					<div class="col-md-6 col-lg-5 col-3xl-3 block-supply-contact-block fold" data-class="bg-footer">
						<div class="footer-content supply-underline">
							<div class="">
								<p class="md-0">
									<span class="iso-reg footer-label d-block">
										<?php the_field( 'new_business_label', 'option' ); ?>
									</span>
								</p>
								<p><?php the_field( 'point_of_contact', 'option' ); ?></p>
							</div>
							<div class="footer-content--additional-content">
								<?php
								echo '<p class="fl">';
								echo '<a href="mailto:';
								the_field( 'poc_email', 'option' );
								echo '">';
								the_field( 'poc_email', 'option' );
								echo '<span class="nav-underline"></span></a></p><p class="fl">';
								echo '<a href="tel:';
								the_field( 'poc_number', 'option' ); 
								echo '">';
								the_field( 'poc_number', 'option' );
								echo '<span class="nav-underline"></span></a>';
								?>
								</p>
							</div>
							<div class="pt-4 mt-2 mt-md-4">
								
							<p class="md-0">
								<span class="iso-reg footer-label d-block">
									<?php the_field( 'headquarters_label', 'option' ); ?>
								</span>
							</p>
								<p class="mb-0 fl"><?php the_field( 'headquarters_address', 'option' ); ?></p>
							</div>
						</div>
						<?php if ( is_active_sidebar( 'third_widget_area' ) ) :
							?>
								<?php
									dynamic_sidebar( 'third_widget_area' );
									if ( current_user_can( 'manage_options' ) ) :
								?>
									<span class="edit-link"><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="badge badge-secondary"><?php esc_html_e( 'Edit', 'supply' ); ?></a></span><!-- Show Edit Widget link -->
								<?php
									endif;
								?>
								<p><?php printf( esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'supply' ), date_i18n( 'Y' ), get_bloginfo( 'name', 'display' ) ); ?></p>
						<?php
							endif;?>
						<div class="footer-cta my-5 mt-md-6" id="130">
							<?php echo do_shortcode('[contact-form-7 id="130" title="Stay in touch - FooterCTA"]'); ?>
						</div>
					</div>
					<?php if ( have_rows( 'add_a_social_media_account', 'option' ) ) : ?>
						<div class="col-lg-1 offset-lg-3 offset-3xl-5 col-md-6 offset-md-6">
							<ul class="social-nav ">
								<?php while ( have_rows( 'add_a_social_media_account', 'option' ) ) : the_row(); $site_title = get_bloginfo( 'name' ); $sm_title = get_sub_field( 'social_media_name' ); ?>
									<li>
										<a class="px-lg-0" href="<?php the_sub_field( 'url' ); ?>" target="_blank" title="<?php echo $site_title ."'s". $sm_title;?>">
											<?php the_sub_field( 'icon' ); ?>
										</a>
									</li>				
								<?php endwhile; ?>
							</ul>
						</div>
					<?php else : ?>
						<?php // No rows found ?>
					<?php endif; ?>	
			</div><!-- /.row -->
		</div><!-- /.container -->
	</footer><!-- /#footer -->
</div><!-- /#wrapper -->
<?php
	wp_footer();
?>
</body>
</html>