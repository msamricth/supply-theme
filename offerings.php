<?php
/**
 * Template Name: Service Offerings
 * Description: Service Offerings Page template.
 *
 */
/**
 * The Template for displaying single service offerings.
 */

get_header();

// settings
$classes = 'entry  editor-content';
$classes .= ' service-offering';

$scheme = get_scheme();
// start
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();  
        //sub nav start
        get_template_part('templates/_page_header', null, array('header_type' => 'offerings')); 
        //sub nav end
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div id="streamload">
                <div class="top-half <?php echo $scheme;?> fold" data-color="bg-header">
                    <?php echo get_background_lines(); ?>
                    <div class="container">
                        <div class="row">
                            <div class="d-none d-dlg-block col-dlg-3"></div>
                            <div class="col-12 col-dlg-9 col-xl-8 the-content">
                                <?php echo get_mobile_subnav(); ?>
                                <?php the_content(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-half bottom-half--pagination bg-dark-gray text-white fold" data-class="bg-offerings">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1 col-xl-8 offset-xl-2">
                                <?php get_template_part('templates/blocks/_service-offerings-pagination');?>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
<?php 
    endwhile;
endif;

wp_reset_postdata();?>

<?php get_footer();
