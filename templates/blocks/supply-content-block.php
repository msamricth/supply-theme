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
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">

<?php if ( have_rows( 'block_header' ) ) : ?>
		<?php while ( have_rows( 'block_header' ) ) : the_row(); 
            $type = get_sub_field( 'type' ); 
            if(empty($type)) {
                $type = 'h5';
            }
            $blockTitle = get_sub_field('title');
            if($blockTitle){
                $blockTitle = '<'.$type.' class="cp1 pe-4">'.$blockTitle.'</'.$type.'> ';
                if (empty( $sepContainers ) ) {
                    $blockTitle .= $blockContent;
                }
            }
            if($blockTitle){
                echo supply_grid($blockTitle, 'col-md-9 col-dlg-7 col-xl-5 offset-md-1 offset-dlg-2 offset-xl-3');
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