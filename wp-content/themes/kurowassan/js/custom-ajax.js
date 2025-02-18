
document.addEventListener('DOMContentLoaded', function () {
    const minusBtn = document.querySelector('.qty-btn.minus');
    const plusBtn = document.querySelector('.qty-btn.plus');
    const quantityInput = document.getElementById('product-qty');
    const addToCartBtn = document.querySelector('.add-to-cart-btn');

    minusBtn.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > parseInt(quantityInput.min)) {
            quantityInput.value = currentValue - 1;
        }
    });

    plusBtn.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < parseInt(quantityInput.max)) {
            quantityInput.value = currentValue + 1;
        }
    });

    addToCartBtn.addEventListener('click', function () {
        const productId = addToCartBtn.getAttribute('data-product-id');
        const quantity = quantityInput.value;

        document.getElementById('preloader').style.display = 'block';
        document.querySelector('.loader').style.display = 'block';

        // Send request ajax to add to cart
        fetch(ajax_params.ajax_url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'add_to_cart_ajax',
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.cart-count').textContent = data.data.cart_count; // Update cart's quantity
            }
        })
        .catch(error => console.error('Error:', error))
        .finally(() => {
            document.getElementById('preloader').style.display = 'none';
            document.querySelector('.loader').style.display = 'none';
        });
    });
});
