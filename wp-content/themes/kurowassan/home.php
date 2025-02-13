<?php
/**
 * Template Name: Home Page
 *
 */

get_header();
?>

<main id="home" class="site-main">
    <?php get_template_part('template-parts/content','banner'); ?>
    <?php get_template_part('template-parts/template','about'); ?>

</main>

<?php
get_footer();