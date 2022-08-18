<?php 
// tagline partial for home page

$tagline_title = get_field( 'tagline_header' ); 
$tagline_content = get_field( 'tagline_content' ); 
$tagline_link = get_field( 'tagline_link' ); 
$i = 0;
$cl_class = '';
?>
<div class="container tagline-section fadeNoScroll">
    <div class="row py-8 py-md-13 py-dlg-13 py-3xl-17">
        <div class="col-md-6 order-md-2 col-xl-5 col-xxl-4">
            <?php if ( $tagline_title ) : 
                echo '<h3 class="mb-4">' . $tagline_title . '</h3>';
             endif; ?>
             <div class="fold" data-class="bg-pattern"></div>
             <div class="row">
                <div class="col-dlg-11 col-3xl-10">
                    <?php if ( $tagline_content ) : 
                        echo '<p class="mb-4 pb-1 mb-lg-5 ">' . $tagline_content . '</p>';
                        endif; ?>
                    <?php if ( $tagline_link ) : ?>
                        <a href="<?php echo get_permalink( $tagline_link ); ?>">Learn More</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 order-md-1 col-xl-5 offset-xl-1">
        <?php if ( have_rows( 'logos', 'option' ) ) : ?>
            <div id="logoCarousel" class="carousel  carousel-fade pt-5 mt-1 pt-md-0 slide" data-bs-ride="carousel">
                <div class="carousel-inner">               
                    <?php while ( have_rows( 'logos', 'option' ) ) : the_row(); 
                    $active_class = '';
                    if ($i == 0) {
                        $active_class = ' active';
                    }
                    if ($i <= 11)   { 
                    ?>
                        <?php if($i%2 == 0) : ?><div class="carousel-item <?php echo $active_class ?>"><?php endif; ?>
                        <?php $client_logo = get_sub_field( 'client_logo' ); 
                        $client_logo_light = get_sub_field( 'client_logo_light' );
                        if ( $client_logo_light ) : 
                            $cl_class = "dark-logo";
                        endif; ?>
                            <?php if ( $client_logo ) : ?>
                                <div class="logo-container">
                                    <img src="<?php echo esc_url( $client_logo['url'] ); ?>" class="<?php echo $cl_class; ?>" alt="<?php the_sub_field( 'client_name' ); ?>" />
                                    <?php if ( $client_logo_light ) : ?>
                                        <img src="<?php echo esc_url( $client_logo_light['url'] ); ?>" class="light-logo" alt="<?php the_sub_field( 'client_name' ); ?>" />
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                         <?php if($i % 2 == 0){} else {?></div><?php } ?>
                            <?php
                    }else{} $i++; ?> 
                    <?php endwhile; ?>
                </div>
                <?php else : ?>
                    <?php // No rows found ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>