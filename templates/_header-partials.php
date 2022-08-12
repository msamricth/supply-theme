<?php
$advanceHeader = '';
$vimeo_video_mobile = '';
$vimeoVideo = '';
$image = '';
$video_ratio = '';
$width_in_columns = ''; 
$offset_in_columns = ''; 
$breakpoint_aspect = ''; 
$BA_width_in_columns = ''; 
$BA_offset_in_columns = ''; 
$BA_hide_media = ''; 
$row_class = "";
$sub_classes = '';
$classes ='header-container header-partial fadeNoScroll cp3';
$header_text = '';
if ( have_rows( 'header' ) ) : 
	while ( have_rows( 'header' ) ) : the_row(); 
        $header_text = get_sub_field( 'header_text' ); 
        if ( get_sub_field( 'under_nav' ) == 1 ) : 
            $classes .= ' under-nav';
        else : 
        endif; 
        $vimeoVideo = get_sub_field('vimeo_video');
        $image = get_sub_field( 'image' );
        $video_ratio = get_sub_field('video_ratio');
        $vimeo_video_mobile = get_sub_field('vimeo_video_mobile');
        if ( have_rows( 'desktop_settings' ) ) : 
            while ( have_rows( 'desktop_settings' ) ) : the_row(); 
                $width_in_columns = get_sub_field( 'width_in_columns' ); 
                $offset_in_columns = get_sub_field( 'offset_in_columns' ); 
                if($width_in_columns) {
                    
                    if(strpos($width_in_columns, 'container') !== false){
                    
                    } else {
                        $sub_classes .= ' col-dlg-' . $width_in_columns;
                        if($offset_in_columns) {
                            if(strpos($offset_in_columns, 'Center') !== false){
                                $sub_classes .= ' mx-dlg-auto';
                            } else {
                                $sub_classes .= ' offset-dlg-' . $BA_offset_in_columns;
                            }
                        }
                    }
                } else {
                    $sub_classes .= ' col-dlg-12';
                }
                if ( get_sub_field( 'display_guttercontainer_offset' ) == 1 ) : 
                    $row_class .= 'container-dlg mx-auto';
                else : 
                    // echo 'false'; 
                endif; 
            endwhile; 
        endif; 
        if ( have_rows( 'breakpoints_optional' ) ) : 
            while ( have_rows( 'breakpoints_optional' ) ) : the_row(); 
                $breakpoint_aspect = get_sub_field( 'breakpoint_aspect' ); 
                $BA_width_in_columns = get_sub_field( 'width_in_columns' ); 
                $BA_offset_in_columns = get_sub_field( 'offset_in_columns' ); 
                $BA_hide_media = get_sub_field( 'hide_media' ); 
                $sub_classes .= ' col-' . $breakpoint_aspect . '-' . $BA_width_in_columns;
                
                if($BA_offset_in_columns) {
                    if(strpos($BA_offset_in_columns, 'Center') !== false){
                        $sub_classes .= ' mx-'. $breakpoint_aspect . '-auto';
                    } else {
                        $sub_classes .= ' offset-'. $breakpoint_aspect . $BA_offset_in_columns;
                    }
                }
                if ( get_sub_field( 'display_guttercontainer_offset' ) == 1 ) : 
                    if(strpos($breakpoint_aspect, 'xs') !== false){
                        $row_class .=  ' container';
                    } else {
                        $row_class .=  ' container-'. $breakpoint_aspect . '  mx-auto';
                    }
                else: 
                endif; 
            endwhile; 
        else: 
            // No rows found 
        endif; 
	endwhile; 
endif; 
if($image){
    $advanceHeader = true;
}
if($vimeoVideo){
    $advanceHeader = true;
}
if($advanceHeader) {
?>
<div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <header class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-dlg-10 mx-auto col-xl-8">
                    <?php if($header_text){ ?>
                        <h1 class="page-title fadeNoScroll"><?php echo $header_text; ?></h1>
                    <?php } else { ?>
                        <h1 class="page-title fadeNoScroll"><?php the_title(); ?></h1>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <div class="<?php echo $row_class; ?>">
        <div class="row g-0">
            <div class="<?php echo $sub_classes; ?>">
                <?php if ( $image ) : ?>    
                    <img src="<?php echo esc_url( $image['url'] ); ?>" class="img-responsive" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                <?php endif; ?>
                <?php if ( $vimeoVideo ) : ?> 
                    <?php echo video_containers($vimeoVideo, $vimeo_video_mobile, $video_ratio); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="container nav-catch">
<?php } else { ?>
<div class="container nav-catch">
    <header class="page-header">
        <?php if($header_text){ ?>
            <h1 class="page-title fadeNoScroll cp3"><?php echo $header_text; ?></h1>
        <?php } else { ?>
            <h1 class="page-title fadeNoScroll cp3"><?php the_title(); ?></h1>
        <?php } ?>
    </header>
<?php
} ?>