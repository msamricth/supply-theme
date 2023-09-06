<?php
/**
 * Block template file: templates/blocks/supply-link-block.php
 *
 * Supply Link Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-link-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-link-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$link = '';
$linkTitle = get_field( 'link_text' );
$page_lookup = get_field( 'page_lookup' ); 
$linkClass = '';
$linkURL = get_field( 'url' );
if ( have_rows( 'link_options' ) ) :
    while ( have_rows( 'link_options' ) ) : the_row(); 
        $padding_block = get_sub_field( 'padding_bottom' ); 

        if (isset($padding_block)) {
            $classes .= ' '.$padding_block;
        }
        if ( get_sub_field( 'use_url' ) == 1 ) {
            if (isset($linkURL)) {
                $link = $linkURL;
            }
            if(empty($linkTitle)){
                $linkTitle = 'Learn More';
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
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <a class="<?php echo esc_html($linkClass); ?>" <?php if($linkClass){ echo 'target="_blank"'; }?> href="<?php echo esc_url( $link); ?>">
        <?php echo esc_html( $linkTitle ); ?>
    </a>
</div>