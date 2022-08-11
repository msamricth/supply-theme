<?php
/**
 * Template Name: Career
 * Description: Single-Career template with no sidebar.
 *
 */

get_header();

the_post();

$location_checked_values = get_field( 'location' ); 
$position_status_checked_values = get_field( 'position_status' );
?>
<div class="container">
    <div class="row">
        <div class="col-dlg-10 mx-auto col-xl-8">
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
                <h3 class="entry-title"><?php the_title(); ?></h3>
                <div class="cp1 cp2-md">          
                    <?php if ( $location_checked_values ) : ?>
                        <span class="single-careers__label h8 d-inline-block">  
                            <?php foreach ( $location_checked_values as $location_value ): 
                                echo esc_html( $location_value ); 
                                if ($location_value === end($location_checked_values)) { } else { echo " or ";}
                            endforeach; ?>
                        </span>
                    <?php endif; ?>
                    <span class="single-careers__label h8 d-inline-block"> / </span>
                    <?php if ( $position_status_checked_values ) : ?>
                        <span class="single-careers__label h8 d-inline-block">
                        <?php foreach ( $position_status_checked_values as $position_status_value ): 
                            echo esc_html( $position_status_value ); 
                            if ($position_status_value === end($position_status_checked_values)) { } else { echo " x ";}
                        endforeach; ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="entry-content cp2">
                    <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
                            'after'  => '</div>',
                        ) );
                        edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
                    ?>
                </div>
            </div><!-- /#post-<?php the_ID(); ?> -->

            
            <?php if ( have_rows( 'add_a_career_section' ) ) : ?>
                <div class="single-careers__sections cp3">
                    <div class="spacer cp2"></div>
                    <?php while ( have_rows( 'add_a_career_section' ) ) : the_row(); ?>
                        <div class="single-careers__sections__section">
                            <h4 class="cp1"><?php the_sub_field( 'title' ); ?></h4>
                            <div class="section-content cp2">
                                <?php the_sub_field( 'content' ); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <?php // No rows found ?>
            <?php endif; ?>
            <div class="single-careers__application row cp3">
                <div class="col-dlg-10 col-xl-8">
                    <h1 class="cp3">Apply now. </h1>
                    <?php echo do_shortcode('[contact-form-7 id="129" title="Apply form"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$job_title = get_the_title();
$script = <<<EOT
<script defer>
document.getElementById('currentURL').value = window.location.href;
document.getElementById('currentJob').value = '$job_title';
</script>
EOT;

enqueue_footer_markup($script);
get_footer();