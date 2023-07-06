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


//include_once( MY_ACF_PATH . 'acf_fields.php' );
 
function filter_block_categories_when_post_provided( $block_categories, $editor_context ) {
    if ( ! empty( $editor_context->post ) ) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'supply-blocks',
                'title' => __( 'Supply Blocks', 'Work With Supply' ),
                'icon'  => null,
            )
        );
    }
    return $block_categories;
}
 
add_filter( 'block_categories_all', 'filter_block_categories_when_post_provided', 10, 2 );
function custom_block_category( $categories ) {
    $custom_block = array(
		'slug'  => 'supply-blocks',
		'title' => __( 'Supply Blocks', 'Work With Supply' ),
    );

    $categories_sorted = array();
    $categories_sorted[0] = $custom_block;

    foreach ($categories as $category) {
        $categories_sorted[] = $category;
    }

    return $categories_sorted;
}
add_filter( 'block_categories', 'custom_block_category', 10, 2);
add_action( 'acf/init', 'register_supply_blocks' );
function register_supply_blocks() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register supply-stats block
		acf_register_block_type( array(
			'name' 					=> 'supply-stats',
			'title' 				=> __( 'Supply Stats Block' ),
			'description' 			=> __( 'Block for providing stats on Case Studies.' ),
			'category' 				=> 'supply-blocks',
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
		// Register Supply Fold block
		acf_register_block_type( array(
			'name' 					=> 'supply-fold',
			'title' 				=> __( 'Supply Fold' ),
			'description' 			=> __( 'A custom Supply Fold block.' ),
			'category' 				=> 'supply-blocks',
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
		// Register Supply media block
		//acf_register_block_type( array(
			//'name' 					=> 'supply-media',
			//'title' 				=> __( 'Supply media (V1 Discontinued)' ),
			//'description' 			=> __( 'A custom Supply media block.' ),
			//'category' 				=> 'supply-blocks',
			//'icon'					=> 'format-video',
			//'keywords'				=> array( 'supply', 'media' ),
			//'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			//'mode'					=> 'auto',
			// 'align'				=> 'wide',
			//'render_template'		=> 'templates/blocks/supply-media.php',
			// 'render_callback'	=> 'supply_media_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-media/supply-media.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-media/supply-media.js',
			// 'enqueue_assets' 	=> 'supply_media_block_enqueue_assets',
		//));
		// Register Supply Content Block block
		acf_register_block_type( array(
			'name' 					=> 'supply-content-block',
			'title' 				=> __( 'Supply Content Block' ),
			'description' 			=> __( 'A custom Supply Content Block block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'welcome-write-blog',
			'keywords'				=> array( 'supply', 'media' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-content-block.php',
			// 'render_callback'	=> 'supply_content_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.js',
			// 'enqueue_assets' 	=> 'supply_content_block_block_enqueue_assets',
		));
		// Register Supply Heading Block block
		acf_register_block_type( array(
			'name' 					=> 'supply-heading-block',
			'title' 				=> __( 'Supply Heading Block' ),
			'description' 			=> __( 'A custom Supply Heading Block block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'heading',
			'keywords'				=> array( 'supply', 'type' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-heading-block.php',
			// 'render_callback'	=> 'supply_content_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.js',
			// 'enqueue_assets' 	=> 'supply_content_block_block_enqueue_assets',
		));
		// Register Supply Link Block block
		acf_register_block_type( array(
			'name' 					=> 'supply-link-block',
			'title' 				=> __( 'Supply Link Block' ),
			'description' 			=> __( 'A custom Supply Link Block block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'admin-links',
			'keywords'				=> array( 'supply', 'type' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-link-block.php',
			// 'render_callback'	=> 'supply_content_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-content-block/supply-content-block.js',
			// 'enqueue_assets' 	=> 'supply_content_block_block_enqueue_assets',
		));
		acf_register_block_type( array(
			'name' 					=> 'supply-quotes',
			'title' 				=> __( 'Supply Quotes' ),
			'description' 			=> __( 'A custom Supply Quotes block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'format-quote',
			'keywords'				=> array( 'supply', 'quotes' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-quote-block.php',
			// 'render_callback'	=> 'supply_quotes_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-quotes/supply-quotes.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-quotes/supply-quotes.js',
			// 'enqueue_assets' 	=> 'supply_quotes_block_enqueue_assets',
		));
		// Register Supply Contact block
		acf_register_block_type( array(
			'name' 					=> 'supply-contact',
			'title' 				=> __( 'Supply Contact Block' ),
			'description' 			=> __( 'A custom Supply Contact block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'phone',
			'keywords'				=> array( 'supply', 'contact' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-contact-block.php',
			// 'render_callback'	=> 'supply_contact_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-contact/supply-contact.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-contact/supply-contact.js',
			// 'enqueue_assets' 	=> 'supply_contact_block_enqueue_assets',
		));
		// Register Supply List Block block
		acf_register_block_type( array(
			'name' 					=> 'supply-list-block',
			'title' 				=> __( 'Supply List Block' ),
			'description' 			=> __( 'A custom Supply List Block block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'editor-ul',
			'keywords'				=> array( 'supply', 'list', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-list-block.php',
			// 'render_callback'	=> 'supply_list_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-list-block/supply-list-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-list-block/supply-list-block.js',
			// 'enqueue_assets' 	=> 'supply_list_block_block_enqueue_assets',
		));
		// Register Supply Separator Block block
		acf_register_block_type( array(
			'name' 					=> 'supply-separator-block',
			'title' 				=> __( 'Supply Separator Block' ),
			'description' 			=> __( 'A custom Supply Separator Block block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'ellipsis',
			'keywords'				=> array( 'supply', 'separator', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-separator-block.php',
			// 'render_callback'	=> 'supply_separator_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-separator-block/supply-separator-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-separator-block/supply-separator-block.js',
			// 'enqueue_assets' 	=> 'supply_separator_block_block_enqueue_assets',
		));
		// Register Supply Logo Garden block
		acf_register_block_type( array(
			'name' 					=> 'supply-logo-garden',
			'title' 				=> __( 'Supply Logo Garden' ),
			'description' 			=> __( 'A custom Supply Logo Garden block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'groups',
			'keywords'				=> array( 'supply', 'logo', 'garden' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-logo-garden.php',
			// 'render_callback'	=> 'supply_logo_garden_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-logo-garden/supply-logo-garden.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-logo-garden/supply-logo-garden.js',
			// 'enqueue_assets' 	=> 'supply_logo_garden_block_enqueue_assets',
		));
		// Register Supply Call to Action block
		acf_register_block_type( array(
			'name' 					=> 'supply-call-to-action',
			'title' 				=> __( 'Supply Call to Action' ),
			'description' 			=> __( 'A custom Supply Call to Action block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'buddicons-activity',
			'keywords'				=> array( 'supply', 'call', 'to', 'action' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-call-to-action.php',
			// 'render_callback'	=> 'supply_call_to_action_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-call-to-action/supply-call-to-action.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-call-to-action/supply-call-to-action.js',
			// 'enqueue_assets' 	=> 'supply_call_to_action_block_enqueue_assets',
		));
		// Register Supply Feature Block
		acf_register_block_type( array(
			'name' 					=> 'supply-feature-block',
			'title' 				=> __( 'Supply Feature Block' ),
			'description' 			=> __( 'A custom Supply Feature Block block.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'align-pull-left',
			'keywords'				=> array( 'supply', 'feature', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-feature-block.php',
			// 'render_callback'	=> 'supply_feature_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.js',
			// 'enqueue_assets' 	=> 'supply_feature_block_block_enqueue_assets',
		));
		// Register Supply Case Study Introduction Block
		acf_register_block_type(array(
			'name' => 'case-study-intro',
			'title' => 'Case Study Intro',
			'description' => 'Introduction Block for Case Studies',
			'category' => 'supply-blocks',
			'keywords' => array(
			),
			'post_types' => array( 'post', 'page', 'case-studies', 'careers' ),
			'mode' => 'preview',
			'align' => '',
			'align_content' => NULL,
			'render_template' => 'templates/blocks/supply-case-study-intro.php',
			'render_callback' => '',
			'enqueue_style' => '',
			'enqueue_script' => '',
			'enqueue_assets' => '',
			'icon' => 'id-alt',
			'supports' => array(
				'align' => true,
				'mode' => true,
				'multiple' => true,
				'jsx' => false,
				'align_content' => false,
				'anchor' => false,
			),
		));
		// Register Supply Feature Posts Block
		acf_register_block_type( array(
			'name' 					=> 'supply-posts-block',
			'title' 				=> __( 'Supply Posts Block' ),
			'description' 			=> __( 'This block displays a loop of Supplys` posts(pages, case studies, ecternal links, etc)' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'admin-post',
			'keywords'				=> array( 'supply', 'posts', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-posts-block.php',
			// 'render_callback'	=> 'supply_feature_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.js',
			// 'enqueue_assets' 	=> 'supply_feature_block_block_enqueue_assets',
		));
		// Register Supply Feature Posts Block
		acf_register_block_type( array(
			'name' 					=> 'supply-article-block',
			'title' 				=> __( 'Supply Articles Block' ),
			'description' 			=> __( 'This block displays a loop of Supplys` Articles' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'admin-post',
			'keywords'				=> array( 'supply', 'posts', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-articles-block.php',
			// 'render_callback'	=> 'supply_feature_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.js',
			// 'enqueue_assets' 	=> 'supply_feature_block_block_enqueue_assets',
		));
		// Register Supply pagination Block
		acf_register_block_type( array(
			'name' 					=> 'supply-pagination-block',
			'title' 				=> __( 'Supply pagination Block' ),
			'description' 			=> __( 'This block displays pagination for this page )' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'controls-forward',
			'keywords'				=> array( 'supply', 'posts', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-pagination-block.php',
			// 'render_callback'	=> 'supply_feature_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.js',
			// 'enqueue_assets' 	=> 'supply_feature_block_block_enqueue_assets',
		));
		// Register Supply padding Block
		acf_register_block_type( array(
			'name' 					=> 'supply-padding-block',
			'title' 				=> __( 'Supply Padding Block' ),
			'description' 			=> __( 'A custom block to add extra padding between other blocks.' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'image-flip-vertical',
			'keywords'				=> array( 'supply', 'padding', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			// 'align'				=> 'wide',
			'render_template'		=> 'templates/blocks/supply-padding-block.php',
			// 'render_callback'	=> 'supply_feature_block_block_render_callback',
			// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.css',
			// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/supply-feature-block/supply-feature-block.js',
			// 'enqueue_assets' 	=> 'supply_feature_block_block_enqueue_assets',
		));
		// Register Supply Carousel Block
		acf_register_block_type( array(
			'name' 					=> 'supply-carousel-block',
			'title' 				=> __( 'Supply Carousel Block' ),
			'description' 			=> __( 'Supply Carousel Block' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'images-alt',
			'keywords'				=> array( 'supply', 'carousel', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			'render_template'		=> 'templates/blocks/supply-carousel-block.php',
			'enqueue_script' 	=> 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
			
		));
		// Register Supply Carousel Block (FULL HEIGHT)
		acf_register_block_type( array(
			'name' 					=> 'supply-carousel-FH-block',
			'title' 				=> __( 'Supply Carousel (FULL HEIGHT) Block' ),
			'description' 			=> __( 'Supply Carousel (FULL HEIGHT) Block' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'images-alt',
			'keywords'				=> array( 'supply', 'carousel', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			'render_template'		=> 'templates/blocks/supply-carousel-fh-block.php',
			'enqueue_script' 	=> 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
			
		));
	
		// Register Supply Media (v2) Block
		acf_register_block_type( array(
			'name' 					=> 'supply-media-v2-block',
			'title' 				=> __( 'Supply Media Block (V2)' ),
			'description' 			=> __( 'Supply Media Block (Version 2)' ),
			'category' 				=> 'supply-blocks',
			'icon'					=> 'format-video',
			'keywords'				=> array( 'supply', 'media', 'video', 'block' ),
			'post_types'			=> array( 'post', 'page', 'case-studies', 'careers' ),
			'mode'					=> 'auto',
			'render_template'		=> 'templates/blocks/supply-media-block.php',
		));

	}

}

add_filter(
    'acf/pre_save_block',
    function( $attributes ) {
        if ( empty( $attributes['anchor'] ) ) {
            $attributes['anchor'] = 'acf-block-' . uniqid();
        }
        return $attributes;
    }
);
/*disable Careers Custom Post type for now

register_post_type('careers', array(
	'label' => 'Careers',
	'description' => 'Add a job posting!',
	'hierarchical' => false,
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'thumbnail',
		3 => 'excerpt',
		4 => 'custom-fields',
		5 => 'revisions',
		6 => 'page-attributes',
	),
	'taxonomies' => array(
		0 => 'category',
		1 => 'post_tag',
		2 => 'post_format',
	),
	'public' => true,
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'can_export' => true,
	'delete_with_user' => 'false',
	'labels' => array(
		'singular_name' => 'career',
		'add_new' => 'add new Job Posting',
		'add_new_item' => 'add a new Job Posting',
		'edit_item' => 'edit Job Posting',
		'new_item' => 'new Job Posting',
		'view_item' => 'Job Posting',
		'view_items' => 'View Job Postings and Careers',
		'search_items' => 'Search Careers',
		'item_updated' => 'Job posting updated',
	),
	'menu_icon' => 'dashicons-businesswoman',
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => true,
	'show_in_admin_bar' => true,
	'rewrite' => true,
	'has_archive' => 'careers',
	'show_in_rest' => true,
	'rest_base' => '',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
	'acfe_archive_template' => '',
	'acfe_archive_ppp' => 10,
	'acfe_archive_orderby' => 'date',
	'acfe_archive_order' => 'DESC',
	'acfe_single_template' => 'career-single.php',
	'acfe_admin_archive' => false,
	'acfe_admin_ppp' => 10,
	'acfe_admin_orderby' => 'date',
	'acfe_admin_order' => 'DESC',
	'menu_position' => 4,
	'capability_type' => 'post',
	'capabilities' => array(
	),
	'map_meta_cap' => NULL,
));

*/