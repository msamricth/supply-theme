<?php
/**
 * Block template file: inc/core.php
 * Core functions for the Supply Theme
 *
 * @package Supply Theme
 * @since v9
 */

/**
 * Core template tags
 *
 * @since v9.0
 */
$core_tags = __DIR__ . '/core/tags.php';
if ( is_readable( $core_tags ) ) {
	require_once $core_tags;
}

/**
 * Page Wrappers
 * @since v9.0
 */
$core_wrapper = __DIR__ . '/core/wrapper.php';
if ( is_readable( $core_wrapper ) ) {
	require_once $core_wrapper;
}

/**
 * Utilities
 * @since v9.0
 */
$core_utils = __DIR__ . '/core/utilities.php';
if ( is_readable( $core_utils ) ) {
	require_once $core_utils;
}

/**
 * Page header
 * @since v9.0
 */
$core_header = __DIR__ . '/core/head.php';
if ( is_readable( $core_header ) ) {
	require_once $core_header;
}


/**
 * The Fold
 * @since v9.0
 */
$core_fold = __DIR__ . '/core/the_fold.php';
if ( is_readable( $core_fold ) ) {
	require_once $core_fold;
}


/**
 * Load Nav functions
 * @since v9.0
 */
$core_nav = __DIR__ . '/navs/nav.php';
if ( is_readable( $core_nav ) ) {	require_once $core_nav; }
$custom_walker = __DIR__ . '/navs/wp_bootstrap_navwalker.php';
if ( is_readable( $custom_walker ) ) { require_once $custom_walker; }
$custom_walker_footer = __DIR__ . '/navs/wp_bootstrap_navwalker_footer.php';
if ( is_readable( $custom_walker_footer ) ) {	require_once $custom_walker_footer;}


/**
 * Load Media functions
 * @since v9.0
 */
$video_functions = __DIR__ . '/media/video.php';
if ( is_readable( $video_functions ) ) {	require_once $video_functions;}
$media_utilities = __DIR__ . '/media/utilities.php';
if ( is_readable( $media_utilities ) ) {	require_once $media_utilities;}
$media_settings = __DIR__ . '/media/settings.php';
if ( is_readable( $media_settings ) ) {	require_once $media_settings;}


/**
 * Widgets
 * @since v9.0
 */
$core_widgets = __DIR__ . '/core/widgets.php';
if ( is_readable( $core_widgets ) ) {
	require_once $core_widgets;
}


/**
 * Sidebar
 * @since v9.0
 */
$core_sidebar = __DIR__ . '/core/sidebar.php';
if ( is_readable( $core_sidebar ) ) {
	require_once $core_sidebar;
}