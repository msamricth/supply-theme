<!--- Page header template -->
<?php

//Variable list
$classes = '';
$header_container = '';
$blockStyles = '';
$header_content = '';
$pageHeader ='';
$headerOn = 1;
$blockClasses = 'col-dlg-10 mx-auto col-xl-8';
$blockContent = '';
$beforeContainer = '';
$afterContainer = '';

//Text Object Stuff that can be defined early to make the Structure Functions cleaner
$title_of_work_performed = get_field('title_of_work_performed');
if (empty($title_of_work_performed)):
    $title_of_work_performed = get_the_title();
endif;
if (isset($args['page_title'])) {
    $page_title = $args['page_title'];
}
//$header_cta = header_link();
$heading_text = get_field('header_text');
if (empty($heading_text)):
    $heading_text = get_the_title();
endif;

if (empty($heading_text))://if its stillll empty
    $heading_text = $page_title;
endif;

//Assets
$headerMedia = '';
$header_media = get_header_media();
$client_logo = get_field('client_logo');
$background_color = get_field('articles__background_color');
$article_landing_background_color = get_field('article_landing_background_color');
//settings
$header_type =  get_field( 'header_type' );
$classes .= $header_type; 
if ( get_field( 'disable_header_text' ) == 1 ) :
    $turnTextOff = 1;
endif;
$headerOverlayBG = '';
$headerOverlayOpacity = '';


