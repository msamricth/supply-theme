<?php
$location_checked_values = get_field( 'location' ); 
$position_status_checked_values = get_field( 'position_status' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( ' cp2' ); ?>>
    <div class="card border-0 rounded-0 position-relative">
        <div class="card-body p-0 cp2">
            <div class="d-md-flex align-items-end justify-content-between  cp1">
                <h5 class="card-title mb-0 fadeNoScroll">
                    <?php the_title(); ?>
                </h5>
                <span class="single-careers__label h8 d-inline-block fadeNoScroll">  
                    <?php if ( $location_checked_values ) : ?>
                        <?php foreach ( $location_checked_values as $location_value ): 
                                if ( $location_value === reset( $location_checked_values ) ) {
                            echo esc_html( $location_value ); 
                            }
                        endforeach; ?>
                    <?php endif; ?>
                    &nbsp;/&nbsp;
                    <?php if ( $position_status_checked_values ) : 
                        foreach ( $position_status_checked_values as $position_status_value ): 
                            if ( $position_status_value === reset( $position_status_checked_values ) ) {
                                echo esc_html( $position_status_value ); 
                            }
                        endforeach; ?>
                    <?php endif; ?>
                </span>
            </div>
            <div class="entry-summary cp2 fadeNoScroll">
                <?php the_excerpt(); ?>
            </div><!-- /.entry-summary -->
            <span class="fadeNoScroll">
                <a href="<?php the_permalink(); ?>" class="stretched-link link-in cp2">Learn More</a>
            </span>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->