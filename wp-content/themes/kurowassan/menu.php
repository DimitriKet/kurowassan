<?php
/**
* Template Name: Menu Page
*/

get_header();
?>

<div id="menu">
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
                        <a href="<?php echo $permalink; ?>" class="menu-item">
                            <div class="menu-img">
                                <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                            </div>
                            <span><?php echo $category->name; ?></span>
                        </a>
                    <?php
                    endforeach;
                endif;
            ?>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <h3 class="section-title">Our Products</h3>
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 20,
                    'paged' => $paged
                );
                $products_query = new WP_Query($args);
                ?>
                <div class="products-grid">
                    <?php
                    if($products_query->have_posts()):
                        while ($products_query->have_posts()) : $products_query->the_post();
                            $product_id = get_the_ID();
                            $product = wc_get_product($product_id);
                            $image_url = get_the_post_thumbnail_url($product_id, 'full');
                    ?>
                        <div class="product-item">
                            <div class="product-img">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>">
                                </a>
                            </div>
                            <div class="product-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="price"><?php echo $product->get_price(); ?> đ</p>
                                <button type="button" class="add-to-cart" data-product-id="<?php echo $product_id; ?>">Add to Cart</button>
                            </div>
                        </div>
                    <?php 
                        endwhile;
                    ?>
                    <div class="pagination-wrapper">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $products_query->max_num_pages,
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
                        echo '<p>No products found. Please check back later.</p>';
                        echo '</div>';
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();