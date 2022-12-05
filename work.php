<?php
/**
 * Template Name: Page work
 * Description: work Page template.
 *
 */

get_header();

the_post();
?>
<div class="spacer cp2 cp5  fold" data-class="header">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
                    'after'  => '</div>',
                ) );
                edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );

            $post_IDs = '';
            $args = '';
            if ( have_rows( 'add_case_studies' ) ) : 
                while ( have_rows( 'add_case_studies' ) ) : the_row(); 
                    $case_study = get_sub_field( 'case_study' ); 
                    if ( $case_study ) : 
                        $post_IDs .= $post . ', ';
                    endif; 
                endwhile; 
            else : 
                // No rows found 
            endif;
            if ( get_field( 'use_default_loop' ) == 1 ) : 
                $args = array(
                    'post_type' => array('case-studies'),
                    'posts_per_page' =>8,
                    'post__in' => [$post_IDs]
                );
            else :
                $args = array(
                    'post_type' => array('case-studies'),
                    'posts_per_page' => 8
                );   
            endif; ?>
            <?php
            $the_query = new WP_Query( $args ); ?>
            </div>
        </div>
        <div class="posts-loop cp4">
            <div class="row nav-catch">
                <?php if ( $the_query->have_posts() ) : 
                    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="col-md-6 cp2">
                            <?php 
                                $post_type = get_post_type();
                                get_template_part('templates/_content', $post_type);?>
                        </div>
                    <?php endwhile; 
                wp_reset_postdata(); ?>
            <?php endif;?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?php get_template_part('templates/_cta', 'partials'); ?>
        </div>
    </div>
</div>
<?php get_footer();