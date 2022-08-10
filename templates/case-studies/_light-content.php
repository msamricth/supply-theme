<?php
// Create id attribute allowing for custom "anchor" value.
$quote = get_field( 'quote' ); 
$quoteClasses = 'wp-block-quote ';
$cite = get_field( 'cite' ); 
if(get_field( 'positioning' )){
    $quoteClasses .= get_field( 'positioning' );
} 
$extra_cite_details = get_field( 'extra_cite_details' ); ?>
<div class="single-case-studies__light-content container fold nav-catch" data-class="bg-light">
    <?php if($quote){ ?>
        <blockquote class="<?php echo esc_attr( $quoteClasses ); ?>">
            <div class="row">
                <div class="col-lg-10 mx-auto">
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
                </div>
            </div>
        </blockquote>
    <?php } ?>

    <?php if ( have_rows( 'product_image' ) ) : ?>
        <div class="row">
            <?php while ( have_rows( 'product_image' ) ) : the_row(); ?>
                <div class="col">
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                        <img class="fadeNoScroll img-responsive" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <?php // No rows found ?>
    <?php endif; ?>
    <div class="block-supply-content-block fadeNoScroll row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <?php if(get_field('ending_blurb_title')) {?>
                <h3 class="entry-title fadeNoScroll"><?php the_field( 'ending_blurb_title' ); ?></h3>
            <?php } ?>
            <?php if(get_field('ending_blurb')) {?>
                <div class="outro-content fadeNoScroll">
                    <?php the_field( 'ending_blurb' ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>