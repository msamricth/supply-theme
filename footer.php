			<?php
				// If Single or Archive (Category, Tag, Author or a Date based page).
				if ( is_single() || is_archive() ) :
			?>
					</div><!-- /.col -->

					<?php
						get_sidebar();
					?>

				</div><!-- /.row -->
			<?php
				endif;
			?>
		</main><!-- /#main -->
		<footer id="footer" class="bg-black footer text-white py-6 py-md-8">
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
									'container_class' => 'col-sm-3 pb-5 pb-md-0',
									'fallback_cb'     => '',
									'items_wrap'      => '<ul class="menu supply-underline nav d-block justify-content-end">%3$s</ul>',
									//'fallback_cb'    => 'WP_Bootstrap4_Navwalker_Footer::fallback',
									'walker'          => new WP_Bootstrap4_Navwalker_Footer(),
								)
							);
						endif; ?>

						
						<div class="col-sm-8">
							<div class="footer-content supply-underline">
								<span class="iso-reg footer-label d-block mb-2">
									<?php the_field( 'new_business_label', 'option' ); ?>
								</span>
								<p><?php the_field( 'point_of_contact', 'option' ); 
								echo '</p><p>';
								echo '<a href="mailto:';
								the_field( 'poc_email', 'option' );
								echo '">';
								the_field( 'poc_email', 'option' );
								echo '<span class="nav-underline"></span></a></p><p>';
								echo '<a href="tel:';
								the_field( 'poc_number', 'option' ); 
								echo '">';
								the_field( 'poc_number', 'option' );
								echo '<span class="nav-underline"></span></a>';
								?>
								</p>
								<span class="iso-reg footer-label d-block pt-5 mb-2">
									<?php the_field( 'headquarters_label', 'option' ); ?>
								</span>
								<?php the_field( 'headquarters_address', 'option' ); ?>
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
								endif;
							?>
						</div>
						<?php if ( have_rows( 'add_a_social_media_account', 'option' ) ) : ?>
							<div class="col-md-1">
								<ul class="social-nav">
									<?php while ( have_rows( 'add_a_social_media_account', 'option' ) ) : the_row(); $site_title = get_bloginfo( 'name' ); $sm_title = get_sub_field( 'social_media_name' ); ?>
										<li>
											<a href="<?php the_sub_field( 'url' ); ?>" alt="<?php echo $site_title ."'s". $sm_title;?>">
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