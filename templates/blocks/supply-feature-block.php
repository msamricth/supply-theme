<?php
/**
 * Block template file: templates/blocks/supply-feature-block.php
 *
 * Supply Feature Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'supply-feature-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-feature-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$tagline_title = get_field( 'tagline_header' ); 
$tagline_content = get_field( 'tagline_content' ); 
$tagline_link = get_field( 'tagline_link' ); 
$custom_link_label = get_field('custom_link_label');
$i = 0;
$cl_class = '';
$foldUtils = '';
$foldClass = '';
$row = '';
$container = '';
$carouselClasses = '';

if ( have_rows( 'fold_settings' ) ) :
    while ( have_rows( 'fold_settings' ) ) : the_row(); 
        if(get_sub_field( 'custom_bg_color' )){
                $customColor = get_sub_field( 'custom_bg_color' );
                $customText = get_sub_field('custom_text_color');
                if($customText) {
                    $customText = 'data-color="'.$customText.'"';
                } else {
                    $customText = 'data-color="default"';
                }
                $foldClass .= ' fold-custom';
                $foldUtils .=' data-bg="'.$customColor.'" '. $customText;
        }
        if(get_sub_field( 'fold_color' )){
                $carouselClasses = 'fold';
                $foldClass = 'bg-' . get_sub_field( 'fold_color' );
                $foldUtils .=' data-class="'. $foldClass .'"';
        }
        
    endwhile;
endif; 


if ( have_rows( 'logos', 'option' ) ) : 
    $logoCount = 0;
    $logoListA = '';
    $logoListB = '';
    $logoCarousel ='';
    while ( have_rows( 'logos', 'option' ) ) : the_row(); 
        $client_logo = get_sub_field( 'client_logo' ); 
        $client_logo_light = get_sub_field( 'client_logo_light' );
        if ( $client_logo_light ) : 
            $cl_class = "dark-logo";
        endif; 
        if ( $client_logo ) : 
            if($logoCount % 2 == 0){
                $logoListB .= '<li class="logo-container">';
                $logoListB .= '<img src="'. esc_url( $client_logo['url'] ).'" class="'.$cl_class.'" alt="'. get_sub_field( 'client_name' ).'" />';
                if ( $client_logo_light ) : 
                    $logoListB .= '<img src="'. esc_url( $client_logo_light['url'] ).'" class="light-logo" alt="'. get_sub_field( 'client_name' ).'" />';
                endif;
                $logoListB .= '</li>';
            } else {
                $logoListA .= '<li class="logo-container">';
                $logoListA .= '<img src="'. esc_url( $client_logo['url'] ).'" class="'.$cl_class.'" alt="'. get_sub_field( 'client_name' ).'" />';
                if ( $client_logo_light ) : 
                    $logoListA .= '<img src="'. esc_url( $client_logo_light['url'] ).'" class="light-logo" alt="'. get_sub_field( 'client_name' ).'" />';
                endif;
                $logoListA .= '</li>';
            }
            $logoCarousel = '<ul class="swap">'.$logoListA .'</ul>';
            $logoCarousel .= '<ul class="swap1">'.$logoListB .'</ul>';
        endif; 
        $logoCount++;
    endwhile;
else : 
    // No rows found  
endif; ?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="container tagline-section fadeNoScroll">
        <div class="row py-8 py-md-13 py-dlg-13 py-3xl-17">
            <div class="col-md-6 order-md-2 col-xl-5 col-xxl-4">
                <?php if ( $tagline_title ) : 
                    echo '<h3>' . $tagline_title . '</h3>';
                endif; ?>
                <div class="row">
                    <div class="col-dlg-11 col-3xl-10 col-md-10">
                        <?php if ( $tagline_content ) : 
                            echo '<p class="cp1">' . $tagline_content . '</p>';
                            endif; ?>
                        <?php if ( $tagline_link ) : ?>
                            <a href="<?php echo get_permalink( $tagline_link ); ?>"><?php if($custom_link_label){ echo $custom_link_label; } else { echo 'Learn More';} ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 order-md-1 col-xl-5 offset-xl-1 logo-carousel  <?php echo $carouselClasses; ?>" <?php if ( is_admin() ) {?> style="display:none"<?php }?>  <?php echo $foldUtils; ?>>
            <?php if ( have_rows( 'logos', 'option' ) ) : ?>
                <section class="box" aria-label="Supply's Logo Carousel fader">
                   <?php echo $logoCarousel;?>
                </section>
            <?php else : ?>
                <?php // No rows found ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

