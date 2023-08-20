<?php
$classes = '';

//$classes .= ' header-partial';

$currentID = get_the_ID();
?>

<div id="header-<?php the_ID(); ?>" class="<?php echo esc_attr( $classes ); ?> header-container">
    <header class="fold" data-class="header">
    </header>
    <div class="offering-specific-elements container">
        <div class="subnav position-absolute fold" data-class="header">
            <?php //sub nav start
                echo get_subnav();
            // subnav end 
            ?>
        </div>
    </div>
        <?php echo get_background_lines(); ?>
</div>