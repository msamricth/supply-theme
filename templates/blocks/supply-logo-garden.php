<?php
/**
 * Block template file: templates/blocks/supply-logo-garden.php
 *
 * Supply Logo Garden Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-logo-garden-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-logo-garden';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$i = 0;
$classes .= ' fadeNoScroll';
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="background-color:<?php the_field( 'background_color' ); ?>;">

    <?php 
        if ( is_admin() ) {
        // Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
        echo '<div style="text-align: center">This is where on the front-end the logo garden will appear. <a>Click here,</a> to change the settings for this block.</div>';
    }  ?>

	<div class="container" <?php if ( is_admin() ) {?>style="display:none;"<?php } ?>>
        <div class="row justify-content-between gx-dlg-8 gy-dlg-4">
            <?php if ( have_rows( 'logos', 'option' ) ) : ?>
                <?php while ( have_rows( 'logos', 'option' ) ) : the_row();
                    $client_logo = get_sub_field( 'client_logo' ); 
                        if ( $client_logo ) : 
                            if($i <= 10) {?>
                                <div class="logo-container col-6 col-md-4 text-center">
                                    <img src="<?php echo esc_url( $client_logo['url'] ); ?>" class="" alt="<?php the_sub_field( 'client_name' ); ?>" />
                                </div>
                            <?php }
                            if($i === 11){ ?>
                                <div class="logo-container col-6 col-md-4 text-center">
                                    <img src="<?php echo esc_url( $client_logo['url'] ); ?>" class="cp3" alt="<?php the_sub_field( 'client_name' ); ?>" />
                                </div>
                            <?php }
                        endif; ?>
                <?php $i++; endwhile; ?>
            <?php else : ?>
            <?php endif; ?>
        </div>
    </div>
</div>