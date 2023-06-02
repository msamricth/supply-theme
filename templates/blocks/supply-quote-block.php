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
$blockContent = '';
$blockContent .= '<p>'.get_field( 'quote' ).'&rdquo;</p>';
if($cite) {
    $blockContent .= '<cite><strong>'.get_field( 'cite' ).'</strong>';
    if($extra_cite_details){ 
        $blockContent .= '<span>'.$extra_cite_details.'</span>';
    } 
    $blockContent .= '</cite>';
} ?>
<blockquote id="<?php echo esc_attr( $id )?>" class="<?php echo esc_attr( $classes )?>">
    <?php if ( is_single() && 'post' == get_post_type() ) {?>
        <div class="col-md-12 col-xl-10 mx-auto">
            <div class="seperator"></div>
        </div>
        <div class="quote">
            <?php if ( have_rows( 'column_placement' ) ) :
                while ( have_rows( 'column_placement' ) ) : the_row(); 
                    echo supply_grid($blockContent, 'col-dlg-12');
                endwhile;
            else:
                echo supply_grid_sh($blockContent, 'col-dlg-12');
            endif; ?>
        </div>
        <div class="col-md-12 col-xl-10 mx-auto">
            <div class="seperator"></div>
        </div>
    <?php } else {
        if ( have_rows( 'column_placement' ) ) :
            while ( have_rows( 'column_placement' ) ) : the_row(); 
                echo supply_grid($blockContent, 'col-dlg-10 mx-auto col-xl-8');
            endwhile;
        else:
            echo supply_grid_sh($blockContent, 'col-dlg-10 mx-auto col-xl-8');
        endif; 
        ?>
        <div class="col-md-12 col-xl-10 mx-auto">
            <div class="seperator"></div>
        </div>
    <?php }?>
</blockquote>