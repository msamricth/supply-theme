<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<?php
	$current_post = get_queried_object();
	$post_id = $current_post ? $current_post->ID : null;
	$navbar_scheme = '';
	$navbar_page_scheme = get_field( 'navbar_color_settings' );
	$navbar_theme_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.

	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
	
	if ( get_post_type( $post_id ) === 'case-studies' ) { 
		$navbar_page_scheme = "transparent";
	} 

	if ( isset( $navbar_page_scheme ) ) {
		if(strpos($navbar_page_scheme, 'default') !== false){
			$navbar_scheme = $navbar_theme_scheme;
		} else {
			$navbar_scheme .= 'navbar-'.$navbar_page_scheme;
			$navbar_scheme .= ' bg-'.$navbar_page_scheme;
		}
	} else {
		$navbar_scheme = $navbar_theme_scheme;
	}
	if ( get_post_type( $post_id ) === 'case-studies' ) { 
		$navbar_scheme = '';
		$navbar_scheme .= ' bg-transparent';
		$navbar_scheme .= ' navbar-dark';
	} 
// add algoritim for detecting background color here
?>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'supply' ); ?></a>

<div id="wrapper">
	<header>
		<nav id="header" class="navbar navbar-expand-md <?php echo esc_attr( $navbar_scheme ); if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' fixed-top'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' fixed-bottom'; endif; if ( is_home() || is_front_page() ) : echo ' home'; endif; ?>">
			<div class="container">
				<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php
						$header_logo = get_theme_mod( 'header_logo' ); // Get custom meta-value.

						if ( ! empty( $header_logo ) ) :
					?>
						<img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php
						else :
							echo esc_attr( get_bloginfo( 'name', 'display' ) );
						endif;
					?>
				</a>
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

						if ( '1' === $search_enabled ) :
					?>
							<form class="search-form my-2 my-lg-0" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<div class="input-group">
									<input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search', 'supply' ); ?>" title="<?php esc_attr_e( 'Search', 'supply' ); ?>" />
									<button type="submit" name="submit" class="btn btn-outline-secondary"><?php esc_html_e( 'Search', 'supply' ); ?></button>
								</div>
							</form>
					<?php
						endif;
					?>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav><!-- /#header -->
	</header>
<?php if ( !is_front_page() ) { ?>
	<main id="main" class="<?php if ( !get_post_type( $post_id ) === 'case-studies' ) { echo 'container'; } ?>"<?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 100px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>
<?php } ?>