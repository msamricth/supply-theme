<?php
// Add to existing function.php file
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');
// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');
// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');
/**
 * Gutenberg scripts and styles
 *
 */
function be_gutenberg_scripts() {
	wp_enqueue_script( 'theme-editor', get_template_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_template_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );
/**
 * Enqueue footer markup in WP at lowest priority.
 * Convenience function!
 *
 * @param $markup
 */
function enqueue_footer_markup($markup){
	add_action('wp_footer', function () use ($markup){
		echo $markup;
	}, 99, 1);
}

/**
 * Enqueue footer markup in WP at lowest priority.
 * Convenience function!
 *
 * @param $markup
 */
function enqueue_header_markup($markup){
	add_action('wp_head', function () use ($markup){
		echo $markup;
	}, 10, 1);
}
function my_acf_admin_head() {
    ?>
    <style type="text/css">
        div#acf-group_62f2bec0e9fc1 [data-name="fold_color"], [data-name="column_placement"] {
            display:none !important;
        }
        [data-name="block_content"] [data-name="fold_color"] {
            display:none !important;
        }
    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');