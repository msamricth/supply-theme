<?php
$classes = 'fadeNoScroll';

if (isset($args['utilities'])) {
    $utils = $args['utilities'];
} else {
    $utils = '';
}
if (isset($args['classes'])) {
    $classes = $args['classes'];
    echo '<div class="fold" '. $utils.'></div>';
} 
$header_video ='';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); echo $utils; ?>>
    <div class="card border-0">
        <div class="card-body">
            <div class="card-text entry-content">
                <?php
                    if ( has_post_thumbnail() ) :
                        echo '<div class="post-thumbnail feat-img ratio ratio-16x9">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>';
                    else:
                        if ( have_rows( 'header_media', get_the_ID()) ) :
                            while ( have_rows( 'header_media' ) ) : the_row();
                                $header_video =  get_sub_field( 'video' );
                                if($header_video){
                                    echo '<div class="post-thumbnail ratio ratio-16x9">' . background_video($header_video) . '</div>';  
                                }
                            endwhile;
                        endif;
                    endif;
                ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'supply' ) . '</span>', 'after' => '</div>' ) ); ?>
            </div><!-- /.card-text -->
            <header>
                <a class="stretched-link h8" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            <h5 class="card-title">
                <?php if(get_field( 'title_of_work_performed', get_the_ID() )){
                    //Case Studies before the November Case Study Intro Block update
                    the_field( 'title_of_work_performed', get_the_ID() );
                } else {
                    //gets the project study from the case study intro block used on the referenced case study
                    echo project_title_fromBlock(get_the_ID());
                } ?>
            </h5>
        </header>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->