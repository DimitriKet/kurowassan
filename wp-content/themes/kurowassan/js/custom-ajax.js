document.addEventListener("DOMContentLoaded", function () {
    const addToCartBtn = document.querySelector(".add-to-cart-btn");
    const quantityInput = document.querySelector("#product-qty");

    if (addToCartBtn && quantityInput) {
        addToCartBtn.addEventListener("click", function () {
            const productId = addToCartBtn.getAttribute("data-product-id");
            const quantity = quantityInput.value;

            document.getElementById('preloader').style.display = 'block';
            document.querySelector('.loader').style.display = 'block';

            fetch(ajax_params.ajax_url, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    action: "add_to_cart_ajax",
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('.cart-count').textContent = data.data.cart_count;
                }
            })
            .catch(error => console.error("Error: ...", error))
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