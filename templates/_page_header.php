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

//settings
$header_type =  get_field( 'header_type' );
$classes .= $header_type; 
if ( get_field( 'disable_header_text' ) == 1 ) :
    $turnTextOff = 1;
endif;


//Structure Functions

$header_content .= '<header class="page-header fold" data-class="header">';
        switch ( $header_type ) {
            case 'casestudy':
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
                $classes .= ' header-partial';
                $headerMedia= true;
                $header_content .= '<div class="container">';
                $blockContent .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $header_content .= supply_grid($blockContent, $blockClasses); 
                $header_content .= '</div>';
                $afterContainer = supply_page_starter();
                break;

            case 'standardmedialinked':
                $headerMedia= true;
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                $classes .= ' header-partial';
                $header_content .= '<div class="container">';
                $blockContent .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $blockContent .=  header_link();
                $header_content .= supply_grid($blockContent, $blockClasses);  
                $header_content .= '</div>';
                $afterContainer = supply_page_starter();
                break;   

            case 'basic':
                $beforeContainer = supply_page_starter();
                $header_content .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $hasSidebar = is_page_php();
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                if ( ! empty( $hasSidebar ) ) {
                    $classes .= ' d-dlg-none';
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-lg-8 col-xl-7 col-3xl-6 fadeNoScroll order-2 order-dlg-1">';
                    $afterContainer .='<header class="page-header d-dlg-block d-none fold" data-class="header">';
                    $afterContainer .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                    $afterContainer .= '</header>';
                }
                break;
                
            case 'none':
                $headerOn = '';
                $afterContainer = supply_page_starter();
                break;
            default:
                $beforeContainer = supply_page_starter();
                $header_content .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
                $hasSidebar = is_page_php();
                if ( get_field( 'sit_under_nav' ) == 1 ) :
                    $classes .= ' under-nav'; 
                endif;
                if ( ! empty( $hasSidebar ) ) {
                    $classes .= ' d-dlg-none';
                    $afterContainer .='<div class="row">';
                    $afterContainer .='<div class="col-lg-8 col-xl-7 col-3xl-6 fadeNoScroll order-2 order-dlg-1">';
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