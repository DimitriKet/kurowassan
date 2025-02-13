<?php
/**
* Template Name: Menu Page
*/

get_header();
?>

<main>
    <?php echo get_template_part( 'template-parts/template', 'breadcrumb' ) ; ?>  
    <section id="menu">
        <?php
            $categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'orderby' => 'id',
                'order' => 'DESC',
                'hide_empty' => 0
            ));
        ?>
        <div class="container">
            <div class="product-title">
                <h2>Our Menu</h2>
            </div>
            <div class="menu-product">
            <?php             
                if(!empty($categories)):
                    foreach($categories as $category):
                        $permalink = get_category_link($category->term_id);
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = wp_get_attachment_url($thumbnail_id);
                        $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    ?>
                        <a href="<?php echo $permalink
                            ?>" class="menu-item">
                            <div class="menu-img">
                                <img src="<?php echo $image_url?>" alt="<?php echo $image_alt ?>">
                            </div>
                            <span><?php echo $category->name; ?></span>
                        </a>
                    <?php
                    endforeach;
                endif;
            ?>
            </div>

        </div>
    </section>


</main>

<?php
get_footer();