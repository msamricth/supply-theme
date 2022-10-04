<?php
/**
 * Template Name: Page Home
 * Description: Home Page template.
 *
 */

get_header();

the_post();
$scheme = '';
$scheme = get_field('background_color');
$textScheme ='';
$headline = get_field('headline');
if($scheme){
    if (strpos($scheme, 'ark') !== false) {
 
    }
    $scheme = 'bg-'. $scheme . ' ' . $textScheme;
} 


?>
<main class="fold-container  <?php echo $scheme ?>">
    <div class="home-header header-container">
        <div class="container text-left">
            <div class="row fold" data-class="bg-dark">
                <div class="col-lg-10 col-xl-8 col-3xl-6 col-4xl-5 mx-md-auto">
                    <?php if($headline) {
                        echo '<h1 class="entry-title fadeNoScroll '. $textScheme.'">'.$headline.'</h1>';
                    } else {
                        echo '<h1 class="entry-title fadeNoScroll '. $textScheme.'">' .the_title() .'</h1>';
                    }?>
                </div>
            </div>
            <div class="fold" data-class="bg-dark">
                <?php echo Video_embed(); ?>
            </div>
        </div>

    </div>

    <div id="post-<?php the_ID(); ?>" <?php post_class('home-main' ); ?>>
        <div class="fold" data-class="bg-light">
            <?php the_content();
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
                'after'  => '</div>',
            ) );
            edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
            
        ?>
        </div>
        
    </div><!-- /#post-<?php the_ID(); ?> -->
    <div>
    <?php

get_footer();
