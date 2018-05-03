<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamiphy
 */

?>
<section class="container-fluid">
    <div class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div><!-- .entry-header -->

    <?php
    the_content();
    ?>
</section>