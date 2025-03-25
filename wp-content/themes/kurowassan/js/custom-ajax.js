document.addEventListener("DOMContentLoaded", function () {
    const addToCartBtn = document.querySelector(".add-to-cart-btn");
    const quantityInput = document.querySelector("#product-qty");

    if (addToCartBtn && quantityInput) {
        addToCartBtn.addEventListener("click", function () {
            const productId = addToCartBtn.getAttribute("data-product-id") || addToCartBtn.dataset.productId || addToCartBtn.dataset.product_id;
            const quantity = quantityInput.value;

            if (!productId) {
                console.error("Missing product ID");
                return;
            }

            // Show loading state
            addToCartBtn.classList.add('loading');
            addToCartBtn.disabled = true;
            const originalText = addToCartBtn.textContent;
            addToCartBtn.textContent = '';

            document.getElementById('preloader').style.display = 'block';
            document.querySelector('.loader').style.display = 'block';

            fetch(ajax_params.ajax_url, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    action: "add_to_cart_ajax",
                    product_id: productId,
                    quantity: quantity,
                    nonce: ajax_params.nonce
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = data.data.cart_count;
                    }
                    
                    // Show success state
                    addToCartBtn.classList.remove('loading');
                    addToCartBtn.classList.add('added');
                    addToCartBtn.textContent = 'Added to Cart';
                    
                    // Reset button after 2 seconds
                    setTimeout(() => {
                        addToCartBtn.classList.remove('added');
                        addToCartBtn.textContent = originalText;
                        addToCartBtn.disabled = false;
                    }, 2000);
                } else {
                    console.error("Error adding to cart:", data.data ? data.data.message : "Unknown error");
                    addToCartBtn.classList.remove('loading');
                    addToCartBtn.disabled = false;
                    addToCartBtn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                addToCartBtn.classList.remove('loading');
                addToCartBtn.disabled = false;
                addToCartBtn.textContent = originalText;
            })
            .finally(() => {
                document.getElementById('preloader').style.display = 'none';
                document.querySelector('.loader').style.display = 'none';
            });
        });

        document.querySelector(".qty-btn.minus").addEventListener("click", function () {
            let currentQty = parseInt(quantityInput.value);
            if (currentQty > 1) {
                quantityInput.value = currentQty - 1;
            }
        });

        document.querySelector(".qty-btn.plus").addEventListener("click", function () {
            let currentQty = parseInt(quantityInput.value);
            quantityInput.value = currentQty + 1;
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".qty-control").forEach(control => {
        const minusBtn = control.querySelector(".minus");
        const plusBtn = control.querySelector(".plus");
        const qtyInput = control.querySelector(".product-qty");

        minusBtn.addEventListener("click", function () {
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }
        });

        plusBtn.addEventListener("click", function () {
            let currentQty = parseInt(qtyInput.value);
            let maxQty = parseInt(qtyInput.max);
            if (currentQty < maxQty) {
                qtyInput.value = currentQty + 1;
            }
        });
    });
});

// Handle add to cart buttons in product listings
document.addEventListener("DOMContentLoaded", function () {
    // Find all add to cart buttons in listings
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    
    if (addToCartButtons.length > 0) {
        addToCartButtons.forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                
                const productId = button.getAttribute("data-product-id") || button.dataset.productId || button.dataset.product_id;
                
                if (!productId) {
                    console.error("Missing product ID");
                    return;
                }
                
                // Show loading state
                button.classList.add('loading');
                button.disabled = true;
                const originalText = button.textContent;
                button.textContent = '';
                
                fetch(ajax_params.ajax_url, {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({
                        action: "add_to_cart_ajax",
                        product_id: productId,
                        quantity: 1,
                        nonce: ajax_params.nonce
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartCountElement = document.querySelector('.cart-count');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.data.cart_count;
                        }
                        
                        // Show success state
                        button.classList.remove('loading');
                        button.classList.add('added');
                        button.textContent = 'Added to Cart';
                        
                        // Reset button after 2 seconds
                        setTimeout(() => {
                            button.classList.remove('added');
                            button.textContent = originalText;
                            button.disabled = false;
                        }, 2000);
                    } else {
                        console.error("Error adding to cart:", data.data ? data.data.message : "Unknown error");
                        button.classList.remove('loading');
                        button.disabled = false;
                        button.textContent = originalText;
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    button.classList.remove('loading');
                    button.disabled = false;
                    button.textContent = originalText;
                });
            });
        });
    }
});