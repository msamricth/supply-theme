<?php
$blockClasses = 'mx-auto col-xl-10 col-3xl-9 col-4xl-8';
$classes = '';
$header_content = '';
$blockContent = '';
$page_title = '';
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
//settings
$header_type =  get_field( 'header_type' );
$classes .= $header_type; 
if ( get_field( 'disable_header_text' ) == 1 ) :
    $turnTextOff = 1;
endif;



if ( get_field( 'sit_under_nav' ) == 1 ) :
    $classes .= ' under-nav'; 
endif;
$header_content .= '<header class="page-header fold" data-class="header">';
$classes .= ' header-partial';
$headerMedia= true;

$header_content .= '<div class="container">';
$blockContent .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
$header_content .= supply_grid($blockContent, $blockClasses); 
$header_content .= '</div></header>';

?>

<div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> header-container">
    <?php if(empty($turnTextOff)){
        echo $header_content;
    } 
    if(!empty($headerMedia)){
        
        echo $header_media;
    } ?>
</div>