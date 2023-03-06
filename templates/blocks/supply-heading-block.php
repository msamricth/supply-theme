<?php
/**
 * Block template file: templates/blocks/supply-heading-block.php
 *
 * Supply Heading Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-heading-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-heading-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$blockClasses = '';
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'block_header' ) ) : ?>
		<?php while ( have_rows( 'block_header' ) ) : the_row(); 
            $padding_block = get_sub_field( 'padding_bottom' ); 

            if (isset($padding_block)) {
                $blockClasses .= $padding_block;
            }
            $type = get_sub_field( 'type' ); 
            if(empty($type)) {
                $type = 'h5';
            }
            $blockTitle = get_sub_field('title');
            if($blockTitle){
                $blockTitle = '<'.$type.' class="'.$blockClasses.'">'.$blockTitle.'</'.$type.'> ';
            }
                echo $blockTitle; 
        endwhile; ?>
	<?php endif; ?>
</div>