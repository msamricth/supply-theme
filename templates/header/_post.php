<?php
$classes = '';
$header_content = '';
//Assets
$header_media = get_header_media();

$background_color = get_field('articles__background_color');
$article_landing_background_color = get_field('article_landing_background_color');

//settings
$header_type =  get_field( 'header_type' );
$classes .= $header_type; 


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
$header_content .= '</div></div></header>';






?>

<div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> header-container">
    <?php if(empty($turnTextOff)){
        echo $header_content;
    } ?>
</div>