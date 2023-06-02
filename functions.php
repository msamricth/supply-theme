<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer.php';
if ( is_readable( $theme_customizer ) ) {
	require_once $theme_customizer;
}




/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since v1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}


/**
 * General Theme Settings.
 *
 * @since v1.0
 */
	if ( ! function_exists( 'supply_setup_theme' ) ) {
		function themes_starter_setup_theme() {
			// Make theme available for translation: Translations can be filed in the /languages/ directory.
			load_theme_textdomain( 'my-theme', __DIR__ . '/languages' );
	
			/**
			 * Set the content width based on the theme's design and stylesheet.
			 *
			 * @since v1.0
			 */
			global $content_width;
			if ( ! isset( $content_width ) ) {
				$content_width = 800;
			}
	
			// Theme Support.
			add_theme_support( 'title-tag' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
					'navigation-widgets',
				)
			);
	
			// Add support for Block Styles.
			add_theme_support( 'wp-block-styles' );
			// Add support for full and wide alignment.
			add_theme_support( 'align-wide' );
			// Add support for editor styles.
			add_theme_support( 'editor-styles' );
			// Enqueue editor styles.
			add_editor_style( 'style-editor.css' );
	
			// Default Attachment Display Settings.
			update_option( 'image_default_align', 'none' );
			update_option( 'image_default_link_type', 'none' );
			update_option( 'image_default_size', 'large' );
	
			// Custom CSS-Styles of Wordpress Gallery.
			add_filter( 'use_default_gallery_style', '__return_false' );
		}
		add_action( 'after_setup_theme', 'themes_starter_setup_theme' );
	
		// Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
		remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
		remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
	}

/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 *
 * @since v2.2
 */
if ( ! function_exists( 'wp_body_open' ) ) :
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since v2.2
		 */
		do_action( 'wp_body_open' );
	}
endif;


/**
 * Add new User fields to Userprofile.
 *
 * @since v1.0
 */
if ( ! function_exists( 'supply_add_user_fields' ) ) :
	function supply_add_user_fields( $fields ) {
		// Add new fields.
		$fields['facebook_profile'] = 'Facebook URL';
		$fields['twitter_profile']  = 'Twitter URL';
		$fields['linkedin_profile'] = 'LinkedIn URL';
		$fields['xing_profile']     = 'Xing URL';
		$fields['github_profile']   = 'GitHub URL';

		return $fields;
	}
	add_filter( 'user_contactmethods', 'supply_add_user_fields' ); // get_user_meta( $user->ID, 'facebook_profile', true );
endif;


/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 */
function is_blog() {
	global $post;
	$posttype = get_post_type( $post );

	return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || ( is_tag() && ( 'post' === $posttype ) ) ) ? true : false );
}


/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 */
function supply_filter_media_comment_status( $open, $post_id = null ) {
	$media_post = get_post( $post_id );
	if ( 'attachment' === $media_post->post_type ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'supply_filter_media_comment_status', 10, 2 );


/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 */
function supply_custom_edit_post_link( $output ) {
	return str_replace( 'class="post-edit-link"', 'class="post-edit-link badge badge-secondary"', $output );
}
add_filter( 'edit_post_link', 'supply_custom_edit_post_link' );

function supply_custom_edit_comment_link( $output ) {
	return str_replace( 'class="comment-edit-link"', 'class="comment-edit-link badge badge-secondary"', $output );
}
add_filter( 'edit_comment_link', 'supply_custom_edit_comment_link' );


/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 */
function supply_oembed_filter( $html ) {
	return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'supply_oembed_filter', 10, 4 );


if ( ! function_exists( 'supply_content_nav' ) ) :
	/**
	 * Display a navigation to next/previous pages when applicable.
	 *
	 * @since v1.0
	 */
	function supply_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) :
	?>
			<div id="<?php echo esc_attr( $nav_id ); ?>" class="d-flex mb-4 justify-content-between">
				<div><?php next_posts_link( '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Older posts', 'supply' ) ); ?></div>
				<div><?php previous_posts_link( esc_html__( 'Newer posts', 'supply' ) . ' <span aria-hidden="true">&rarr;</span>' ); ?></div>
			</div><!-- /.d-flex -->
	<?php
		else :
			echo '<div class="clearfix"></div>';
		endif;
	}

	// Add Class.
	function posts_link_attributes() {
		return 'class="btn btn-secondary btn-lg"';
	}
	add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
	add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );
endif;


