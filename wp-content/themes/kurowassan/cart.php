<?php
/**
* Template Name: Cart Page
*/

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div id="cart">
    <div class="container">
        <div class="cart-wrapper">
            <?php if (WC()->cart->is_empty()): ?>
                <div class="empty-cart">
                    <div class="empty-cart-content">
                        <i class="fas fa-shopping-cart"></i>
                        <h2>Your cart is empty</h2>
                        <p>Looks like you haven't added any items to your cart yet.</p>
                        <a href="<?php echo get_permalink(get_page_by_path('menu')); ?>" class="btn-primary">Continue Shopping</a>
                    </div>
                </div>
            <?php else: ?>
                <form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                    <div class="cart-content">
                        <div class="cart-items">
                            <h2>Your Shopping Cart</h2>
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                                $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)):
                                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                                    <div class="cart-item">
                                        <div class="item-image">
                                            <?php
                                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                            if ($product_permalink) {
                                                printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                            } else {
                                                echo $thumbnail;
                                            }
                                            ?>
                                        </div>
                                        <div class="item-details">
                                            <div class="item-name">
                                                <h3>
                                                    <?php
                                                    if ($product_permalink) {
                                                        echo sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name());
                                                    } else {
                                                        echo wp_kses_post($product_name);
                                                    }
                                                    ?>
                                                </h3>
                                                <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                            </div>
                                            <div class="item-price">
                                                <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                                            </div>
                                            <div class="item-quantity">
                                                <?php
                                                $max_quantity = $_product->get_max_purchase_quantity();
                                                if ($max_quantity <= 0) {
                                                    $max_quantity = 999;
                                                }
                                                ?>
                                                <div class="qty-control" data-cart-item="<?php echo esc_attr($cart_item_key); ?>">
                                                    <button type="button" class="qty-btn minus">-</button>
                                                    <input type="text" class="product-qty" value="<?php echo esc_attr($cart_item['quantity']); ?>" min="1" max="<?php echo esc_attr($max_quantity); ?>">
                                                    <button type="button" class="qty-btn plus">+</button>
                                                </div>
                                            </div>
                                            <div class="item-subtotal">
                                                <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                            </div>
                                            <div class="item-remove">
                                                <?php
                                                echo apply_filters(
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fas fa-times"></i></a>',
                                                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                        esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                                                        esc_attr($product_id),
                                                        esc_attr($_product->get_sku())
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                        
                        <div class="cart-summary">
                            <h3>Cart Summary</h3>
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                            </div>
                            <?php if (WC()->cart->get_cart_shipping_total()): ?>
                            <div class="summary-row">
                                <span>Shipping:</span>
                                <span><?php echo WC()->cart->get_cart_shipping_total(); ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span><?php echo WC()->cart->get_total(); ?></span>
                            </div>
                            <div class="cart-actions">
                                <button type="submit" class="update-cart-btn" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
                                    Update Cart
                                </button>
                                <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>