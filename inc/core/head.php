<?php
/**
 * Block template file: inc/core/head.php
 * Head functions
 * These functions help initate many of the core theme functions such as page color scheme, video functions, the fold and more
 *
 * @package Supply Theme
 * @since v9
 */



 if ( ! function_exists( 'bg_images' ) ) :
	/**
	 * Background images
	 *
	 * @since v3 - updated v8
	 */
    function bg_images() {  
        if ( get_field( 'background_image', 'option' ) ) : ?>
            <style>
                .bg-pattern {
                    background-image: url('<?php the_field( 'background_image', 'option' ); ?>');
                }
            </style>
    <?php
        endif; 
        if ( get_field( 'offerings_image', 'option' ) ) : ?>
            <style>
                .bg-offerings {
                    background-image: url('<?php the_field( 'offerings_image', 'option' ); ?>');
                }
            </style>
    <?php
        endif;
    }
    add_action('wp_head', 'bg_images', 100);
    add_filter( 'excerpt_more', '__return_empty_string' ); 
endif;

if ( ! function_exists( 'transtion_settings' ) ) :
	/**
	 * transition settings
	 *
	 * @since v3 - updated v8
	 */
    function transtion_settings(){
        $headStyles = '';
        $foldTransition = '';
        $transition_duriation = get_field( 'transition_duriation', 'option' ); 
        $transition_type = get_field( 'transition_type', 'option' ); 
        if($transition_duriation){
            if($transition_type){
                $foldTransition = $transition_duriation . ' ' . $transition_type;
                $headStyles .= '<style>#wrapper {   
                    -webkit-transition: background-color '. $foldTransition.',color '. $foldTransition.', opacity '. $foldTransition.', all '. $foldTransition.';
                    transition: background-color  '. $foldTransition.',color '. $foldTransition.', opacity '. $foldTransition.', all '. $foldTransition.';</style>';
            }
        }
        return $headStyles;
    }

    add_action('wp_head', 'transtion_settings', 100);
endif;

if ( ! function_exists( 'get_bodyclasses' ) ) :
	/**
	 * Body classes for the main document. Most settings can be accessed here : domainname.com/wp-admin/admin.php?page=theme_options
	 *
	 * @since v9
	 */
    function get_bodyclasses(){
        $post_id = get_supply_postID();
        $navbar_scheme = '';
        $bodyClasses ='';
        $navbar_page_scheme = get_field( 'navbar_color_settings', $post_id);
        $navbar_theme_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
        $scheme = get_scheme();


        if(strpos($navbar_page_scheme, 'default') !== false){
            if ( is_single() && 'post' == get_post_type() ) {
                $navbar_scheme = 'navbar-transparent navbar-dark dark-scheme nav-bg-transparent-dark';
                //$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
            } else {
                $navbar_scheme = $navbar_theme_scheme;
            }
        } elseif(strpos($navbar_page_scheme, 'transparent-dark') !== false){
            $navbar_scheme .= 'navbar-transparent navbar-dark dark-scheme';
            $navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
        } elseif(strpos($navbar_page_scheme, 'transparent-light') !== false){
            $navbar_scheme .= 'navbar-transparent navbar-light light-scheme';
            $navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
        } else {
            if ( is_single() && 'post' == get_post_type() ) {
                $navbar_scheme = 'navbar-transparent navbar-dark dark-scheme nav-bg-transparent-dark';
                //$navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
            } else {
                $navbar_scheme .= 'navbar-'.$navbar_page_scheme;
                $navbar_scheme .= ' nav-bg-'.$navbar_page_scheme;
            }
        }
        $bodyClasses .= $navbar_scheme;


        if ( get_field( 'fold_on' ) == 1 ) :
        else : 
            $bodyClasses .= ' fold_on ';
        endif; 
        if(strpos($scheme, 'bg-custom') !== false){
            $bodyClasses .=" customScheme ";
        }
        if ( get_field( 'lazy_load_videos', 'option' ) == 1 ) : 
            $bodyClasses .= 'lazy_load_videos ';
        endif; 
        if ( get_field( 'nav_compression', 'option' ) == 1 ) : 
            $bodyClasses .= 'nav_compression ';
        endif; 

        return $bodyClasses;
        
    }
endif;



if ( ! function_exists( 'get_scroller_attributes' ) ) :
	/**
	 * Data attributes that largely control fold related events and variables. Most settings can be accessed here : domainname.com/wp-admin/admin.php?page=theme_options
	 *
	 * @since v9
	 */
    function get_scroller_attributes(){
        $dataAttributes = '';
        $top_trigger_area = get_field( 'top_trigger_area', 'option' ); 
        if($top_trigger_area) {
            $dataAttributes .=' data-topTA="'.$top_trigger_area.'"';
        }
        $bottom_trigger_area = get_field( 'bottom_trigger_area', 'option' ); 
        if($bottom_trigger_area) {
            $dataAttributes .=' data-bottomTA="'.$bottom_trigger_area.'"';
        }
        $scroll_fold_actions_checked_values = get_field( 'scroll_fold_actions', 'option' ); 
        if ( $scroll_fold_actions_checked_values ) : 
            $dataAttributes .=' data-scroll-actions="';
            foreach ( $scroll_fold_actions_checked_values as $scroll_fold_actions_value ): 
                $dataAttributes .= $scroll_fold_actions_value . ' ';
            endforeach; 
            $dataAttributes .= '"';
        endif; 
        if ( get_field( 'allow_custom_colors', 'option' ) == 1 ) : 
            $dataAttributes .=' data-custom="true"';
        endif; 
        
        if ( get_field( 'reset', 'option' ) == 1 ) : 
            $dataAttributes ='data-fold-reset="true" data-custom="true "';
        endif;

        $debug_log_checked_values = get_field( 'debug_log', 'option' ); 
        if ( $debug_log_checked_values ) : 
            foreach ( $debug_log_checked_values as $debug_log_value ): 
            $dataAttributes .= ' ' . esc_html( $debug_log_value ) . '="true" ';
            endforeach; 
        endif;
        
        return $dataAttributes;
    }

endif;


if ( ! function_exists( 'get_wrapper' ) ) :
	/**
	 * Class and Attributes for the main page wrapper. This is where the magic happens Most settings can be accessed here : domainname.com/wp-admin/admin.php?page=theme_options
	 *
	 * @since v9
	 */
    function get_wrapper(){
        $output = "";
        $wrapperClasses ='';
        $ogClass ='';
        $addtlAttr = '';

        $scheme = get_scheme();

        if(strpos($scheme, 'bg-custom') !== false){
            $customBG = get_field( 'custom_bg_color' ); 
            $customColorVar = get_field( 'custom_text_color' ); 
            $customColor = '';
            if($customColorVar){
                if(strpos($customColorVar, '#') !== false){
                    $customColor = $customColorVar;
                } else {
                    $customColor = '#'.$customColorVar;
                }
                $customColor = ' --bgcustom: '.$customColorVar;
                $addtlAttr .= 'data-color="'.$customColor.'" ';
            }
            $addtlAttr .= 'data-bg="'.$customBG.'"';
        }
        
        $ogClass = $scheme;
        $wrapperClasses .= $scheme;
        $output .= 'class="'.$wrapperClasses.'" ';
        $output .= 'data-og_class="'.$ogClass.'" ';
        $output .= $addtlAttr;

        return $output;
    }
endif;