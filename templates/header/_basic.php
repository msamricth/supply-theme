<?php
$classes = '';
$header_content = '';
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
$header_content .='<h1 class="page-title fadeNoScroll">'.$heading_text.'</h1>';
$header_content .= '</header>';
$hasSidebar = is_page_php();
if ( ! empty( $hasSidebar ) ) {
    $classes .= ' d-dlg-none';
}
?>




<div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> header-container">
    <?php if(empty($turnTextOff)){
        echo $header_content;
    }  ?>
</div>