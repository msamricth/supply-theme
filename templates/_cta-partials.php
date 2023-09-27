<?php
// template partial for call to action contact section
$ctaTitle = get_field( 'cta_title' ); 
$cta_link = get_field( 'cta_link' ); 
$ctaCustumLinkText = get_field( 'cta_link_text' ); 
?>
<div class="container-fluid fadeNoScroll call-to-action-section">
    <div class="row">
        <div class="col-md-10 col-dlg-8 col-xl-6 col-xxl-5 col-3xl-4 mx-auto text-center">
            <?php if ( $ctaTitle ) : 
                echo '<h1 class="cp1">' . $ctaTitle . '</h1>';
             endif; ?>
        <?php if ( $cta_link ) : 
	    $post = $cta_link; 
	    setup_postdata( $post );  ?>
        <a href="<?php the_permalink(); ?>">
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