<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="preconnect" href="https://player.vimeo.com">
	<link rel="preconnect" href="https://i.vimeocdn.com">
	<link rel="preconnect" href="https://f.vimeocdn.com">
	<?php wp_head();
	$bodyClasses = get_bodyclasses(); 
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-99172338-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-99172338-3');
</script>
</head>
<body <?php body_class($bodyClasses ); ?>>

<?php wp_body_open(); ?>
<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'supply' ); ?></a>
<div class="scroller" data-scroller <?php echo get_scroller_attributes(); ?>>
	<div id="wrapper" <?php echo get_wrapper();?>> 
		<header id="nav-header">
			<nav id="header" class="<?php echo get_nav_header('navbar navbar-expand-lg') ?>">
				<div class="container">
					<?php echo get_navbrand(); ?>
					<button class="navbar-toggler hamburger hamburger--squeeze" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'supply' ); ?>">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>

					<div id="navbar" class="collapse navbar-collapse">
						<?php
							// Loading WordPress Custom Menu (theme_location).
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'container'      => '',
									'menu_class'     => 'navbar-nav ms-auto mb-11 supply-underline mb-md-0',
									'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
									'walker'         => new WP_Bootstrap_Navwalker(),
								)
							);

							?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container -->
			</nav><!-- /#header -->
		</header>
	<?php if ( !is_front_page() ) { ?>
		<main id="main" class=" <?php if ( !get_post_type( $post_id ) === 'case-studies' ) { echo ' container'; } ?>"<?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>
	<?php } ?>