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
        $textScheme = "text-white";
    }
    $scheme = 'bg-'. $scheme . ' ' . $textScheme;
} 


?>

<main class="">
    <div class="home-header pt-6 pt-dlg-7 pt-xl-9 <?php echo $scheme ?>">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-8 mx-md-auto">
                    <?php if($headline) {
                        echo '<h1 class="entry-title mb-6  mb-dlg-9  mb--xl-13 fadeNoScroll '. $textScheme.'">'.$headline.'</h1>';
                    } else {
                        echo '<h1 class="entry-title mb-6 mb-dlg-9 mb--xl-13 fadeNoScroll '. $textScheme.'">' .the_title() .'</h1>';
                    }?>
                </div>
            </div>
            <?php echo Video_embed(); ?>
        </div>

    </div>

    <div id="post-<?php the_ID(); ?>" <?php post_class('home-main' ); ?>>
      <?php get_template_part('templates/_tagline', 'partials');
      
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
                'after'  => '</div>',
            ) );
            edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
            
             get_template_part('templates/_cta', 'partials');
        ?>
        
    </div><!-- /#post-<?php the_ID(); ?> -->
    <?php

get_footer();
