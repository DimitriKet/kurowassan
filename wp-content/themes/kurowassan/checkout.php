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
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form">
                    <?php
                    
                    // Output the checkout form
                    if (function_exists('woocommerce_checkout_form')) {
                        woocommerce_checkout_form();
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-order-summary">
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
</div>
<?php get_footer(); ?>
