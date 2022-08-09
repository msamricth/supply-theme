<?php
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
// add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}


add_action( 'acf/init', 'register_supply_stats_block' );
function register_supply_stats_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register supply-stats block
		acf_register_block_type( array(
			'name' 					=> 'supply-stats',
			'title' 				=> __( 'Supply Stats Block' ),
			'description' 			=> __( 'Block for providing stats on Case Studies.' ),
			'category' 				=> 'Supply Blocks',
			'icon'					=> 'analytics',
			'keywords'				=> array( 'supply', 'stats' ),
			'post_types'			=> array( 'post', 'page', 'case-studies' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-stats.php',
			// 'render_callback'	=> 'supply_stats_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-stats/supply-stats.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-stats/supply-stats.js',
			// 'enqueue_assets' 	=> 'supply_stats_block_enqueue_assets',
		));

	}

}
add_action( 'acf/init', 'register_supply_fold_block' );
function register_supply_fold_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Supply Fold block
		acf_register_block_type( array(
			'name' 					=> 'supply-fold',
			'title' 				=> __( 'Supply Fold' ),
			'description' 			=> __( 'A custom Supply Fold block.' ),
            'category' 				=> 'Supply Blocks',
			'icon'					=> 'image-flip-vertical',
			'keywords'				=> array( 'supply', 'fold' ),
			'post_types'			=> array( 'post', 'page', 'case-studies' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-fold.php',
			// 'render_callback'	=> 'supply_fold_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-fold/supply-fold.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-fold/supply-fold.js',
			// 'enqueue_assets' 	=> 'supply_fold_block_enqueue_assets',
		));

	}

}
add_action( 'acf/init', 'register_supply_media_block' );
function register_supply_media_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Supply media block
		acf_register_block_type( array(
			'name' 					=> 'supply-media',
			'title' 				=> __( 'Supply media' ),
			'description' 			=> __( 'A custom Supply media block.' ),
            'category' 				=> 'Supply Blocks',
			'icon'					=> 'format-video',
			'keywords'				=> array( 'supply', 'media' ),
			'post_types'			=> array( 'post', 'page', 'case-studies' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-media.php',
			// 'render_callback'	=> 'supply_media_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-media/supply-media.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-media/supply-media.js',
			// 'enqueue_assets' 	=> 'supply_media_block_enqueue_assets',
		));

	}

}
add_action( 'acf/init', 'register_supply_content_block_block' );
function register_supply_content_block_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Supply Content Block block
		acf_register_block_type( array(
			'name' 					=> 'supply-content-block',
			'title' 				=> __( 'Supply Content Block' ),
			'description' 			=> __( 'A custom Supply Content Block block.' ),
            'category' 				=> 'Supply Blocks',
			'icon'					=> 'welcome-write-blog',
			'keywords'				=> array( 'supply', 'media' ),
			'post_types'			=> array( 'post', 'page', 'case-studies' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-content-block.php',
			// 'render_callback'	=> 'supply_content_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.js',
			// 'enqueue_assets' 	=> 'supply_content_block_block_enqueue_assets',
		));

	}

}
add_action( 'acf/init', 'register_supply_quotes_block' );
function register_supply_quotes_block() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register Supply Quotes block
		acf_register_block_type( array(
			'name' 					=> 'supply-quotes',
			'title' 				=> __( 'Supply Quotes' ),
			'description' 			=> __( 'A custom Supply Quotes block.' ),
            'category' 				=> 'Supply Blocks',
			'icon'					=> 'welcome-write-blog',
			'keywords'				=> array( 'supply', 'quotes' ),
			'post_types'			=> array( 'post', 'page', 'case-studies' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-quote-block.php',
			// 'render_callback'	=> 'supply_quotes_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-quotes/supply-quotes.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-quotes/supply-quotes.js',
			// 'enqueue_assets' 	=> 'supply_quotes_block_enqueue_assets',
		));

	}

}