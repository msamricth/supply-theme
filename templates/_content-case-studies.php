<article id="post-<?php the_ID(); ?>" <?php post_class( 'fadeNoScroll' ); ?>>
    <div class="card border-0">
        <div class="card-body">
            <div class="card-text entry-content">
                <?php
                    if ( has_post_thumbnail() ) :
                        echo '<div class="post-thumbnail feat-img ratio ratio-16x9">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>';
                    else:
                        if ( have_rows( 'header_media' ) ) :
                            while ( have_rows( 'header_media' ) ) : the_row();
                                $header_video =  get_sub_field( 'video' );
                                echo '<div class="post-thumbnail ratio ratio-16x9">' . background_video($header_video) . '</div>';
                            endwhile;
                        endif;
                    endif;
                ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'supply' ) . '</span>', 'after' => '</div>' ) ); ?>
            </div><!-- /.card-text -->
            <header>
                <a class="stretched-link h8" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'supply' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            <h5 class="card-title">
                <?php the_field( 'title_of_work_performed' ); ?>
            </h5>
        </header>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->