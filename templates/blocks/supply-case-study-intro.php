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
$specialties = get_field( 'specialties' ); 
$extras = get_container_scheme();

$fold = get_fold();
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); echo $extras; ?>">
    <div class="fold" data-class="header"></div>
    <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 offset-xl-1 case-study-left cp2 mb-dlg-0">  
            
            <?php if ( $intro_blurb ) : ?> 
                <div class="intro-content">
                    <?php echo $intro_blurb; ?>
                </div>
            <?php endif; ?>

            <?php if ( $url_to_work ) : ?>  
                <a href="<?php echo $url_to_work; ?>" target="_blank" class="link-up">
                    <?php echo $url_to_work_title; ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col-dlg-3 offset-dlg-1 col-xl-2 case-study-right <?php echo $fold; ?>">
            <div class="row mx-sm-0 g-1 g-sm-0">
                <?php $i = 0; ?>
                <?php if ( $specialties ) :
                    $j = count(get_field( 'specialties' ) ); ?>
                <ul class="col-sm-4 specialties col-lg-12 mb-0">
                     <?php foreach ( $specialties as $term ) : ?>
                        <li><?php echo esc_html( $term->name ); ?></li>
                        <?php if ( ( $i + 1 ) == ceil($j / 2) ) echo '</ul><ul class="col-sm-4 mb-0 specialties col-lg-12">'; ?>
                    <?php $i++; endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12 col-xl-10 mx-auto"><div class="seperator"></div></div>
    </div>
</div>
