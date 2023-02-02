<?php
/**
 * The Template for displaying all external pages.
 */

get_header();

// settings
$classes = 'entry container editor-content';
$classes .= ' case-study ';
// start
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();  
         
		get_template_part('templates/_page_header'); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <?php the_content(); ?>
        </div>
<?php 
    endwhile;
endif;

wp_reset_postdata();?>
<div>
<?php get_footer();
