<?php
/**
 * Template Name: ShareableTemplate
 * This is the sharable pages template
 * @package Gamiphy
 */

get_header();
global $options; 
    $options = get_option( 'gamiphy_settings' );
?>

<?php dynamic_sidebar( 'sharable-page-sidebar' ); ?>

<?php
// get_sidebar();
get_footer();
