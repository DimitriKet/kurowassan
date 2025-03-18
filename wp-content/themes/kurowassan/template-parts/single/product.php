<?php get_header(); ?>

<div id="product">
    <div class="container product">
        <div class="row">
            <?php if (have_posts()):
                while (have_posts()):the_post();
                    $product_id = get_the_ID();
                    $image_url = get_the_post_thumbnail_url($product_id, 'full');

                    $product = wc_get_product($product_id);
                    $price = $product->price;
                    ?>
                    <div class="col-12 col-md-8">
                        <div class="product-img">
                            <img src="<?php echo esc_url($image_url); ?>" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo $price; ?> đ</p>
                        
                        <div class="product-ctrl">
                            <div class="qty-control">
                                <button type="button" class="qty-btn minus">-</button>
                                <input type="text" id="product-qty" value="1" min="1" max="10">
                                <button type="button" class="qty-btn plus">+</button>
                            </div>

                            <button type="button" class="add-to-cart-btn" data-product-id="<?php echo $product_id ?>">Add to Cart</button>

                            <span class="cart-status"></span> 
                        </div>
                    </div>

                    <div class="col-12">
                        <h2>Description</h2>
                        <div class="product-desc">
                            <?php echo get_the_content(); ?> 
                        </div>
                    </div>
                    
            <?php
                endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>

        <!-- Related Products Section -->
        <div class="related-products">
            <h2 class="section-title">Related Products</h2>
            <div class="row">
                <?php
                // Get current product categories
                $terms = get_the_terms($product_id, 'product_cat');
                if ($terms && !is_wp_error($terms)) {
                    $category_ids = array();
                    foreach ($terms as $term) {
                        $category_ids[] = $term->term_id;
                    }

                    // Query related products
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 4,
                        'post__not_in' => array($product_id),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => $category_ids,
                                'operator' => 'IN'
                            )
                        )
                    );

                    $related_query = new WP_Query($args);

                    if ($related_query->have_posts()) :
                        while ($related_query->have_posts()) : $related_query->the_post();
                            $related_product = wc_get_product(get_the_ID());
                            $related_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            ?>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="related-product-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="related-product-img">
                                            <img src="<?php echo esc_url($related_image); ?>" alt="<?php the_title(); ?>">
                                        </div>
                                        <div class="related-product-info">
                                            <h3><?php the_title(); ?></h3>
                                            <p class="price"><?php echo $related_product->get_price(); ?> đ</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                }
                ?>
            </div>
        </div>
    </div>
</div>


