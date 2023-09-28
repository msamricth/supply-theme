<?php
/**
 * Block template file: inc/offerings.php
 *
 * Template tags specific to Service Offerings
 *
 * @package Supply Theme
 * @since v9
 */


if ( ! function_exists( 'get_background_lines' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v7.7
	 */
	function get_background_lines($custom=null) {
        $output ='<div class="offering-specific-elements container">';
        $output .='<div class="overlay position-fixed row vr-line-group">';
        $output .='<div class="col col-dlg-3"><div class="vr-line"></div></div>';
        $output .='<div class="col col-dlg-4"><div class="vr-line mx-auto mx-dlg-0"></div></div>';
        $output .='<div class="col  col-dlg-4 d-none d-dlg-block"><div class="vr-line"></div></div>';
        $output .='<div class="col d-none d-dlg-block"><div class="vr-line"></div></div>';
        $output .='<div class="col"><div class="ms-auto vr-line"></div></div>';
        $output .='</div>';
        $output .='</div>';
		return $output;
    }

endif;

if ( ! function_exists( 'the_so_excerpt' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v7.9
	 */
	function the_so_excerpt($post_id=null) {
        $current_post = get_queried_object();
        $output = '';
        if(empty($post_id)){
            $post_id = $current_post ? $current_post->ID : null;
        } 
        $i = 0;
        $post = get_post($post_id);
        $blocks = parse_blocks( $post->post_content );
        foreach( $blocks as $block ) {
            if( 'acf/supply-content-block' !== $block['blockName'] )
                continue;
                    if( !empty( $block['attrs']['data']['block_content_content'] ) ){
                        $output = $block['attrs']['data']['block_content_content'];
                    } else {
                        $output = 'No content or cannot read any content';
                    }
                
        }
		return $output;
    }

endif;
if ( ! function_exists( 'get_mobile_subnav' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v7.1.5
	 */
	function get_mobile_subnav($post_type=null) {
        global $post;
        $prevPost = get_previous_post();
        $nextPost = get_next_post();
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
        $current_count = '';
        $current_title = '';
        $nextOffering = '';
        $prevOffering = '';
        $the_query = new WP_Query( $args );
        $mobile_nav = '';
        $count = 0;
        $prevSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M13 19.9999L27 19.9999" stroke="#C8C9C8"/><path d="M22.3333 14L26.9999 20L22.3333 26" stroke="#C8C9C8"/></svg>';
        $nextSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M27 19.9999L13 19.9999" stroke="#C8C9C8"/><path d="M17.6667 26L13.0001 20L17.6667 14" stroke="#C8C9C8"/></svg>';
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
            
                $post_id = url_to_postid(get_the_permalink());
                $slug = get_post_field( 'post_name', $post_id );
                if (isset($currentID)) {
                    $postID = get_the_ID();
                    if($currentID == $postID) {
                        $current_count = $count;
                        $current_title = get_the_title(); 
                    }
                }
            endwhile; 
            if ( $prevPost ) : 
                $post = $prevPost->ID; 
                setup_postdata( $post ); 
                    $post_id = url_to_postid(get_the_permalink());
                    $slug = get_post_field( 'post_name', $post_id );
                    $nextOffering .= '<a href="'.get_the_permalink().'" id="subnav-'.$post_id.'" data-slug="/'.$slug.'" class="subnav-link" title="'.get_the_title().'" rel="bookmark" data-title="'.get_the_title().'">';
                    $nextOffering .= '<span class="title sr-only sr-only-focusable d-none">'. get_the_title().'</span>';
                    $nextOffering .= $prevSVG;
                    $nextOffering .= '</a>';
                wp_reset_postdata(); 
            else: 
                if ( empty( $prevPost ) ) {
                    
                    $prevOfferingargs = array(
                        'numberposts' => 1, 'post_type' => 'service-offerings', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => '1'
                    );
                    $first_post = $last_post = null;
                    // get first post
                    $first_post_query = new WP_Query( $prevOfferingargs + array( 'order' => 'DESC' ) );
                    if ( $first_posts = $first_post_query->get_posts() ) {
                        $first_post = array_shift( $first_posts );
                    }
                    $post = $first_post->ID;
                    setup_postdata( $post ); 
                        $post_id = url_to_postid(get_the_permalink());
                        $slug = get_post_field( 'post_name', $post_id );
                        $nextOffering .= '<a href="'.get_the_permalink().'" id="subnav-'.$post_id.'" data-slug="/'.$slug.'" class="subnav-link" title="'.get_the_title().'" rel="bookmark" data-title="'.get_the_title().'">';
                        $nextOffering .= '<span class="title sr-only sr-only-focusable d-none">'. get_the_title().'</span>';
                        $nextOffering .= $prevSVG;
                        $nextOffering .= '</a>';
                    wp_reset_postdata(); 
                }
            endif;
            if ( $nextPost ) : 
                $post = $nextPost->ID; 
                setup_postdata( $post ); 
                $post_id = url_to_postid(get_the_permalink());
                $slug = get_post_field( 'post_name', $post_id );   
                $prevOffering .= '<a href="'.get_the_permalink().'" id="subnav-'.$post_id.'" data-slug="/'.$slug.'" class="subnav-link" title="'.get_the_title().'" rel="bookmark" data-title="'.get_the_title().'">';
                $prevOffering .= '<span class="title sr-only sr-only-focusable d-none">'. get_the_title().'</span>';
                $prevOffering .= $nextSVG;
                $prevOffering .= '</a>';
                wp_reset_postdata(); 
            else: 
                if ( empty( $nextPost ) ) {
                    $nextOfferingargs = array(
                        'numberposts' => 1, 'post_type' => 'service-offerings', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => '1'
                    );
                    $first_post = $last_post = null;
                    // last post
                    $last_post_query = new WP_Query( $nextOfferingargs + array( 'order' => 'ASC' ) );
                    if ( $last_posts = $last_post_query->get_posts() ) {
                        $last_post = array_shift( $last_posts );
                    }
                    $post = $last_post->ID; 
                    setup_postdata( $post ); 
                        $post_id = url_to_postid(get_the_permalink());
                        $slug = get_post_field( 'post_name', $post_id );   
                        $prevOffering .= '<a href="'.get_the_permalink().'" id="subnav-'.$post_id.'" data-slug="/'.$slug.'" class="subnav-link" title="'.get_the_title().'" rel="bookmark" data-title="'.get_the_title().'">';
                        $prevOffering .= '<span class="title sr-only sr-only-focusable d-none">'. get_the_title().'</span>';
                        $prevOffering .= $nextSVG;
                        $prevOffering .= '</a>';
                    wp_reset_postdata(); 
                }
            endif;
            $mobile_nav .= '<div class="nav subnav flex-column bg-transparent nav-underline d-dlg-none">';
            $mobile_nav .= '<div class="d-flex chapter align-items-center">';
            $mobile_nav .= $prevOffering;
            $mobile_nav .= '<span class="iso-reg h8">';
            $mobile_nav .= $current_count .'&nbsp;of&nbsp;'. $count;
            $mobile_nav .= '</span>';
            $mobile_nav .= $nextOffering;
            $mobile_nav .= '</div>';
            $mobile_nav .= '<h5 class="title">' . get_the_title() . '</h5>';
            $mobile_nav .= '</div>';
            $output .= $mobile_nav;
            wp_reset_postdata();
         endif; 
		return $output;
    }

endif;
