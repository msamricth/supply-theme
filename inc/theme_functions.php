<?php
/**
 * Block template file: inc/theme_functions.php
 * Core functions and template tags for the Supply Theme
 *
 * @package Supply Theme
 * @since v3
 */

 /**
 * Include Support for Advance Custom Fields Pro.
 * 
 * @since v1.0
 */
 // Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/acf/plugin/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/plugin/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {    return MY_ACF_URL; }

// (Optional) Hide the ACF admin menu item.
// add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) { return false; }

// Load Supply ACF Content
$theme_ACFProFields = __DIR__ . '/acf/acf_fields.php';
$theme_ACFProBlocks = __DIR__ . '/acf/acf_blocks.php';
$theme_ACFProCPTs = __DIR__ . '/acf/acf_cpts.php';
//$theme_ACFProDIR  = __DIR__ . '/acf/';
if ( is_readable( $theme_ACFProFields ) ) {	require_once $theme_ACFProFields;}
if ( is_readable( $theme_ACFProBlocks ) ) {	require_once $theme_ACFProBlocks;}
if ( is_readable( $theme_ACFProCPTs ) ) {	require_once $theme_ACFProCPTs;}

/**
 * Include Theme Functions and Template Tags.
 *
 * @since v3
 */
$supply_core = __DIR__ . '/core.php';
if ( is_readable( $theme_functions ) ) {	require_once $supply_core;}

$supply_block_settings = __DIR__ . '/block_settings.php';
if ( is_readable( $supply_block_settings ) ) {	require_once $supply_block_settings;}

$supply_media_functions = __DIR__ . '/media.php';
if ( is_readable( $supply_media_functions ) ) {	require_once $supply_media_functions;}

$supply_case_studies = __DIR__ . '/misc/case_studies.php';
if ( is_readable( $supply_case_studies ) ) {	require_once $supply_case_studies;}

$supply_offerings = __DIR__ . '/misc/offerings.php';
if ( is_readable( $supply_offerings ) ) {	require_once $supply_offerings;}