<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
 *
 */

get_header();

the_post();
$header_text = '';
$no_headerText = '';
$column_class = '';


if ( get_field( 'full_width_page' ) == 1 ) : 
    $column_class = 'col-md-12 mx-auto';
else : 
    $column_class = 'col-md-10 mx-auto col-dlg-12 col-xl-10';
endif;

        $header_text = get_field( 'header_text' ); 
        if ( get_field( 'under_nav' ) == 1 ) : 
            $classes .= ' under-nav';
        else : 
        endif; 
        if ( get_field( 'disable_header_text') == 1 ) : 
            $no_headerText .= 'true';
        else : 
        endif; 

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>
	<div class="container">
		<div class="row">
			<div class="<?php echo $column_class; ?>">
					
				<div class="row">
					<?php if (empty($no_headerText)) {?>
						<header class="page-header d-dlg-none fadeNoScroll fold" data-class="header">
							<?php 
								if($header_text){ ?>
									<h1 class="page-title fadeNoScroll"><?php echo $header_text; ?></h1>
								<?php } else { ?>
									<h1 class="page-title fadeNoScroll"><?php the_title(); ?></h1>
								<?php } 
							?>
						</header>
					<?php } ?>
					<div class="col-lg-8 col-xl-7 col-3xl-6 fadeNoScroll order-2 order-dlg-1">
					<?php if (empty($no_headerText)) {?>
						<header class="page-header d-dlg-block d-none fadeNoScroll fold" data-class="header">
							<?php 
								if($header_text){ ?>
									<h1 class="page-title fadeNoScroll"><?php echo $header_text; ?></h1>
								<?php } else { ?>
									<h1 class="page-title fadeNoScroll"><?php the_title(); ?></h1>
								<?php } 
							?>
						</header>
					<?php } ?>
						
						<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'supply' ),
									'after'  => '</div>',
								)
							);
							edit_post_link( esc_html__( 'Edit', 'supply' ), '<span class="edit-link">', '</span>' );
						?>
					</div>
					
					<?php get_sidebar( 'primary' ); ?>
				</div>
			</div><!-- /#post-<?php the_ID(); ?> -->
		</div>
	</div>
</div>
<?php
get_footer();
