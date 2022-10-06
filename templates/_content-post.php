<?php
if (isset($args['classes'])) {
    $classes = $args['classes'];
} else {
    $classes = 'fadeNoScroll';
}
if (isset($args['utilities'])) {
    $utils = $args['utilities'];
} else {
    $utils = '';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); echo $utils; ?>>
    <div class="card border-0">
        <div class="card-body">
            <div class="card-text entry-content">
                <?php
                    if ( has_post_thumbnail() ) :
                        echo '<div class="post-thumbnail ratio ratio-16x9">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>';
                    endif;
                ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'supply' ) . '</span>', 'after' => '</div>' ) ); ?>
            </div><!-- /.card-text -->
            <header>
            <span class="h8">
                <?php
                // to display categories without a link
                foreach ( ( get_the_category() ) as $category ) {
                    echo $category->cat_name . ' ';
                }
                ?>
            </span>
            <h5 class="card-title">
                <a href="<?php the_permalink(); ?>" class="stretched-link" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h5>
        </header>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->