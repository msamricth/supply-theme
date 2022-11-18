<?php
$advanceHeader = '';
$vimeo_video_mobile = '';
$vimeoVideo = '';
$image = '';
$image_mobile = '';
$video_ratio = '';
$classes ='header-container header-partial fadeNoScroll';
$header_text = '';
$no_headerText = '';
$column_class = '';
$foldData = '';
if ( get_field( 'dots_on' ) == 1 ) : 
    $foldData = 'bg-pattern';
else:
    $foldData = 'bg-light';
endif;

if ( get_field( 'full_width_page' ) == 1 ) : 
    $column_class = 'col-md-12 mx-auto';
else : 
    $column_class = 'col-md-12 mx-auto col-dlg-12 col-xl-10';
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
if ( have_rows( 'header' ) ) : 
	while ( have_rows( 'header' ) ) : the_row(); 
        $vimeoVideo = get_sub_field('vimeo_video');
        $image = get_sub_field( 'image' );
        $image_mobile = get_sub_field( 'image_mobile' );
        $video_ratio = get_sub_field('video_ratio');
        $vimeo_video_mobile = get_sub_field('vimeo_video_mobile');
        
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
    <header class="page-header page-header fold" data-class="header">
        <div class="container">
            <div class="row">
                <div class="col-dlg-10 mx-auto col-xl-8">
                    <?php if (empty($no_headerText)) {
                        if($header_text){ ?>
                            <h1 class="page-title fadeNoScroll"><?php echo $header_text; ?></h1>
                        <?php } else { ?>
                            <h1 class="page-title fadeNoScroll"><?php the_title(); ?></h1>
                        <?php } 
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <?php if ( $vimeoVideo ) : ?> 
        <?php echo video_containers($vimeoVideo, $vimeo_video_mobile, $video_ratio); 
        else:?>
        <?php if ( $image ) : 
            echo image_containers($image, $image_mobile);
        endif; ?>
    <?php endif; ?>
    <div class=" fold" data-class="header"></div>
</div>
<div class="container fold" data-class="<?php echo $foldData; ?>">
    <div class="row">
        <div class="<?php echo $column_class; ?>">
<?php } else { ?>
<div class="container">
    <div class="row">
        <div class="<?php echo $column_class; ?>">
            <?php if (empty($no_headerText)) {?>
            <header class="page-header">
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
} ?>