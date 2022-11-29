<?php
/**
 * Template Name: Page Home
 * Description: Home Page template.
 *
 */

get_header();

the_post();

$headline = get_field('headline');


?>
<main>
    <div class="home-header">
        <div class="container text-left">
            <div class="row fold" data-class="header">
                <div class="col-lg-10 col-xl-8 col-3xl-6 col-4xl-5 mx-md-auto">
                    <?php if($headline) {
                        echo '<h1 class="entry-title fadeNoScroll">'.$headline.'</h1>';
                    } else {
                        echo '<h1 class="entry-title fadeNoScroll">' .the_title() .'</h1>';
                    }?>
                </div>
            </div>
            <div class=" fold" data-class="header">
                <?php echo Video_embed(); ?>
            </div>
        </div>
    </div>
    <div id="post-<?php the_ID(); ?>" <?php post_class('home-main' ); ?>>

            <?php the_content();?>

        </div>            
           <?php wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
                'after'  => '</div>',
            ) );
            edit_post_link( __( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
            
        ?>
        
    </div><!-- /#post-<?php the_ID(); ?> -->
    <div>

    <?php
    
$script = <<<EOT
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js">
</script>
EOT;


enqueue_footer_markup($script);
    
get_footer();
