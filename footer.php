
	</main><!-- /#main -->
	<footer id="footer" class="bg-black footer text-white pt-6 pt-md-8 fadeNoScroll">
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
								'container_class' => 'col-md-6 col-lg-3 col-3xl-4 pb-6 pb-md-0 ',
								'fallback_cb'     => '',
								'items_wrap'      => '<ul class="menu navbar-nav supply-underline nav d-block justify-content-end">%3$s</ul>',
								//'fallback_cb'    => 'WP_Bootstrap4_Navwalker_Footer::fallback',
								'walker'          => new WP_Bootstrap4_Navwalker_Footer(),
							)
						);
					endif; ?>
					<div class="col-md-6 col-lg-8 col-3xl-7 block-supply-contact-block ">
						<div class="footer-content supply-underline">
							<div class="">
								<p class="md-0">
									<span class="iso-reg footer-label d-block">
										<?php the_field( 'new_business_label', 'option' ); ?>
									</span>
								</p>
								<p><?php the_field( 'point_of_contact', 'option' ); ?></p>
							</div>
							<div class="">
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
								<p class="mb-0"><?php the_field( 'headquarters_address', 'option' ); ?></p>
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
						<div class="footer-cta my-5 mt-md-6 fold" data-class="bg-dark">
							<?php echo do_shortcode('[contact-form-7 id="130" title="Stay in touch - FooterCTA"]'); ?>
						</div>
					</div>
					<?php if ( have_rows( 'add_a_social_media_account', 'option' ) ) : ?>
						<div class="col-lg-1 col-md-6 offset-md-6 offset-lg-0">
							<ul class="social-nav ">
								<?php while ( have_rows( 'add_a_social_media_account', 'option' ) ) : the_row(); $site_title = get_bloginfo( 'name' ); $sm_title = get_sub_field( 'social_media_name' ); ?>
									<li>
										<a class="px-lg-0" href="<?php the_sub_field( 'url' ); ?>" target="_blank" alt="<?php echo $site_title ."'s". $sm_title;?>">
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