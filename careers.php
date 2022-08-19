<?php
/**
 * Template Name: Page Careers
 * Description: Careers Page template.
 *
 */

get_header();

the_post();
        get_template_part('templates/_header', 'partials');

            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
                'after'  => '</div>',
            ) );
            edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
        ?>
        <?php
        $args = array(
            'post_type' => array('careers'),
            'posts_per_page' => 10
        );
        $the_query = new WP_Query( $args ); ?>

        <?php if ( $the_query->have_posts() ) : ?>
            <div class="cp4">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $post_type = get_post_type();
                    get_template_part('templates/_content', $post_type);
                endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();