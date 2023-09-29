<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer/customizer.php';
if ( is_readable( $theme_customizer ) ) { require_once $theme_customizer;}

/**
 * Include Theme Settings.
 *
 * @since v9
 */
$theme_settings = __DIR__ . '/inc/theme_settings.php';
if ( is_readable( $theme_settings ) ) {	require_once $theme_settings;}

/**
 * enqueue Styles and Scripts
 * 
 * @since v9
 */
$enqueue = __DIR__ . '/inc/enqueue.php';
if ( is_readable( $enqueue ) ) {	require_once $enqueue;}
/**
 * Include Theme Functions and Template Tags.
 *
 * @since v3
 */
$theme_functions = __DIR__ . '/inc/theme_functions.php';
if ( is_readable( $theme_functions ) ) {	require_once $theme_functions;}

$theme_tweaks = __DIR__ . '/inc/tweaks.php';
if ( is_readable( $theme_tweaks ) ) {	require_once $theme_tweaks;}