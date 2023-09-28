<?php
/**
 * Block template file: inc/case_studies.php
 *
 * Template tags specific to case studies
 *
 * @package Supply Theme
 * @since v9
 */

 if ( ! function_exists( 'project_title_fromBlock' ) ) :
	/**
	 * since the introduction of the Case Study Intro block this has been our method to get the subtitles of each Case Study for the work page / Posts Block
	 *
	 * @since v3.8
	 */
    function project_title_fromBlock($post_id = null) {
        $current_post = get_queried_object();
        $title = '';
        if(empty($post_id)){
            $post_id = $current_post ? $current_post->ID : null;
        } 
        $post   = get_post($post_id);
        $post_title = get_the_title($post_id);
        $blocks = parse_blocks( $post->post_content );
        foreach( $blocks as $block ) {
            if( 'acf/case-study-intro' !== $block['blockName'] )
                continue;
                if( !empty( $block['attrs']['data']['title_of_work_performed'] ) ){
                    $title = $block['attrs']['data']['title_of_work_performed'];
                } else {
                    $title = $post_title;
                }
                
        }
        echo $title;
    }

endif;