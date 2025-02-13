<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kurowassan
 */

get_header();
?>

<?php get_template_part( 'template-parts/single/'.get_post_type()); ?>

<?php
get_sidebar();
get_footer();
