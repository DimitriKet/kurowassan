<?php
/**
* Template Name: About Page
*/

get_header();
?>

<main>
    <?php echo get_template_part( 'template-parts/template', 'breadcrumb' ) ; ?>  
    <?php echo get_template_part( 'template-parts/template', 'about' ) ; ?>  
</main>

<?php
get_footer();