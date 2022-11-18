<?php
/**
 * Block template file: templates/blocks/supply-case-study-into.php
 *
 * Case Study Intro Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'case-study-intro-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-case-study-intro';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$client_logo_light = get_field( 'client_logo_light' );
$client_logo_dark = get_field( 'client_logo_dark' );

$url_to_work = get_field( 'url_to_work' );
$post_id = get_the_ID() ? get_the_ID() : $_POST['post_id'];

$url_to_work_title = get_field( 'url_to_work_title' );
if( empty( $url_to_work_title  ) )
	$url_to_work_title = get_the_title( $post_id );

$title_of_work_performed = get_field( 'title_of_work_performed' );
$intro_blurb = get_field( 'intro' );
if ( $url_to_work ) : 
endif;
$classes .= ' fadeNoScroll';

$foldUtils = '';

$scheme = get_field('background_color', $post_id);
$classes.= ' fold';
if ( get_field( 'add_fold' ) == 1 ) : 
    if ( have_rows( 'fold_settings' ) ) :
        while ( have_rows( 'fold_settings' ) ) : the_row(); 
            if(get_sub_field( 'custom_bg_color' )){
                    $customColor = get_sub_field( 'custom_bg_color' );
                    $customText = get_sub_field('custom_text_color');
                    if($customText) {
                        $customText = 'data-color="'.$customText.'"';
                    } else {
                        $customText = 'data-color="default"';
                    }
                    $classes .= ' fold-custom';
                    $foldUtils .=' data-bg="'.$customColor.'" '. $customText;
            }
            if(get_sub_field( 'color' )){
                    $foldClass = 'bg-' . get_sub_field( 'color' );
                    $foldUtils .=' data-class="'. $foldClass .'"';
            }
            
        endwhile;
	endif; 
else:
    
if($scheme){
    $foldUtils .=' data-class="bg-'. $scheme .'"';
} else {
    $foldUtils .=' data-class="bg-light"';
}
endif; 
$specialties = get_field( 'specialties' ); 
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>"<?php echo $foldUtils; ?>>
    <div class="row">
        <div class="col-md-10 col-xl-10 offset-xl-1 logo-container fadeNoScroll">
            <?php if ( $client_logo_light ) : ?>
                <img class="img-responsive client-logo light-logo" src="<?php echo esc_url( $client_logo_light['url'] ); ?>" alt="<?php echo esc_attr( $client_logo_light['alt'] ); ?>" />
            <?php endif; ?>
            <?php if ( $client_logo_dark ) : ?>
                <img class="img-responsive client-logo dark-logo" src="<?php echo esc_url( $client_logo_dark['url'] ); ?>" alt="<?php echo esc_attr( $client_logo_dark['alt'] ); ?>" />
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 offset-xl-1 case-study-left">  
            
            <?php if ( $title_of_work_performed ) : ?>
                <h5 class="entry-title fadeNoScroll"><?php echo $title_of_work_performed; ?></h5>
            <?php else :?>
                <h5 class="entry-title fadeNoScroll"><?php echo  get_the_title( $post_id ); ?></h5>
            <?php endif; ?>       
            <?php if ( $intro_blurb ) : ?> 
                <div class="intro-content">
                    <?php echo $intro_blurb; ?>
                </div>
            <?php endif; ?>

            <?php if ( $url_to_work ) : ?>  
                <p>
                    <a href="<?php echo $url_to_work; ?>" target="_blank" class="link-up">
                        <?php echo $url_to_work_title; ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col-dlg-3 offset-dlg-1 col-xl-2 case-study-right">
            <div class="row mx-sm-0 g-1 g-sm-0">
                <?php $i = 0; $j = count(get_field( 'specialties' ) );?>
                <?php if ( $specialties ) : ?>
                <ul class="col-sm-4 specialties col-lg-12 mb-0">
                     <?php foreach ( $specialties as $term ) : ?>
                        <li><?php echo esc_html( $term->name ); ?></li>
                        <?php if ( ( $i + 1 ) == ceil($j / 2) ) echo '</ul><ul class="col-sm-4 mb-0 specialties col-lg-12">'; ?>
                    <?php $i++; endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="fold" <?php echo $foldUtils; ?>></div>