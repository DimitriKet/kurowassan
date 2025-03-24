<?php
/**
* Template Name: Checkout Page
*/

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div id="checkout">
    <div class="container">
        <div class="checkout-wrapper">
            <div class="section-title text-center mb-5">
                <h1>Checkout</h1>
                <p>Please fill in your details to complete your order</p>
            </div>

            <?php if (!WC()->cart->is_empty()): ?>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-form">
                            <div class="form-header">
                                <h2>Shipping Information</h2>
                            </div>
                            <form id="shipping-form" class="shipping-form">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="fullname">Full Name <span class="required">*</span></label>
                                        <input type="text" id="fullname" class="form-control" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">Phone Number <span class="required">*</span></label>
                                        <input type="tel" id="phone" class="form-control" placeholder="Enter your phone number" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email Address <span class="required">*</span></label>
                                        <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="province">Province/City <span class="required">*</span></label>
                                        <select id="province" class="form-control" required>
                                            <option value="">Select province/city</option>
                                            <option value="ho-chi-minh">Ho Chi Minh City</option>
                                            <option value="ha-noi">Ha Noi</option>
                                            <option value="da-nang">Da Nang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="district">District <span class="required">*</span></label>
                                        <select id="district" class="form-control" required>
                                            <option value="">Select district</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ward">Ward <span class="required">*</span></label>
                                        <select id="ward" class="form-control" required>
                                            <option value="">Select ward</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="street">Street Address <span class="required">*</span></label>
                                        <input type="text" id="street" class="form-control" placeholder="House number, street name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" id="different-address" class="form-check-input">
                                            <label class="form-check-label" for="different-address">
                                                Ship to a different address?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="notes">Order Notes (optional)</label>
                                        <textarea id="notes" class="form-control" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="checkout-form mt-4">
                            <div class="form-header">
                                <h2>Payment Method</h2>
                            </div>
                            <div class="payment-methods">
                                <div class="form-check mb-3">
                                    <input type="radio" id="cod" name="payment_method" class="form-check-input" checked>
                                    <label class="form-check-label" for="cod">
                                        Cash on Delivery (COD)
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="radio" id="bank-transfer" name="payment_method" class="form-check-input">
                                    <label class="form-check-label" for="bank-transfer">
                                        Bank Transfer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-summary">
                            <div class="summary-header">
                                <h2>Order Summary</h2>
                            </div>
                            <div class="summary-content">
                                <?php 
                                // Output the order review
                                if (function_exists('woocommerce_order_review')) {
                                    woocommerce_order_review(); 
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-cart-message">
                    <div class="message-content text-center">
                        <i class="fas fa-shopping-cart mb-4"></i>
                        <h2>Your cart is empty</h2>
                        <p>Please add some items to your cart before proceeding to checkout.</p>
                        <a href="<?php echo get_permalink(get_page_by_path('menu')); ?>" class="btn-primary mt-4">Continue Shopping</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
