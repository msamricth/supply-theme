<?php
// template partial for call to action contact section
$ctaTitle = get_field( 'cta_title' ); 
$cta_link = get_field( 'cta_link' ); 
$ctaCustumLinkText = get_field( 'cta_link_text' ); 
?>
<div class="container-fluid call-to-action-section fold" data-class="bg-light">
    <div class="row">
        <div class="col-md-10 mx-auto text-center py-8 py-md-10 py-lg-14">
            <?php if ( $ctaTitle ) : 
                echo '<h2 class="mb-2 mb-lg-5  fadeNoScroll">' . $ctaTitle . '</h2>';
             endif; ?>
        <?php if ( $cta_link ) : 
	    $post = $cta_link; 
	    setup_postdata( $post );  ?>
        <a href="<?php the_permalink(); ?>" class="fadeNoScroll">
        <?php if ( $ctaCustumLinkText ) : 
            echo $ctaCustumLinkText; 
            else:
            the_title(); endif; ?>
        </a>
        <?php wp_reset_postdata(); 
         endif; ?>
        </div>
    </div>
</div>