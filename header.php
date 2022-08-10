<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<?php
	$post_id = '';
	if(!is_archive()):
		$current_post = get_queried_object();
		$post_id = $current_post ? $current_post->ID : null;
	endif;
	$navbar_scheme = '';
	$navbar_page_scheme = get_field( 'navbar_color_settings', $post_id);
	$navbar_theme_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.

	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
	$nav_dark_image = '';
	$nav_light_image = '';
	if ( have_rows( 'nav_logos', 'option' ) ) : 
		while ( have_rows( 'nav_logos', 'option' ) ) : the_row(); 
			$nav_dark = get_sub_field( 'nav_dark' ); 
			if ( $nav_dark ) : 
			   $nav_dark_image = '<img class="navbrand-dark" src="'.esc_url( $nav_dark['url'] ).' " alt="'.esc_attr( $nav_dark['alt'] ).' " />';
			endif; 
			$nav_light = get_sub_field( 'nav_light' ); 
			if ( $nav_light ) : 
			   $nav_light_image = '<img class="navbrand-light" src="'. esc_url( $nav_light['url'] ). '" alt="'. esc_attr( $nav_light['alt'] ).' " />';
			endif; 
		endwhile; 
	endif; 

		if(strpos($navbar_page_scheme, 'default') !== false){
			$navbar_scheme = $navbar_theme_scheme;
		} elseif(strpos($navbar_page_scheme, 'transparent-dark') !== false){
			$navbar_scheme .= 'navbar-transparent navbar-dark dark-scheme';
			$navbar_scheme .= ' bg-'.$navbar_page_scheme;
		} elseif(strpos($navbar_page_scheme, 'transparent-light') !== false){
			$navbar_scheme .= 'navbar-transparent navbar-light light-scheme';
			$navbar_scheme .= ' bg-'.$navbar_page_scheme;
		} else {
			$navbar_scheme .= 'navbar-'.$navbar_page_scheme;
			$navbar_scheme .= ' bg-'.$navbar_page_scheme;
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
					if ( have_rows( 'nav_logos', 'option' ) ) : 
						echo $nav_light_image . $nav_dark_image;
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