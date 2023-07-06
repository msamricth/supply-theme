<?php


/**
 * Block template file: templates/blocks/supply-carousel-block.php
 *
 * Supply Carousel Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$post_id = '';
$current_post = get_queried_object();
$post_id = $current_post ? $current_post->ID : null;	
$scheme = get_field('background_color', $post_id);
// Create id attribute allowing for custom "anchor" value.
$id = 'supply-carousel-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
if ( is_admin() ) {
	// Runs only if this PHP code is in a file that displays outside the admin panels, like the theme template.
	echo '<style>ul.splide__list {display: flex; align-items: end;}[data-custom_height] .splide__slide img {height: 100%;}</style><button style="position: absolute;right: 10%;padding: 2rem;top: 20%;">Click here to edit this Carousel Block </button>';
} 

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-supply-carousel-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$classes .=' splide';
$blockContent = '';
$options_position = '';
$options_interval = '';
$options_captions = '';
$options_autoplay = '';
$options_gap = '';
$slides = '';
$videoRatio = '';
$caption='';
$video = '';
$foldUtils = '';
$captiontitle = '';
if ( have_rows( 'options' ) ) :
	while ( have_rows( 'options' ) ) : the_row(); 
		if ( get_sub_field( 'captions' ) == 1 ) : 
			$options_captions = 'on';
		endif; 
	endwhile;
endif;
if ( have_rows( 'slides' ) ): 
	while ( have_rows( 'slides' ) ) : the_row(); 
	$slides .='<li class="splide__slide">';		
	if ( get_row_layout() == 'image' ) {
			$image = get_sub_field( 'image' ); 
			if ( $image ) : 
				$slides .='<img src="'.esc_url( $image['url'] ).'" alt="'.esc_attr( $image['alt'] ).'"';
			//	$slides .=' width="'.esc_attr( $image['width'] ).'" height="'.esc_attr( $image['height'] ).'"';
				$slides .=' />';
			endif; 
			
		} elseif ( get_row_layout() == 'vimeo' ) {

			$videoRatio = get_sub_field( 'video_ratio' ); 
			$video = get_sub_field( 'video' ); 
			
			if($videoRatio){enqueue_header_markup(customRatio($videoRatio));}
			$slides .= video_containers($video, '', $videoRatio, $videoRatio);
		} elseif ( get_row_layout() == 'video' ) {
			$videoRatio = get_sub_field( 'video_ratio' ); 
			if($videoRatio){enqueue_header_markup(customRatio($videoRatio));}
			$video = get_sub_field( 'video' ); 
			$video_placeholder = get_sub_field( 'video_placeholder' ); 
			$slides .= video_containers($video, '', $videoRatio, $videoRatio, $video_placeholder);
		}
		if($options_captions){
			if ( have_rows( 'captions' ) ) : 
				while ( have_rows( 'captions' ) ) : the_row(); 
					$captiontitle = get_sub_field( 'title' ); 
					$type = get_sub_field( 'type' ); 
					if($options_captions){
						$slides .= '<div class="splide__slide__caption">';
						
						if(empty($type)) {
							$type = 'h8';
						}
						$slides .= '<span class="'.$type.'">'.$captiontitle.'</span> ';
						
						$slides .=  '</div>';
					}
				endwhile; 
			endif; 
		}
		$slides .= '</li>';
	endwhile; 
else: 
	// No layouts found 
endif; 


if ( have_rows( 'options' ) ) :
	while ( have_rows( 'options' ) ) : the_row(); 
		if ( have_rows( 'fold_settings' ) ) :
			while ( have_rows( 'fold_settings' ) ) : the_row(); 
			
			$foldColor = get_sub_field('fold_color');
				if($foldColor){
					
					if(strpos($foldColor, 'page') !== false){
						if($scheme){
							$foldColor = $scheme;
						}
					}
					$classes.= ' fold';
						$foldClass = 'bg-' . $foldColor;
						$foldUtils .=' data-class="'. $foldClass .'"';
				}
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
				
			endwhile;
		endif; 
		$options_type = get_sub_field( 'type' );
		$options_position = get_sub_field( 'positioning' ); 
		$options_interval = get_sub_field( 'interval' ); 
		$options_same_height = get_sub_field('same_height');
		$options_custom_height = get_sub_field('custom_height');
		$options_scroll__drag = get_sub_field('scroll__drag');
		$options_per_move = get_sub_field('per_move');
		$options_arrows = get_sub_field('arrows');

		if ( get_sub_field( 'autoplay' ) == 1 ) : 
			$options_autoplay = 'data-additional-options="autoplay: true, interval: '.$options_interval.',"';
		endif; 
		$options_gap = get_sub_field( 'gap' ); 
		if($options_position){
			$classes .=' d-flex justify-content-bottom';
		}
		if(empty($options_gap)) {
			$options_gap = '40';
		}
		if(empty($options_arrows)) {
			$options_arrows = 'false';
		}
		if(empty($options_type)) {
			$options_type = 'slide';
		}

		if(empty($options_same_height)) {
			$options_same_height = '';
			if(empty($options_position)) {
				$classes .=' middle';
			}
		} else {
			$options_same_height = 'data-same-height="'.$options_same_height.'"';
		}

		if(empty($options_per_move)) {
			$options_per_move = 1;
		}
		if(empty($options_scroll__drag)) {
			$options_scroll__drag = 'free';
		}
		
		// block content here
		$blockContent .= '<div id="'. esc_attr( $id ).'" class="'. esc_attr( $classes ).'"';
		$blockContent .= ' data-type="'.$options_type.'"';	
		$blockContent .= ' data-drag="'.$options_scroll__drag.'"';
		$blockContent .= ' '.$options_same_height;
		if($options_custom_height){$blockContent .= ' data-custom_height="'.$options_custom_height.'"';}
		$blockContent .= ' data-arrows="'.$options_arrows.'"';
		$blockContent .= ' data-per_move="'.$options_per_move.'"';
		$blockContent .= ' data-gap="'.$options_gap.'" '.$options_autoplay.' '.$foldUtils.'>';
		$blockContent .= '<div class="splide__track">';
		$blockContent .= '<ul class="splide__list">';
		$blockContent .= $slides;
		$blockContent .= '</ul>';
		$blockContent .= '</div>';
		$blockContent .= '</div>';
		
		echo $blockContent;

	endwhile; ?>
<?php else: ?>
	<?php // No layouts found ?>
<?php endif; ?>

