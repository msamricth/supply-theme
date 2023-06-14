<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="preconnect" href="https://player.vimeo.com">
	<link rel="preconnect" href="https://i.vimeocdn.com">
	<link rel="preconnect" href="https://f.vimeocdn.com">
	<?php wp_head();
	
	$post_id = '';
	$current_post = get_queried_object();
	$post_id = $current_post ? $current_post->ID : null;
	$navbar_scheme = '';
	$bodyClasses ='';
	$wrapperClasses ='';
	$ogClass ='';
	$bugtest = '';
	$navbar_page_scheme = get_field( 'navbar_color_settings', $post_id);
	$navbar_theme_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
	$nav_dark_image = '';
	$nav_light_image = '';
	$addtlAttr = '';
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
			$nav_svg = get_sub_field( 'svg' ); 
		endwhile; 
	endif; 
		if(strpos($navbar_page_scheme, 'default') !== false){
			if ( is_single() && 'post' == get_post_type() ) {
				$navbar_scheme = 'navbar-transparent navbar-dark dark-scheme nav-bg-transparent-dark';
				//$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
			} else {
				$navbar_scheme = $navbar_theme_scheme;
			}
		} elseif(strpos($navbar_page_scheme, 'transparent-dark') !== false){
			$navbar_scheme .= 'navbar-transparent navbar-dark dark-scheme';
			$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
		} elseif(strpos($navbar_page_scheme, 'transparent-light') !== false){
			$navbar_scheme .= 'navbar-transparent navbar-light light-scheme';
			$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
		} else {
			if ( is_single() && 'post' == get_post_type() ) {
				$navbar_scheme = 'navbar-transparent navbar-dark dark-scheme nav-bg-transparent-dark';
				//$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
			} else {
				$navbar_scheme .= 'navbar-'.$navbar_page_scheme;
				$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
			}
		}

	$bodyClasses .= $navbar_scheme;
	if ( get_field( 'fold_on' ) == 1 ) :
	else : 
		$bodyClasses .= ' fold_on ';
	endif; 
	$scheme = get_field('background_color');
	if($scheme){
		if(strpos($scheme, 'dots') !== false){
			$bodyClasses .= ' dots_on ';
			$scheme = 'bg-light bg-pattern';
		} else {
			$scheme = 'bg-'. $scheme . ' ';
		}
	} else {
		$scheme = 'bg-light';
	}

	if(strpos($scheme, 'bg-custom') !== false){
		$customBG = get_field( 'custom_bg_color' ); 
		$customColorVar = get_field( 'custom_text_color' ); 
		$customColor = '';
		if($customColorVar){
			if(strpos($customColorVar, '#') !== false){
				$customColor = $customColorVar;
			} else {
				$customColor = '#'.$customColorVar;
			}
			$customColor = ' --bgcustom: '.$customColorVar;
			$addtlAttr .= 'data-color="'.$customColor.'" ';
		}
		$addtlAttr .= 'data-bg="'.$customBG.'"';
		$bodyClasses .=" customScheme ";
	}
	$dataAttributes = '';
	$ogClass = $scheme;
	$wrapperClasses .= $scheme;

	 $top_trigger_area = get_field( 'top_trigger_area', 'option' ); 
	 if($top_trigger_area) {
		$dataAttributes .=' data-topTA="'.$top_trigger_area.'"';
	 }
	 $bottom_trigger_area = get_field( 'bottom_trigger_area', 'option' ); 
	 if($bottom_trigger_area) {
		$dataAttributes .=' data-bottomTA="'.$bottom_trigger_area.'"';
	 }

	 $scroll_fold_actions_checked_values = get_field( 'scroll_fold_actions', 'option' ); 
	 if ( $scroll_fold_actions_checked_values ) : 
		$dataAttributes .=' data-scroll-actions="';
		 foreach ( $scroll_fold_actions_checked_values as $scroll_fold_actions_value ): 
			$dataAttributes .= $scroll_fold_actions_value . ' ';
		 endforeach; 
		 $dataAttributes .= '"';
	 endif; 
	 if ( get_field( 'allow_custom_colors', 'option' ) == 1 ) : 
			$dataAttributes .=' data-custom="true"';
	 endif; 
	 if ( get_field( 'lazy_load_videos', 'option' ) == 1 ) : 
		$bodyClasses .= 'lazy_load_videos ';
	 endif; 
	 if ( get_field( 'nav_compression', 'option' ) == 1 ) : 
		$bodyClasses .= 'nav_compression ';
	 endif; 
	 $headStyles = '';
	 $foldTransition = '';
	 $transition_duriation = get_field( 'transition_duriation', 'option' ); 
	 $transition_type = get_field( 'transition_type', 'option' ); 
	 if($transition_duriation){
		if($transition_type){
			$foldTransition = $transition_duriation . ' ' . $transition_type;
			$headStyles .= '<style>#wrapper {   
				-webkit-transition: background-color '. $foldTransition.',color '. $foldTransition.', opacity '. $foldTransition.';
				transition: background-color  '. $foldTransition.',color '. $foldTransition.', opacity '. $foldTransition.';</style>';
		}
	 }
	 if($headStyles){
		echo $headStyles;
	 }
	 if ( get_field( 'reset', 'option' ) == 1 ) : 
		$dataAttributes ='data-fold-reset="true" data-custom="true "';
	 endif;
	 $debug_log_checked_values = get_field( 'debug_log', 'option' ); 
	 if ( $debug_log_checked_values ) : 
		 foreach ( $debug_log_checked_values as $debug_log_value ): 
			$dataAttributes .= ' ' . esc_html( $debug_log_value ) . '="true" ';
		 endforeach; 
	 endif; 
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
<div class="scroller" data-scroller <?php echo $dataAttributes; ?>>
	<div id="wrapper" class="<?php echo $wrapperClasses; ?>" data-og_class="<?php echo $ogClass; ?>" <?php echo $addtlAttr; ?>> 
		<header id="nav-header">
			<nav id="header" class="navbar navbar-expand-lg <?php  if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' fixed-top'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' fixed-bottom'; endif; if ( is_home() || is_front_page() ) : echo ' home'; endif; ?>">
				<div class="container">
					<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php
						if ( have_rows( 'nav_logos', 'option' ) ) :  
							if($nav_svg){
								echo $nav_svg;
							} else {
								echo $nav_light_image . $nav_dark_image;
							}
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

							?>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container -->
			</nav><!-- /#header -->
		</header>
	<?php if ( !is_front_page() ) { ?>
		<main id="main" class=" <?php if ( !get_post_type( $post_id ) === 'case-studies' ) { echo ' container'; } ?>"<?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>
	<?php } ?>