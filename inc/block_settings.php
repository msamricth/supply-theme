<?php
/**
 * Block template file: inc/block_settings.php
 * Core functions for Supply's Block Settings
 *
 * @package Supply Theme
 * @since v9
 */


 if ( ! function_exists( 'check_if_block_exist' ) ) :
	/**
	 *
	 * @since v??
	 */
    function check_if_block_exist($block_handle) {
        $post = get_post(); 
        if (isset($post->post_content)) {	
            if(has_blocks($post->post_content)) {
                $blocks = parse_blocks($post->post_content);
            
                foreach( $blocks as $block ) {
                if($block['blockName'] === $block_handle) {
                    return true;
                }
                }
                return false;
            }
        }
    }
endif;
/**
 * Include Padding and Color Scheme settings.
 *
 * @since v9.0
 */
$block_padding = __DIR__ . '/block_settings/padding.php';
$color_scheme = __DIR__ . '/block_settings/color_scheme.php';
if ( is_readable( $block_padding ) ) {
	require_once $block_padding;
}
if ( is_readable( $color_scheme ) ) {
	require_once $color_scheme;
}

if ( ! function_exists( 'get_block_settings' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function get_block_settings($classes=null, $noColor = null, $noFold = null, $noPadding = null) {
        $output = "";
        $foldUtils = '';
        $post_id = ''; 
        $output = '';
        $current_post = get_queried_object();
        $post_id = $current_post ? $current_post->ID : null;
        $styles = ''; 
        if($classes) {
            $classes .= ' ';
        }
        if(empty($noFold)) {     
            $classes .= get_fold('', 1);
            $foldUtils = get_fold('', '', 1);
        }
        if(empty($noColor)) {
            $classes .= ' ';
            $classes .= get_container_scheme();
        }
        if(empty($noPadding)) {
            $classes .= get_padding();
        }
        $output = $classes .'" '.$foldUtils;
		return $output;
    }

endif;

/**
 * Include Container + Column settings
 *
 * @since v9.0
 */
$block_container = __DIR__ . '/block_settings/container.php';
if ( is_readable( $block_container ) ) {
	require_once $block_container;
}
