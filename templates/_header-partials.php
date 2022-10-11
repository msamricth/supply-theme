<?php
$advanceHeader = '';
$vimeo_video_mobile = '';
$vimeoVideo = '';
$image = '';
$video_ratio = '';
$classes ='header-container header-partial fadeNoScroll';
$header_text = '';
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
    $column_class = 'col-md-10 mx-auto col-dlg-12 col-xl-10';
endif;
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
    <header class="page-header fold" data-class="header">
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
        <div class="row g-0">
            
            <?php if ( $vimeoVideo ) : ?> 
                <?php echo video_containers($vimeoVideo, $vimeo_video_mobile, $video_ratio); 
                else:?>
                <?php if ( $image ) : ?>    
                    <img src="<?php echo esc_url( $image['url'] ); ?>" class="img-responsive" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                <?php endif; ?>
            <?php endif; ?>
    </div>
    <div class=" fold" data-class="header"></div>
</div>
<div class="container nav-catch fold" data-class="<?php echo $foldData; ?>">
    <div class="row">
        <div class="<?php echo $column_class; ?>">
        <div class="fold" data-class="<?php echo $foldData; ?>"></div>
<?php } else { ?>
<div class="container">
    <div class="row">
        <div class="<?php echo $column_class; ?>">
            <header class="page-header">
                <?php if($header_text){ ?>
                    <h1 class="page-title fadeNoScroll"><?php echo $header_text; ?></h1>
                <?php } else { ?>
                    <h1 class="page-title fadeNoScroll"><?php the_title(); ?></h1>
                <?php } ?>
            </header>
<?php
} ?>