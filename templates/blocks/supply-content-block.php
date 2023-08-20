<?php
/**
 * Block template file: templates/blocks/supply-content-block.php
 *
 * Supply Content Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'supply-content-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-content-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .=' fadeNoScroll';
$blockTitle = '';
$blockContent = '';
$sepContainers = '';
if ( have_rows( 'block_content' ) ) : 
    while ( have_rows( 'block_content' ) ) : the_row(); 
        $blockContent = get_sub_field('content');
        if ( get_sub_field( 'inherit_block_header_column_settings' ) == 1 ) : 
        else:
            $sepContainers = 1;
        endif;
    endwhile; 
endif;

$link = '';
$linkTitle = get_field( 'link_text' );
$page_lookup = get_field( 'page_lookup' ); 
$linkClass = '';
$linkURL = get_field( 'url' );
if ( have_rows( 'options' ) ) :
    while ( have_rows( 'options' ) ) : the_row(); 
        $padding_block = get_sub_field( 'padding_bottom' ); 

        if (isset($padding_block)) {
            $classes .= ' '.$padding_block;
        }
        if ( get_sub_field( 'use_url' ) == 1 ) {
            if (isset($linkURL)) {
                $link = $linkURL;
            }
            if(empty($linkTitle)){
                $linkTitle = 'Let’s talk about your project';
            }
        } else {
            if ( $page_lookup ) : 
                $link = get_permalink( $page_lookup );
                if(empty($linkTitle)){
                    $linkTitle = get_the_title( $page_lookup );
                }
             endif; 
        }
        if ( get_sub_field( 'external_url' ) == 1 ) :
            $linkClass = 'link-up';
        endif;
    endwhile;
endif;
if(!empty($link)){
    $blockContent .='<a class="'.esc_html($linkClass).'" '; 
    if($linkClass){
        $blockContent .='target="_blank" '; 
    } 
    $blockContent .='href="'.esc_url( $link).'">'.esc_html( $linkTitle ).'</a>';
}

$extras = get_container_scheme();
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); echo $extras;?>">

<?php if ( have_rows( 'block_header' ) ) : ?>
		<?php while ( have_rows( 'block_header' ) ) : the_row(); 
            $type = get_sub_field( 'type' ); 
            if(empty($type)) {
                $type = 'h5';
            }
            $blockTitle = get_sub_field('title');
            if($blockTitle){
                $blockTitle = '<'.$type.' class="cp1">'.$blockTitle.'</'.$type.'> ';
                if (empty( $sepContainers ) ) {
                    $blockTitle .= $blockContent;
                }
            }
            if($blockTitle){
                echo supply_grid($blockTitle, 'col-md-10 col-dlg-8 col-xl-6 offset-md-1 offset-dlg-2 offset-xl-3');
            }  
        endwhile; 
       endif;
       if($sepContainers){
        if ( have_rows( 'block_content' ) ) : 
            while ( have_rows( 'block_content' ) ) : the_row(); 
            $blockContent = get_sub_field('content'); 
            if($blockContent){
                echo supply_grid($blockContent, 'col-md-10 col-dlg-8 col-xl-6 offset-md-1 offset-dlg-2 offset-xl-3');
            } 
		 endwhile; 
        endif;
    }
    ?>
</div>