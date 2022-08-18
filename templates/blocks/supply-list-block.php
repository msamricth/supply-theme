<?php
/**
 * Block template file: templates/blocks/supply-list-block.php
 *
 * Supply List Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-list-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-list-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$blockContent = '';
$type = '';
$listTitle = '';
$list_items = ''; 
$classes .= ' fadeNoScroll';
$classes .= ' row justify-content-between justify-content-4xl-start cp3';
$i = 0;
$blockContent .= '<div id="'. esc_attr( $id ) .'" class="'. esc_attr( $classes ) .'">';
if ( have_rows( 'lists' ) ) : 
    while ( have_rows( 'lists' ) ) : the_row(); $i++;   
        $blockContent .='<div class="col-11 col-md-4 col-dlg-3 cp2 fadeNoScroll pe-4xl-5">';
        if ( have_rows( 'list_item_header' ) ) : 
            while ( have_rows( 'list_item_header' ) ) : the_row(); 
                $type = get_sub_field( 'type' ); 
                if(empty($type)) {
                    $type = 'h6';
                }
                $listTitle = get_sub_field('title');
                if($listTitle){
                    $listTitle = '<'.$type.' class="cp1 pe-4">'.$listTitle.'</'.$type.'> ';
                    $blockContent .= $listTitle;
                }
            endwhile; 
        endif; 
        $listContent = get_sub_field( 'list_content' );
        if($listContent){
            $blockContent .= '<p>' . $listContent . '</p>';
        }
        $blockContent .='</div>';
        if ($i % 3 == 0) {
            $blockContent .= '<div class="w-100 d-none d-dlg-block d-4xl-none"></div>';
        }
    endwhile; 
else : 
endif;
$blockContent .='</div>'; 
if ( have_rows( 'container_settings' ) ) : 
    while ( have_rows( 'container_settings' ) ) : the_row(); 
        echo supply_grid($blockContent, 'col-dlg-12');
    endwhile;
else:
    echo supply_grid_sh($blockContent, 'col-dlg-12');
endif;