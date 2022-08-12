<?php
$location_checked_values = get_field( 'location' ); 
$position_status_checked_values = get_field( 'position_status' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( ' cp2' ); ?>>
    <div class="card border-0 rounded-0 position-relative fadeNoScroll">
        <div class="card-body p-0 cp2">
            <div class="d-md-flex align-items-end justify-content-between  cp1">
                <h5 class="card-title mb-0">
                    <?php the_title(); ?>
                </h5>
                <span class="single-careers__label h8 d-inline-block">  
                <?php the_field( 'location' ); ?>&nbsp;/&nbsp;<?php the_field( 'position_status' ); ?>
                </span>
            </div>
            <div class="entry-summary cp2">
                <?php the_excerpt(); ?>
            </div><!-- /.entry-summary -->
            <span class="">
                <a href="<?php the_permalink(); ?>" class="stretched-link link-in cp2">Learn More</a>
            </span>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->