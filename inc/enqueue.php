<?php
/**
 * Block template file: inc/enqueue.php
 * Settings that came with the orginal Boiler point
 *
 * @package Supply Theme
 * @since v9
 */

/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 */

function supply_styles_loader() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 1. Styles.
	wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ), array(), $theme_version, 'all' );
	wp_enqueue_script(
		'fontawesome', 'https://kit.fontawesome.com/8b0174b394.js','',
		true
	);
	wp_enqueue_style( 'main', get_theme_file_uri( 'assets/css/main.css' ), array(), $theme_version, 'all' ); // main.scss: Compiled Framework source + custom styles.

	wp_enqueue_script(
		'vimeo', 'https://player.vimeo.com/api/player.js',
		['jquery'],
		true
	);
	if ( is_rtl() ) {
		wp_enqueue_style( 'rtl', get_theme_file_uri( 'assets/css/rtl.css' ), array(), $theme_version, 'all' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'supply_styles_loader' );
function supply_scripts_loader() {
	$theme_version = wp_get_theme()->get( 'Version' );
	//if ( get_post_type() === 'service-offerings' ) { }
	if(check_if_block_exist('acf/supply-lottie-block')) {
		wp_enqueue_script( 'lottie-player', "https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js", array(), $theme_version, true );
	}
	// 2. Scripts.
	wp_enqueue_script( 'mainjs', get_theme_file_uri( 'assets/js/main.bundle.js' ), array(), $theme_version, true );
	if(check_if_block_exist('acf/supply-carousel-block')) {
//		wp_enqueue_script( 'splide', "https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js", array(), $theme_version, true );
	}

	
}
add_action( 'wp_enqueue_scripts', 'supply_scripts_loader', 100);

add_filter( 'script_loader_tag', 'my_scripts_modifier', 10, 3 );
function my_scripts_modifier( $tag, $handle, $src ) {
    if ( 'splide' === $handle ) {
        return '<script defer src="' . $src . '" type="text/javascript" integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>' . "\n";
    }
    return $tag;
}