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
$classes .= ' ';
enqueue_footer_markup('<style>#post-'.get_the_ID().' .ratio-image {background-image:url('.get_the_post_thumbnail_url( get_the_ID(), 'full' ).');}</style>');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); echo $utils; ?>>
    <div class="card border-0">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="card-text entry-content col-md order-1 order-md-2 offset-xl-1">
                    <?php
                        if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail ratio ratio-3x2">
                                <a href="<?php the_permalink(); ?>" class="nolink ratio-image d-block" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"></a>
                            </div>
                        <?php endif;
                    ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'supply' ) . '</span>', 'after' => '</div>' ) ); ?>
                </div><!-- /.card-text -->
                <div class="col-md order-2 order-md-1 col-xl-5">
                    <a href="<?php the_permalink(); ?>" class="nolink" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?> - Read More" rel="bookmark">
                        <span class=" h8"  title="Posted Date" rel="bookmark">
                            <?php echo esc_attr( get_the_date('M j')); ?> &#x2022; <span class="read-time"></span>
                        </span>
                    </a>
                    
                    <h5>
                        <a href="<?php the_permalink(); ?>" class="nolink" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a>
                    </h5>
                    <p>
                        <a href="<?php the_permalink(); ?>" class="nolink" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                            <?php the_excerpt(); ?>
                        </a>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="the-permalink" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?> - Read More" rel="bookmark">Read More</a>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
    <?php if ( is_admin() ) { ?><style>.d-none {display:none !important} </style> <?php } ?>
    <section class="d-none estimate" id="estimate-<?php the_ID(); ?>"><?php echo wp_strip_all_tags( get_the_content() ); ?></section>
</article><!-- /#post-<?php the_ID(); ?> -->