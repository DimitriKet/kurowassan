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
        <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <table>
                <thead>
                    <tr>
                        <th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'woocommerce' ); ?></span></th>
                        <th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'woocommerce' ); ?></span></th>
                        <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                        <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                        <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                        <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );    
                    ?>
                    <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                        <td class="product-remove">
                            <?php
                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        /* translators: %s is the product name */
                                        esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                        esc_attr( $product_id ),
                                        esc_attr( $_product->get_sku() )
                                    ),
                                    $cart_item_key
                                );
                            ?>
                        </td>

                        <td class="product-thumbnail">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                        if ( ! $product_permalink ) {
                            echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                        }
                        ?>
                        </td>

                        <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                        <?php
                        if ( ! $product_permalink ) {
                            echo wp_kses_post( $product_name . '&nbsp;' );
                        } else {
                            /**
                             * This filter is documented above.
                             *
                             * @since 2.1.0
                             */
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                        }

                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                        // Meta data.
                        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                        // Backorder notification.
                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                        }
                        ?>
                        </td>

                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                            ?>
                        </td>

                        <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
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
                        </td>


                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                            ?>
                        </td>
                    </tr>
                <?php
                    endif;
                endforeach;
                ?>
                    <tr>
                        <td colspan="6">
                            <button type="submit" class="button update-cart-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                                <?php esc_html_e( 'Cập nhật giỏ hàng', 'woocommerce' ); ?>
                            </button>
                            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="button checkout-button">
                                <?php esc_html_e('Thanh toán', 'woocommerce'); ?>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<?php 
get_footer();