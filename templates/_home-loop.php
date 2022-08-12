<?php
//Home Page Loop posts section

$post_IDs = '';
$args = '';

if ( have_rows( 'define_your_own_loop' ) ) : 
    while ( have_rows( 'define_your_own_loop' ) ) : the_row(); 
        $post = get_sub_field( 'post' ); 
        if ( $post ) : 
            $post_IDs .= $post . ', ';
        endif; 
    endwhile; 
else : 
    // No rows found 
endif; ?>


<?php if ( get_field( 'use_default_loop' ) == 1 ) : 
    $args = array(
        'post_type' => array('post', 'external-link', 'case-studies'),
        'posts_per_page' => 4,
        'post__in' => [$post_IDs]
    );
else :
    $args = array(
        'post_type' => array('post', 'external-link', 'case-studies'),
        'posts_per_page' => 4
    );   
endif; ?>
<?php
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
    <div class="container home-loop-section fold fadeNoScroll" data-class="bg-pattern">
        <div class="row">
            <div class="col-dlg-10 offset-dlg-1">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $post_type = get_post_type();
                    get_template_part('templates/_content', $post_type);
                endwhile; ?>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>