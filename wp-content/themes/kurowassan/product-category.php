<?php
/**
* Template Name: Produt Category Page
*/

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div id="product-category">
    <section id="product-category">
        <?php
            $current_category = get_queried_object(); 

            $args = array(
                'post_type' => 'product',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $current_category->term_id,
                    ),
                ),
            );
            $query = new WP_Query($args);
        ?>
        <div class="container">
            <div class="product-title">
                <h2><?php echo $current_category->name ?></h2>
            </div>
            <div class="menu-product">
            <?php             
                if($query->have_posts()):
                    while ($query->have_posts()) : $query->the_post(); 
                    $product_id = get_the_ID();
                    $image_url = get_the_post_thumbnail_url($product_id, 'full');
                    ?>
                    <div class="menu-item">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url($image_url); ?>" alt="">
                            <h2><?php the_title(); ?></h2>
                            <p><?php woocommerce_template_loop_price(); ?></p>
                        </a>
                    </div>
                    <?php endwhile;
                endif;
            ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>  
    </section>
         
</div>

<?php 
get_footer();