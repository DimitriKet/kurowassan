
<?php echo get_template_part( 'template-parts/template', 'breadcrumb' ) ; ?>
<div class="container product">
    <div class="row">
        <?php if (have_posts()):
            while (have_posts()):the_post();
                $product_id = get_the_ID();
                $image_url = get_the_post_thumbnail_url($product_id, 'full');
                ?>
                <div class="col-12 col-md-8">
                    <div class="product-img">
                        <img src="<?php echo esc_url($image_url); ?>" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <h2><?php the_title(); ?></h2>
                    <?php woocommerce_template_loop_price(); ?>
                </div>

        <?php
            endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</div>