//Structure Functions


        switch ( $header_type ) {
            case 'casestudy':
                $header_content .= '<header class="page-header fold" data-class="header">';
                $classes .= ' cp3';
                $headerMedia= true;
                $beforeContainer = '';
                $afterContainer = '';
                $header_content .= '<div class="container">';
                if ($client_logo):
                    $header_content .= '<img class="img-responsive client-logo" src="' . esc_url($client_logo['url']) . '" alt="' . esc_attr($client_logo['alt']) . '" />';
                    $header_content .= '<h3 class="card-title cp1">' . $title_of_work_performed . '</h3>';
                endif;
                $header_content .= '</div>';
                break;
                
            case 'standardmedia':
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                $header_content .= '<header class="page-header fold" data-class="header">';
                $classes .= ' header-partial';
                $headerMedia= true;
                $header_content .= '<div class="container">';
                $blockContent .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $header_content .= supply_grid($blockContent, $blockClasses); 
                $header_content .= '</div>';
                $afterContainer = supply_page_starter();
                break;
            
            case 'services':
                $header_content .= '<header class="page-header fold" data-class="header">';
                $blockClasses = 'mx-auto col-xl-10 col-3xl-9 col-4xl-8';
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                $classes .= ' header-partial';
                $headerMedia= true;
                $header_content .= '<div class="container">';
                $blockContent .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $header_content .= supply_grid($blockContent, $blockClasses); 
                $header_content .= '</div>';
                $afterContainer = supply_page_starter();
                break;   

            case 'standardmedialinked':
                $header_content .= '<header class="page-header fold" data-class="header">';
                $headerMedia= true;
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                $blockClasses = 'col-dlg-12 mx-auto col-xl-9 col-xxl-8 col-3xl-7 col-4xl-6';
                $classes .= ' header-partial';
                $header_content .= '<div class="container">';
                $blockContent .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $blockContent .=  header_link();
                $header_content .= supply_grid($blockContent, $blockClasses);  
                $header_content .= '</div>';
                $afterContainer = supply_page_starter();
                break;   

            case 'contact':
                $header_content .= '<header class="page-header fold" data-class="header">';
                $blockClasses = 'col-dlg-10 mx-auto col-xl-8 col-3xl-11';
                $beforeContainer = supply_page_starter();
                $header_content .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $hasSidebar = is_page_php();
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                if ( ! empty( $hasSidebar ) ) {
                    $classes .= ' d-dlg-none';
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-dlg-7 col-xl-7 col-3xl-5 offset-3xl-1 fadeNoScroll order-2 order-dlg-1">';
                    $afterContainer .='<header class="page-header d-dlg-block d-none fold" data-class="header">';
                    $afterContainer .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                    $afterContainer .= '</header>';
                }
                break;
                
            case 'basic':
                $header_content .= '<header class="page-header fold" data-class="header">';
                $beforeContainer = supply_page_starter();
                $header_content .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $hasSidebar = is_page_php();
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                if ( ! empty( $hasSidebar ) ) {
                    $classes .= ' d-dlg-none';
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-dlg-7 col-xl-7 col-3xl-6 fadeNoScroll order-2 order-dlg-1">';
                    $afterContainer .='<header class="page-header d-dlg-block d-none fold" data-class="header">';
                    $afterContainer .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                    $afterContainer .= '</header>';
                }
                break;
                
            case 'none':
                $headerOn = '';
                $afterContainer = supply_page_starter();
                break;
            case 'post':
               // $classes .= ' under-nav'; 
                
                if(empty($background_color)){
                    $background_color = '#213333';
                }
                if($background_color == "light"){
                    
                    $background_color = '#ffffff';
                }
                $rgb = HTMLToRGB($background_color);
                $hsl = RGBToHSL($rgb);
                $article_header_image = get_field('article_header_image');
                if($hsl->lightness > 200) {
                // this is light colour!
                    $classes .= ' text-primary';
                } else {
                    $classes .= ' text-white';
                }
                $header_content .= '<style>.post-thumbnail.header-image {background-image:url('.get_the_post_thumbnail_url( get_the_ID(), 'full' ).');}</style>';
                $header_content .= '<header class="entry-header article-header fold" data-class="header" style="background-color: '.$background_color.'">';
                $header_content .= '<div class="container"><div class="row">';
                $header_content .= '<div class="col-md-6 offset-dlg-1 col-dlg-5 article-header__content">';
                $header_content .= '<span class=" h8" title="Posted Date" rel="bookmark">'.esc_attr( get_the_date('M j')).' &#x2022; <span class="read-time"></span></span>';
                $header_content .= '<h3 class="mb-0">'.get_the_title().'</h3>';
                $header_content .= supply_entry_meta('yes');
                $header_content .= '</div>';
            
                    $header_content .= '<div class="col-md-6 col-dlg-5 offset-dlg-1">';                    
                    if ( has_post_thumbnail() ) :
						$header_content .= '<div class="post-thumbnail header-image"></div>';
					endif;
                    $header_content .= '</div>';
                $header_content .= '</div></div>';

               // $afterContainer = supply_page_starter();
                
                break;
                case 'posts':
   
                    if(empty($article_landing_background_color)){
                        $article_landing_background_color = '#213333';
                    }
                    if($article_landing_background_color == "light"){
                        
                        $article_landing_background_color = '#ffffff';
                    }
                    $rgb = HTMLToRGB($article_landing_background_color);
                    $hsl = RGBToHSL($rgb);
                    $article_header_image = get_field('article_header_image');
                    if($hsl->lightness > 200) {
                    // this is light colour!
                        $classes .= ' text-primary';
                    } else {
                        $classes .= ' text-white';
                    }
                    $post_IDs = '';
                    $featured_post = get_field( 'featured_post' ); 
                    if ( $featured_post ) : 
                        $post_IDs .= $featured_post . ', ';
                    endif; 

                    $post_IDs = array_map( 'trim', explode( ',', $post_IDs ) ); // right
                    if ( $featured_post ) : 
                        $args = array(
                            'post_type' => array('post'),
                            'posts_per_page' => 1,
                            'post__in' => $post_IDs
                            
                        );
                    else :
                        $args = array(
                            'post_type' => array('post'),
                            'posts_per_page' => 1
                        );   
                    endif; 
                    $the_query = new WP_Query( $args ); 
                    
                    echo '<header class="entry-header article-header fold" data-class="header" style="background-color: '.$article_landing_background_color.'">';
              //      echo  '<div class="container">';
                    while ( $the_query->have_posts() ) : $the_query->the_post(); 
                        $post_type = get_post_type(); 
                        get_template_part('templates/_content', $post_type);
                    endwhile;
                    wp_reset_postdata(); 
                 //  echo  '</div>';
                break;
            default:
                $header_content .= '<header class="page-header fold" data-class="header">';
                $beforeContainer = supply_page_starter();
                $header_content .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $hasSidebar = is_page_php();
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                if ( ! empty( $hasSidebar ) ) {
                    $classes .= ' d-dlg-none';
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-dlg-7 col-xl-7 col-3xl-5 offset-3xl-1 fadeNoScroll order-2 order-dlg-1">';
                    $afterContainer .='<header class="page-header d-dlg-block d-none fold" data-class="header">';
                    $afterContainer .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                    $afterContainer .= '</header>';
                }
        }
$header_content .= '</header>';
echo $beforeContainer;
if($headerOn == 1){ ?>
    <div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> header-container">
        <?php if(empty($turnTextOff)){
            echo $header_content;
        } 
        if(!empty($headerMedia)){
            
            echo $header_media;
        } ?>
    </div>
<?php } 
echo $afterContainer; ?>