<?php
/**
 * Block template file: templates/blocks/supply-quote-block.php
 *
 * Supply Quotes Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-quotes-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-quotes';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .= ' wp-block-quote ';
$cite = get_field( 'cite' ); 
if(get_field( 'positioning' )){
    $classes .= get_field( 'positioning' );
} 
$extra_cite_details = get_field( 'extra_cite_details' ); 
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>
<blockquote id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <p>&ldquo;<?php the_field( 'quote' ); ?>&rdquo;</p>
            <?php if($cite) {?> 
                <cite>
                    <strong><?php the_field( 'cite' ); ?></strong>
                    <?php if($extra_cite_details){ echo '<span>'.$extra_cite_details.'</span>';} ?>
                </cite>
            <?php } ?>
        </div>
    </div>
</blockquote>