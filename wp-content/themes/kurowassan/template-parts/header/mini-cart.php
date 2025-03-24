<?php
if (!defined('ABSPATH')) {
    exit;
}

$cart_count = WC()->cart->get_cart_contents_count();
$cart_total = WC()->cart->get_cart_total();
?>

<div class="mini-cart-wrapper">
    <div class="mini-cart-header">
        <h3>Your Cart (<?php echo $cart_count; ?>)</h3>
        <button type="button" class="close-mini-cart">×</button>
    </div>
    
    <?php if ($cart_count > 0) : ?>
        <div class="mini-cart-items">
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : 
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    ?>
                    <div class="mini-cart-item">
                        <div class="item-image">
                            <?php echo $thumbnail; ?>
                        </div>
                        <div class="item-details">
                            <h4><?php echo $_product->get_name(); ?></h4>
                            <div class="item-price">
                                <?php echo $cart_item['quantity']; ?> × <?php echo WC()->cart->get_product_price($_product); ?>
                            </div>
                        </div>
                        <div class="item-remove">
                            <?php
                            echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s">×</a>',
                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                esc_html__('Remove this item', 'woocommerce'),
                                esc_attr($_product->get_id()),
                                esc_attr($cart_item_key)
                            ), $cart_item_key);
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div class="mini-cart-footer">
            <div class="cart-subtotal">
                <span>Subtotal:</span>
                <span class="amount"><?php echo $cart_total; ?></span>
            </div>
            <div class="cart-buttons">
                <a href="<?php echo wc_get_cart_url(); ?>" class="button view-cart">View Cart</a>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout">Checkout</a>
            </div>
        </div>
    <?php else : ?>
        <div class="mini-cart-empty">
            <p>Your cart is empty.</p>
            <a href="<?php echo get_permalink(get_page_by_path('menu')); ?>" class="button continue-shopping">Continue Shopping</a>
        </div>
    <?php endif; ?>
</div> 