<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();
$classes = 'featured-article ';
$sction_class = 'fourbyfour';
$page_id = get_option( 'page_for_posts' );
$article_landing_background_color = get_field('article_landing_background_color');
$article_landing_section_background_color = get_field('articles_landing_section_background_color');

$header_type =  get_field( 'header_type' );
$classes .= $header_type; 
if(empty($article_landing_background_color)){
	$article_landing_background_color = '#213333';
}
if($article_landing_background_color == "light"){
	
	$article_landing_background_color = '#ffffff';
}
$rgb = HTMLToRGB($article_landing_background_color);
$hsl = RGBToHSL($rgb);
$article_header_image = get_field('article_header_image');
if($hsl->lightness > 200) {
// this is light colour!
	$classes .= ' text-primary';
} else {
	$classes .= ' text-white';
}
$post_IDs = '';
$featured_post = get_field( 'featured_post' ); 
if ( $featured_post ) : 
	$post_IDs .= $featured_post . ', ';
endif; 

$post_IDs = array_map( 'trim', explode( ',', $post_IDs ) ); // right
if ( $featured_post ) : 
	$args = array(
		'post_type' => array('post'),
		'posts_per_page' => 1,
		'post__in' => $post_IDs
		
	);
else :
	$args = array(
		'post_type' => array('post'),
		'posts_per_page' => 1
	);   
endif; 
$the_query = new WP_Query( $args ); ?>


<header class="entry-header article-header fold bg-pattern" data-class="header" style="background-color: <?php echo $article_landing_background_color; ?>">
	<div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> header-container">
		<div class="container">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$post_type = get_post_type(); 
				get_template_part('templates/_content', $post_type);
			endwhile; 
			wp_reset_postdata(); ?>
		</div>
	</div>
</header>


<?php 
if(empty($article_landing_section_background_color)){
	$article_landing_section_background_color = '#000';
}
if($article_landing_section_background_color == "light"){
	
	$article_landing_section_background_color = '#ffffff';
}
$rgb = HTMLToRGB($article_landing_section_background_color);
$hsl = RGBToHSL($rgb);
if($hsl->lightness > 200) {
// this is light colour!
	$sction_class .= ' text-primary';
} else {
	$sction_class .= ' text-white';
}
$post_offset = '';
if ( $featured_post ) : 
	$the_query = new WP_Query( array( 'posts_per_page' => 4, 'post__not_in' => $post_IDs ) );
else:
	$the_query = new WP_Query( array( 'posts_per_page' => 4, 'offset' => 1 ) );
endif;
?>
<?php if ( $the_query->have_posts() ) : $postCount = 1; ?>
	<section class="<?php echo $sction_class;?> first" style="background-color:<?php echo $article_landing_section_background_color;?>">
		<div class="container posts-loop-section fold" data-class="bg-dark">
			<div class="row">
				<?php while ( $the_query->have_posts() ) : $postCount++; $the_query->the_post(); ?>
					<div class="col-md-6 col-dlg-5<?php if($postCount % 2 == 0 ) { ?> offset-dlg-1<?php } ?><?php if($postCount == 2 or $postCount == 3) { ?> leaft<?php } ?>">
						<?php $post_type = get_post_type(); get_template_part('templates/_content', $post_type); ?>
						<div class="sep-con"><span class="seperator"></span></div>
					</div>  
				<?php  endwhile; ?>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</section>

<?php endif; ?>
<?php $the_query = new WP_Query( array( 'posts_per_page' => 1, 'offset' => 5) );
if ( $the_query->have_posts() ) : $postCount = 1; ?>
	<section class="entry-header  bg-pattern article-header fold" data-class="bg-pattern" style="background-color: <?php echo $article_landing_background_color; ?>">
		<div id="featured-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> ">
			<div class="container">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
					$post_type = get_post_type(); 
					get_template_part('templates/_content', $post_type);
				endwhile; 
				wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php $the_query = new WP_Query( array( 'posts_per_page' => 4, 'offset' => 5 ) );
if ( $the_query->have_posts() ) : $postCount = 1; ?>
	<section class="<?php echo $sction_class;?>" style="background-color:<?php echo $article_landing_section_background_color;?>">
		<div class="container posts-loop-section fold" data-class="bg-dark">
			<div class="row">
				<?php while ( $the_query->have_posts() ) : $postCount++; $the_query->the_post(); ?>
					<div class="col-md-6 col-dlg-5<?php if($postCount % 2 == 0 ) { ?> offset-dlg-1<?php } ?><?php if($postCount == 2 or $postCount == 3) { ?> leaft<?php } ?>">
						<?php $post_type = get_post_type(); get_template_part('templates/_content', $post_type); ?>
						<div class="sep-con"><span class="seperator"></span></div>
					</div>  
				<?php  endwhile; ?>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</section>
<?php endif; ?>

<?php
get_footer();