/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 */
function myTheme_registerWidgetAreas() {
    // Grab all pages except trashed
    $pages = new WP_Query(Array(
        'post_type' => 'page',
        'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit'),
        'posts_per_page'=>-1
    ));
    // Step through each page
    while ( $pages->have_posts() ) {
        $pages->the_post();
        // Ignore pages with no slug
        if ($pages->post->post_name == '') continue;
        // Register the sidebar for the page. Note that the id has
        // to match the name given in the theme template
        register_sidebar( array(
            'name'          => $pages->post->post_name,
            'id'            => 'widget_area_for_page_'.$pages->post->post_name,
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        ) );
		
    }
	register_sidebar(
		array(
			'id'            => 'primary',
			'name'          => __( 'Primary Sidebar' ),
			'description'   => __( 'A short description of the sidebar.' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'myTheme_registerWidgetAreas' );
$theme_functions = __DIR__ . '/inc/theme_functions.php';
if ( is_readable( $theme_functions ) ) {
	require_once $theme_functions;
}
if ( ! function_exists( 'supply_article_posted_on' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function supply_article_posted_on() {
		printf(
			wp_kses_post( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author-meta vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'supply' ) ),
			esc_url( get_the_permalink() ),
			esc_attr( get_the_date() . ' - ' . get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() . ' - ' . get_the_time() ),
			esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'supply' ), get_the_author() ),
			get_the_author()
		);
	}
endif;

/** PHP color stuff - trying to take it easy on browser side JS */
if ( ! function_exists( 'HTMLToRGB' ) ) :
	function HTMLToRGB($htmlCode) {
		if($htmlCode[0] == '#')
		$htmlCode = substr($htmlCode, 1);

		if (strlen($htmlCode) == 3)
		{
		$htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
		}

		$r = hexdec($htmlCode[0] . $htmlCode[1]);
		$g = hexdec($htmlCode[2] . $htmlCode[3]);
		$b = hexdec($htmlCode[4] . $htmlCode[5]);

		return $b + ($g << 0x8) + ($r << 0x10);
	}
endif;
if ( ! function_exists( 'RGBToHSL' ) ) :
	function RGBToHSL($RGB) {
		$r = 0xFF & ($RGB >> 0x10);
		$g = 0xFF & ($RGB >> 0x8);
		$b = 0xFF & $RGB;

		$r = ((float)$r) / 255.0;
		$g = ((float)$g) / 255.0;
		$b = ((float)$b) / 255.0;

		$maxC = max($r, $g, $b);
		$minC = min($r, $g, $b);

		$l = ($maxC + $minC) / 2.0;

		if($maxC == $minC)
		{
		$s = 0;
		$h = 0;
		}
		else
		{
		if($l < .5)
		{
			$s = ($maxC - $minC) / ($maxC + $minC);
		}
		else
		{
			$s = ($maxC - $minC) / (2.0 - $maxC - $minC);
		}
		if($r == $maxC)
			$h = ($g - $b) / ($maxC - $minC);
		if($g == $maxC)
			$h = 2.0 + ($b - $r) / ($maxC - $minC);
		if($b == $maxC)
			$h = 4.0 + ($r - $g) / ($maxC - $minC);

		$h = $h / 6.0; 
		}

		$h = (int)round(255.0 * $h);
		$s = (int)round(255.0 * $s);
		$l = (int)round(255.0 * $l);

		return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
	}

endif;


/**
 * Template for Password protected post form.
 *
 * @since v1.0
 */
function supply_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

	$output = '<div class="row">';
		$output .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
		$output .= '<h4 class="col-md-12 alert alert-warning">' . esc_html__( 'This content is password protected. To view it please enter your password below.', 'supply' ) . '</h4>';
			$output .= '<div class="col-md-6">';
				$output .= '<div class="input-group">';
					$output .= '<input type="password" name="post_password" id="' . esc_attr( $label ) . '" placeholder="' . esc_attr__( 'Password', 'supply' ) . '" class="form-control" />';
					$output .= '<div class="input-group-append"><input type="submit" name="submit" class="btn btn-primary" value="' . esc_attr__( 'Submit', 'supply' ) . '" /></div>';
				$output .= '</div><!-- /.input-group -->';
			$output .= '</div><!-- /.col -->';
		$output .= '</form>';
	$output .= '</div><!-- /.row -->';
	return $output;
}
add_filter( 'the_password_form', 'supply_password_form' );




/**
 * Nav menus.
 *
 * @since v1.0
 */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = __DIR__ . '/inc/wp_bootstrap_navwalker.php';
if ( is_readable( $custom_walker ) ) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp_bootstrap_navwalker_footer.php';
if ( is_readable( $custom_walker_footer ) ) {
	require_once $custom_walker_footer;
}


/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
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
function supply_scripts_loader() {
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

	// 2. Scripts.
	wp_enqueue_script( 'mainjs', get_theme_file_uri( 'assets/js/main.bundle.js' ), array(), $theme_version, true );
	if(check_if_block_exist('acf/supply-carousel-block')) {
//		wp_enqueue_script( 'splide', "https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js", array(), $theme_version, true );
	}

}
add_action( 'wp_enqueue_scripts', 'supply_scripts_loader' );

add_filter( 'script_loader_tag', 'my_scripts_modifier', 10, 3 );
function my_scripts_modifier( $tag, $handle, $src ) {
    if ( 'splide' === $handle ) {
        return '<script defer src="' . $src . '" type="text/javascript" integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>' . "\n";
    }
    return $tag;
}
/**
 * Include Support for Advance Custom Fields Pro.
 * 
 * @since v1.0
 */
$theme_ACFPro = __DIR__ . '/inc/acf.php';

$theme_ACFProFields = __DIR__ . '/inc/acf_fields.php';
$theme_ACFProDIR  = __DIR__ . '/inc/acf/';
if ( is_readable( $theme_ACFPro ) ) {
	require_once $theme_ACFPro;
	require_once $theme_ACFProFields;
}
$theme_videoEmbeds = __DIR__ . '/inc/video_embeds.php';
if ( is_readable( $theme_videoEmbeds ) ) {
	require_once $theme_videoEmbeds;
}
$theme_tweaks = __DIR__ . '/inc/tweaks.php';
if ( is_readable( $theme_tweaks ) ) {
	require_once $theme_tweaks;
}
function enable_svg_upload( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );


