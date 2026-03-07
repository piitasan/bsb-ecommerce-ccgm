// Shopping Cart JavaScript Functions

// Add product to cart
function addToCart(productId, quantity = 1) {
    // Get base URL from the page
    const baseUrl = document.querySelector('meta[name="base-url"]')?.content || window.location.origin;
    
    fetch(baseUrl + '/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId + '&quantity=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showCartNotification(data.message, 'success');
            // Update cart count if element exists
            updateCartCount();
        } else {
            showCartNotification(data.message, 'error');
            // Redirect to login if needed
            if (data.message === 'Please login first') {
                setTimeout(() => {
                    window.location.href = baseUrl + '/bsb_signin';
                }, 1500);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showCartNotification('An error occurred. Please try again.', 'error');
    });
}

// Update quantity in cart
function updateQuantity(cartId, newQuantity) {
    const baseUrl = document.querySelector('meta[name="base-url"]')?.content || window.location.origin;
    
    if (newQuantity < 1) {
        if (confirm('Remove this item from cart?')) {
            window.location.href = baseUrl + '/cart/remove/' + cartId;
        }
        return;
    }

    fetch(baseUrl + '/cart/update-quantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'cart_id=' + cartId + '&quantity=' + newQuantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the quantity display
            const quantityElement = document.getElementById('quantity-' + cartId);
            if (quantityElement) {
                quantityElement.textContent = newQuantity;
            }
            // Reload the page to update total
            location.reload();
        } else {
            showCartNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showCartNotification('An error occurred. Please try again.', 'error');
    });
}

// Show notification
function showCartNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Update cart count in header
function updateCartCount() {
    const baseUrl = document.querySelector('meta[name="base-url"]')?.content || window.location.origin;
    
    fetch(baseUrl + '/cart/count')
        .then(response => response.json())
        .then(data => {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement && data.count !== undefined) {
                cartCountElement.textContent = data.count;
                if (data.count > 0) {
                    cartCountElement.style.display = 'inline';
                }
            }
        })
        .catch(error => console.error('Error updating cart count:', error));
}

// Initialize cart functionality on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
