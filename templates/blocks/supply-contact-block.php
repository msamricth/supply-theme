<?php
/**
 * Block template file: templates/blocks/supply-contact-block.php
 *
 * Supply contact Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $contact The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = '';
if($block){
    $id = 'supply-contact-block-' . $block['id'];
    if ( ! empty($block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = 'block-supply-contact-block';
    if ( ! empty( $block['className'] ) ) {
        $classes .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $classes .= ' align' . $block['align'];
    }
} else {
    $id = get_the_id();
}
$classes .=' fadeNoScroll';
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="footer-content supply-underline">
    <?php 
            if ( is_admin() ) {
            // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
            echo '<div style="text-align: left"><p style="margin-bottom:20px">You can edit these options in <a href="http://workwithsupply.local/wp-admin/admin.php?page=theme_options"><i>Supply Theme Options</i></a>, under the footer settings section.</p><hr style="margin-bottom:30px;"></div>';
        } 
        ?>
        <div class="">
            <span class="iso-reg footer-label d-block">
                <?php the_field( 'new_business_label', 'option' ); ?>
            </span>
            <p><?php the_field( 'point_of_contact', 'option' ); ?></p>
        </div>
        <div class="">
            <?php
            echo '<p class="fl">';
            echo '<a href="mailto:';
            the_field( 'poc_email', 'option' );
            echo '">';
            the_field( 'poc_email', 'option' );
            echo '<span class="nav-underline"></span></a></p><p class="fl">';
            echo '<a href="tel:';
            the_field( 'poc_number', 'option' ); 
            echo '">';
            the_field( 'poc_number', 'option' );
            echo '<span class="nav-underline"></span></a>';
            ?>
            </p>
        </div>
        <div class="pt-4 mt-2">
            <span class="iso-reg footer-label d-block">
                <?php the_field( 'headquarters_label', 'option' ); ?>
            </span>
            <?php the_field( 'headquarters_address', 'option' ); ?>
        </div>
    </div>
</div>

