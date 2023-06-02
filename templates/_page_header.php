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
                $beforeContainer = '';
                $afterContainer = '';
                break;
                
            case 'standardmedia':
                $afterContainer = supply_page_starter();
                break;
            
            case 'services':
                $afterContainer = supply_page_starter();
                break;   

            case 'standardmedialinked':
                $afterContainer = supply_page_starter();
                break;   

            case 'contact':
                $beforeContainer = supply_page_starter();
                $hasSidebar = is_page_php();
                if ( ! empty( $hasSidebar ) ) {
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-dlg-7 col-xl-7 col-3xl-5 offset-3xl-1 fadeNoScroll order-2 order-dlg-1">';
                    $afterContainer .='<header class="page-header d-dlg-block d-none fold" data-class="header">';
                    $afterContainer .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                    $afterContainer .= '</header>';
                }
                break;
                
            case 'basic':
                $beforeContainer = supply_page_starter();
                $hasSidebar = is_page_php();
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
                $header_type = 'basic';
                $beforeContainer = supply_page_starter();
                $hasSidebar = is_page_php();
                if ( ! empty( $hasSidebar ) ) {
                    $classes .= ' d-dlg-none';
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-dlg-7 col-xl-7 col-3xl-5 offset-3xl-1 fadeNoScroll order-2 order-dlg-1">';
                    $afterContainer .='<header class="page-header d-dlg-block d-none fold" data-class="header">';
                    $afterContainer .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                    $afterContainer .= '</header>';
                }
        }


echo $beforeContainer;


if($headerOn == 1){

    get_template_part('templates/header/_'.$header_type); 

} 
echo $afterContainer; ?>