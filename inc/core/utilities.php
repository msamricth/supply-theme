<?php
/**
 * Block template file: inc/core/utilities.php
 * Utilities for the Supply Theme
 *
 * @package Supply Theme
 * @since v9
 */


/** PHP color stuff - trying to take it easy on browser side JS */
if ( ! function_exists( 'HTMLToRGB' ) ) :
	function HTMLToRGB($htmlCode) {
		if($htmlCode[0] == '#')
		$htmlCode = substr($htmlCode, 1);

		if (strlen($htmlCode) == 3)
		{
		$htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
		}

		$r = hexdec($htmlCode[0] . $htmlCode[1]);
		$g = hexdec($htmlCode[2] . $htmlCode[3]);
		$b = hexdec($htmlCode[4] . $htmlCode[5]);

		return $b + ($g << 0x8) + ($r << 0x10);
	}
endif;


if ( ! function_exists( 'RGBToHSL' ) ) :
	function RGBToHSL($RGB) {
		$r = 0xFF & ($RGB >> 0x10);
		$g = 0xFF & ($RGB >> 0x8);
		$b = 0xFF & $RGB;

		$r = ((float)$r) / 255.0;
		$g = ((float)$g) / 255.0;
		$b = ((float)$b) / 255.0;

		$maxC = max($r, $g, $b);
		$minC = min($r, $g, $b);

		$l = ($maxC + $minC) / 2.0;

		if($maxC == $minC)
		{
		$s = 0;
		$h = 0;
		}
		else
		{
		if($l < .5)
		{
			$s = ($maxC - $minC) / ($maxC + $minC);
		}
		else
		{
			$s = ($maxC - $minC) / (2.0 - $maxC - $minC);
		}
		if($r == $maxC)
			$h = ($g - $b) / ($maxC - $minC);
		if($g == $maxC)
			$h = 2.0 + ($b - $r) / ($maxC - $minC);
		if($b == $maxC)
			$h = 4.0 + ($r - $g) / ($maxC - $minC);

		$h = $h / 6.0; 
		}

		$h = (int)round(255.0 * $h);
		$s = (int)round(255.0 * $s);
		$l = (int)round(255.0 * $l);

		return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
	}

endif;


if ( ! function_exists( 'get_scheme' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v7.6
	 */
	function get_scheme($custom=null) {
        $output = '';
        if (isset($custom)) {
            $scheme = $custom;
        } else {
            $scheme = get_field('background_color');
        }
        if($scheme){
            if(strpos($scheme, 'dots') !== false){
                $bodyClasses .= ' dots_on ';
                $scheme = 'bg-light bg-pattern';
           // }elseif(strpos($scheme, 'offerings') !== false){
             //   $scheme = 'bg-dark bg-offerings';
            } else {
                $scheme = 'bg-'. $scheme . ' ';
            }
        } else {
            $scheme = 'bg-light';
        }
		return $scheme;
    }

endif;


if ( ! function_exists( 'customRatio' ) ) :
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v3.6 updated v9
	 */

	function customRatio($ratio) {
		if($ratio){
			$blockStyles = '';
			// Use preg_match_all() function to check match
			preg_match_all('!\d+\.*\d*!', $ratio, $ratiomatches);
			$i = 0;
			$ratioWidth = '';
			$ratioHeight = '';
			foreach ($ratiomatches as $ratiomatch) {
				foreach ($ratiomatch as $ratiom) {
					if ($i == 0) {
						$ratioWidth = $ratiom;
					} else {
						$ratioHeight = $ratiom;
					}
					$i++;
				}
			}
			if($ratiomatches){
				if(empty($ratioWidth)) {
					if(empty($ratioHeight)) {
						if(strpos($ratio, '.') !== false){
							list($ratioWidth, $ratioHeight) = preg_split("/x/",$ratio);
							$ratioWidth = preg_replace("/[^0-9\.]/", '', $ratioWidth);
						}
					}
				}
			}
			$presetRatios = array('21x9','16x9','4x3','3x2','fullw');
			if(strpos(implode(" ",$presetRatios), $ratio) !== false){} else {
				$ratio = str_replace('.', '\.', $ratio);
				$blockStyles .= '<style type="text/css">';
				$blockStyles .= '.'.$ratio.':before, .ratio-'.$ratio.':before {';
				$blockStyles .= '  --bs-aspect-ratio: calc('.$ratioHeight.' / '.$ratioWidth.' * 100%);';
				$blockStyles .= '} </style>';
				return $blockStyles;
			}
		}
	}
endif;

if ( ! function_exists( 'supply_oembed_filter' ) ) :
/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 */
	function supply_oembed_filter( $html ) {
		return '<div class="ratio ratio-16x9">' . $html . '</div>';
	}
endif;
add_filter( 'embed_oembed_html', 'supply_oembed_filter', 10, 4 );

function get_supply_postID(){
	$output = '';
	$post_id = '';
	$current_post = get_queried_object();
	$post_id = $current_post ? $current_post->ID : null;

	if($post_id){
		$output = $post_id;
		return $output;
	}
}