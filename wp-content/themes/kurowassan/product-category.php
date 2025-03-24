<?php
/**
* Template Name: Product Category Page
*/

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div id="product-category">
    <section id="product-category">
        <?php
            $current_category = get_queried_object();
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'paged' => $paged,
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
                    $product = wc_get_product($product_id);
                    $image_url = get_the_post_thumbnail_url($product_id, 'full');
                    ?>
                    <div class="menu-item">
                        <div class="menu-img">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>">
                            </a>
                        </div>
                        <div class="menu-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="price"><?php echo $product->get_price(); ?> đ</p>
                            <button type="button" class="add-to-cart" data-product-id="<?php echo $product_id; ?>">Add to Cart</button>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    
                    <div class="pagination-wrapper">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                            'type' => 'list',
                            'end_size' => 3,
                            'mid_size' => 3
                        ));
                        ?>
                    </div>
                <?php
                else:
                    echo '<div class="no-products-message">';
                    echo '<p>No products found in this category. Please check back later.</p>';
                    echo '</div>';
                endif;
            ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>  
    </section>
</div>

<?php 
get_footer();