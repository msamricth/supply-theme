<?php 
// tagline partial for home page

$tagline_title = get_field( 'tagline_header' ); 
$tagline_content = get_field( 'tagline_content' ); 
$tagline_link = get_field( 'tagline_link' ); 
$i = 0;
?>
<div class="container tagline-section py-7 py-md-10 py-lg-14">
    <div class="row">
        <div class="col-md-6 order-md-2">
            <?php if ( $tagline_title ) : 
                echo '<h3 class="mb-4 mb-lg-5  fadeNoScroll">' . $tagline_title . '</h3>';
             endif; ?>
            <?php if ( $tagline_content ) : 
                echo '<p class="mb-4 mb-lg-5 fadeNoScroll">' . $tagline_content . '</p>';
                 endif; ?>
            <?php if ( $tagline_link ) : ?>
                <a class="fadeNoScroll" href="<?php echo get_permalink( $tagline_link ); ?>">Learn More</a>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6 order-md-1">
        <?php if ( have_rows( 'logos', 'option' ) ) : ?>
            <div id="logoCarousel" class="carousel  slide" data-bs-ride="carousel">
                <div class="carousel-inner">               
                    <?php while ( have_rows( 'logos', 'option' ) ) : the_row(); 
                    $active_class = '';
                    if ($i == 0) {
                        $active_class = ' active';
                    }
                    ?>
                    
                         <?php if($i%2 == 0) : ?><div class="carousel-item <?php echo $active_class ?>"><?php endif; ?>
                        <?php $client_logo = get_sub_field( 'client_logo' ); ?>
                            <?php if ( $client_logo ) : ?>
                                <img src="<?php echo esc_url( $client_logo['url'] ); ?>" alt="<?php echo esc_attr( $client_logo['alt'] ); ?>" />
                            <?php endif; ?>
                            
                         <?php if($i % 2 == 0){} else {?></div><?php } ?>
                            <?php $i++; ?> 
                    <?php endwhile; ?>
                </div>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>