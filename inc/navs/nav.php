
<?php
/**
 * Block template file: inc/navs/nav.php
 *
 * 
 * Nav functions for the Supply Theme
 *
 * @package Supply Theme
 * @since v9
 */


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

if ( ! function_exists( 'get_subnav' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v7.1.5
	 */
	function get_subnav($post_type=null) {
        $output = '';
        $args = [];
        $currentID = get_the_ID();
        
        
        if (isset($post_type)) {
            $args = array(
                'post_type' => $post_type
            );   
        } else {
            $args = array(
                'post_type' => array('service-offerings')
            ); 
        }  
        $the_query = new WP_Query( $args );
        $output = '<ul class="nav flex-column bg-transparent nav-underline supply-underline d-none d-dlg-flex">';
        $count = 0;
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
            
                $post_id = url_to_postid(get_the_permalink());
                $slug = get_post_field( 'post_name', $post_id );
                $output .= '  <li class="nav-item">';
                $output .= '<a href="'.get_the_permalink().'" id="subnav-'.$post_id.'" data-slug="/'.$slug.'" class="d-flex ';
                if (isset($currentID)) {
                    $postID = get_the_ID();
                    if($currentID == $postID) {
                        $output .= 'active ';
                    }
                }
                $output .='subnav-link nav-link" title="'.get_the_title().'" rel="bookmark" data-title="'.get_the_title().'">';
                $output .= '<span class="chapter">0'.$count.'</span><div class="vr-line align-self-stretch"></div><span class="title">';
                $output .= get_the_title(); 
                $output .= '</span></a>';
                $output .= '</li>';
            endwhile; 
            $output .= '</ul>';
            wp_reset_postdata();
         endif; 
		return $output;
    }

endif;

if ( ! function_exists( 'get_navbrand' ) ) :
	/**
	 * Navbar logo link thing via bootstrap
	 *
	 * @since v9
	 */
    function get_navbrand(){
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

        $output = '<a class="navbar-brand" href="'.esc_url( home_url() ).'" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
        if ( have_rows( 'nav_logos', 'option' ) ) :  
            if($nav_svg){
                $output .= $nav_svg;
            } else {
                $output .=  $nav_light_image . $nav_dark_image;
            }
        else :
            $output .=  esc_attr( get_bloginfo( 'name', 'display' ) );
        endif;
        $output .= '</a>';

        return $output;
    }
endif;

if ( ! function_exists( 'get_nav_header' ) ) :
	/**
	 * determines classes for header nav
	 *
	 * @since v9
	 */
    function get_nav_header($classes = null) {
        $navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
        $output = '';
        if($classes) {
            $output .= $classes.' ';
        }
        if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : $output .= ' fixed-top'; 
        elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : $output .= ' fixed-bottom'; endif; 
        if ( is_home() || is_front_page() ) : $output .= ' home'; endif;

        
        return $output;
    }
endif;