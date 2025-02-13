
<?php echo get_template_part( 'template-parts/template', 'breadcrumb' ) ; ?>
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
                    
                    <div  class="product-ctrl">
                        <div class="qty-control">
                            <button type="button" class="qty-btn minus">-</button>
                            <input type="text" id="product-qty" value="1" min="1" max="10">
                            <button type="button" class="qty-btn plus">+</button>
                        </div>

                        <button type="button" class="add-to-cart-btn" data-product-id="<?php echo $product_id ?>">Add to Cart</button>

                        <span class="cart-status"></span> 
                    </div>
                </div>

                <div>
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
</div>


