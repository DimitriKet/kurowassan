/**
 * AJAX Pagination for Kurowassan Theme
 */
(function($) {
    'use strict';
    
    // Main function to handle AJAX pagination
    function KurowassanPagination() {
        var self = this;
        
        // Initialize the module
        this.init = function() {
            this.setupEventListeners();
            this.initAddToCartButtons();
        };
        
        // Set up event listeners for pagination links
        this.setupEventListeners = function() {
            // Handle pagination links click
            $(document).on('click', '.pagination-wrapper .page-numbers a', function(e) {
                e.preventDefault();
                var pageUrl = $(this).attr('href');
                
                // Update browser history without navigating
                if (window.history && window.history.pushState) {
                    window.history.pushState({path: pageUrl}, '', pageUrl);
                }
                
                self.loadPageAjax(pageUrl);
            });
            
            // Handle browser back/forward buttons
            $(window).on('popstate', function(e) {
                if (e.originalEvent && e.originalEvent.state && e.originalEvent.state.path) {
                    self.loadPageAjax(e.originalEvent.state.path);
                } else {
                    self.loadPageAjax(window.location.href);
                }
            });
        };
        
        // Load page content via AJAX
        this.loadPageAjax = function(pageUrl) {
            var $productsGrid = $('[data-ajax-container="true"]');
            var $productsSection = $('#menu-products');
            var $paginationWrapper = $('.pagination-wrapper');
            
            // Exit if products grid doesn't exist
            if ($productsGrid.length === 0) {
                console.error('Products grid not found');
                return;
            }
            
            // Show loading indicator
            this.showLoading($productsGrid);
            
            // Use our dedicated AJAX endpoint instead of fetching the whole page
            $.ajax({
                url: kurowassan_data.ajax_url,
                type: 'POST',
                data: {
                    action: 'kurowassan_load_page_content',
                    page_url: pageUrl,
                    nonce: kurowassan_data.nonce
                },
                success: function(response) {
                    if (response.success && response.data) {
                        // Update the content
                        $productsGrid.find('.product-item').remove();
                        $productsGrid.find('.no-products-message').remove();
                        $productsGrid.find('.loading-overlay').remove();
                        $productsGrid.find('.error-message').remove();
                        
                        // Add the new products to the grid
                        $productsGrid.prepend(response.data.products_html);
                        
                        // Update pagination if it exists
                        if (response.data.pagination) {
                            // If pagination wrapper doesn't exist but we have pages, create it
                            if ($paginationWrapper.length === 0 && response.data.max_pages > 1) {
                                $('<div class="pagination-wrapper"></div>').insertAfter($productsSection);
                                $paginationWrapper = $('.pagination-wrapper');
                            }
                            
                            // Update pagination content
                            if (response.data.max_pages > 1) {
                                $paginationWrapper.html(response.data.pagination).show();
                            } else {
                                $paginationWrapper.hide();
                            }
                        } else {
                            $paginationWrapper.hide();
                        }
                        
                        // Update current page attribute
                        $productsGrid.attr('data-current-page', response.data.page);
                        
                        // Scroll to the top of the products section
                        self.scrollToProducts();
                        
                        // Re-initialize add to cart buttons
                        self.initAddToCartButtons();
                    } else {
                        self.handleError(response.data ? response.data.message : 'Error loading products');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    self.handleError('Error communicating with the server. Please try again.');
                }
            });
        };
        
        // Show loading indicator
        this.showLoading = function($container) {
            // Remove any existing loading overlay
            $container.find('.loading-overlay').remove();
            $('.error-message').remove();
            
            // Add the loading overlay
            $container.append('<div class="loading-overlay"><div class="spinner"></div></div>');
        };
        
        // Handle AJAX errors
        this.handleError = function(message) {
            var $productsGrid = $('[data-ajax-container="true"]');
            
            // Remove loading indicator
            $productsGrid.find('.loading-overlay').remove();
            $productsGrid.find('.error-message').remove();
            
            // Add error message
            $productsGrid.append('<div class="error-message">' + message + '</div>');
            
            // Make sure errors are visible
            if ($productsGrid.find('.product-item').length === 0) {
                $productsGrid.css('min-height', '150px');
            }
            
            // Remove error message after 5 seconds
            setTimeout(function() {
                $('.error-message').fadeOut(function() {
                    $(this).remove();
                    // Reset min-height
                    if ($productsGrid.find('.product-item').length === 0) {
                        $productsGrid.css('min-height', '');
                    }
                });
            }, 5000);
        };
        
        // Scroll to products section
        this.scrollToProducts = function() {
            $('html, body').animate({
                scrollTop: $('#menu-products').offset().top - 100
            }, 500);
        };
        
        // Initialize add to cart buttons
        this.initAddToCartButtons = function() {
            $('.add-to-cart, .add-to-cart-btn').off('click').on('click', function() {
                var $button = $(this);
                var productId = $button.data('product-id') || $button.data('product_id') || $button.attr('data-product-id');
                
                if (!productId) {
                    return;
                }
                
                $.ajax({
                    url: kurowassan_data.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'add_to_cart_ajax',
                        product_id: productId,
                        nonce: kurowassan_data.nonce
                    },
                    beforeSend: function() {
                        $button.addClass('loading').prop('disabled', true);
                        $button.text('');  // Clear text while loading
                    },
                    success: function(response) {
                        $button.removeClass('loading').prop('disabled', false);
                        
                        if (response.success) {
                            // Update cart count
                            $('.cart-count').text(response.data.cart_count);
                            
                            // Show success state
                            $button.addClass('added');
                            $button.text('Added to Cart');
                            
                            // Reset button after 2 seconds
                            setTimeout(function() {
                                $button.removeClass('added');
                                $button.text('Add to Cart');
                            }, 2000);
                        } else {
                            console.error('Error adding to cart:', response.data ? response.data.message : 'Unknown error');
                            self.handleError(response.data && response.data.message ? response.data.message : 'Error adding to cart');
                            $button.text('Add to Cart');
                        }
                    },
                    error: function() {
                        $button.removeClass('loading').prop('disabled', false);
                        $button.text('Add to Cart');
                        self.handleError('Error adding to cart. Please try again.');
                    }
                });
            });
        };
    }
    
    // Initialize on document ready
    $(document).ready(function() {
        var pagination = new KurowassanPagination();
        pagination.init();
    });
    
})(jQuery); 