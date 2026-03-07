<!-- View: SHOPPING CART PAGE -->

<style>
    .cart-container {
        background: linear-gradient(to bottom, 
            rgba(232, 196, 184, 0.3) 0%, 
            rgba(245, 230, 211, 0.3) 50%, 
            rgba(232, 196, 184, 0.3) 100%);
        min-height: 100vh;
        padding: 40px 0;
    }

    .cart-header {
        color: #5A8F8F;
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-items-container {
        background: rgba(139, 111, 71, 0.15);
        border-radius: 20px;
        padding: 40px;
        max-height: 75vh;
        overflow-y: auto;
    }

    .cart-items-container::-webkit-scrollbar {
        width: 12px;
    }

    .cart-items-container::-webkit-scrollbar-track {
        background: rgba(139, 111, 71, 0.1);
        border-radius: 10px;
    }

    .cart-items-container::-webkit-scrollbar-thumb {
        background: rgba(139, 111, 71, 0.4);
        border-radius: 10px;
    }

    .cart-items-container::-webkit-scrollbar-thumb:hover {
        background: rgba(139, 111, 71, 0.6);
    }

    .cart-item-card {
        background: rgba(255, 249, 240, 0.9);
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .cart-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(139, 111, 71, 0.2);
    }

    .cart-item-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        background: rgba(139, 111, 71, 0.1);
    }

    .cart-item-details {
        padding: 20px;
    }

    .product-name {
        color: #5A8F8F;
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .product-category {
        color: #8B6F47;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .product-price {
        color: #8B4513;
        font-weight: bold;
        font-size: 1.3rem;
        margin-bottom: 15px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        background: rgba(184, 212, 212, 0.3);
        border-radius: 25px;
        padding: 8px 15px;
    }

    .quantity-btn {
        background: rgba(139, 111, 71, 0.2);
        border: none;
        color: #5A8F8F;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .quantity-btn:hover {
        background: rgba(139, 111, 71, 0.4);
        transform: scale(1.1);
    }

    .quantity-value {
        font-weight: bold;
        color: #5A8F8F;
        min-width: 30px;
        text-align: center;
        font-size: 1.1rem;
    }

    .delete-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #8B4513;
        font-size: 1.5rem;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
    }

    .delete-icon:hover {
        color: #D2691E;
        transform: scale(1.2);
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        color: #8B6F47;
    }

    .empty-cart i {
        font-size: 5rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .checkout-summary {
        background: rgba(255, 249, 240, 0.9);
        border-radius: 20px;
        padding: 30px;
        margin-top: 30px;
        text-align: right;
    }

    .total-label {
        color: #5A8F8F;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .total-amount {
        color: #8B4513;
        font-size: 2rem;
        font-weight: bold;
    }

    .checkout-btn {
        background: linear-gradient(135deg, #5A8F8F 0%, #B8D4D4 100%);
        color: white;
        border: none;
        padding: 15px 50px;
        border-radius: 25px;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(90, 143, 143, 0.3);
    }
</style>

<div class="cart-container">
    <div class="container">
        <!-- Cart Header -->
        <div class="cart-header">
            <i class="bi bi-cart-fill"></i>
            SHOPPING CART: <span style="text-decoration: underline;"><?= count($cart_items) ?></span>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Cart Items -->
        <?php if (!empty($cart_items)): ?>
            <div class="cart-items-container">
                <div class="row g-4">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="col-md-6">
                            <div class="cart-item-card position-relative">
                                <!-- Delete Icon -->
                                <a href="<?= base_url('cart/remove/' . $item['cart_id']) ?>" 
                                   class="delete-icon"
                                   onclick="return confirm('Remove this item from cart?')">
                                    <i class="bi bi-trash-fill"></i>
                                </a>

                                <!-- Product Image -->
                                <img src="<?= base_url('uploads/products/' . $item['image_url']) ?>" 
                                     class="cart-item-image" 
                                     alt="<?= esc($item['product_name']) ?>"
                                     onerror="this.src='<?= base_url('assets/images/no-image.png') ?>'">

                                <!-- Product Details -->
                                <div class="cart-item-details">
                                    <div class="product-name"><?= esc($item['product_name']) ?></div>
                                    <div class="product-category"><?= esc($item['product_category']) ?></div>
                                    <div class="product-price">₱ ₱ ₱</div>

                                    <!-- Quantity Control -->
                                    <div class="quantity-control">
                                        <button class="quantity-btn" onclick="updateQuantity(<?= $item['cart_id'] ?>, <?= $item['quantity'] - 1 ?>)">
                                            -
                                        </button>
                                        <span class="quantity-value" id="quantity-<?= $item['cart_id'] ?>"><?= $item['quantity'] ?></span>
                                        <button class="quantity-btn" onclick="updateQuantity(<?= $item['cart_id'] ?>, <?= $item['quantity'] + 1 ?>)">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Checkout Summary -->
            <div class="checkout-summary">
                <div class="mb-3">
                    <span class="total-label">TOTAL: </span>
                    <span class="total-amount">₱<?= number_format($cart_total, 2) ?></span>
                </div>
                <button class="checkout-btn" onclick="proceedToCheckout()">
                    PROCEED TO CHECKOUT
                </button>
            </div>
        <?php else: ?>
            <!-- Empty Cart -->
            <div class="cart-items-container">
                <div class="empty-cart">
                    <i class="bi bi-cart-x"></i>
                    <h3>Your cart is empty</h3>
                    <p>Add some items to get started!</p>
                    <a href="<?= base_url('/') ?>" class="btn btn-lg mt-3" 
                       style="background: linear-gradient(135deg, #5A8F8F 0%, #B8D4D4 100%); color: white; border-radius: 25px; padding: 12px 40px;">
                        Continue Shopping
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Update quantity
function updateQuantity(cartId, newQuantity) {
    if (newQuantity < 1) {
        if (confirm('Remove this item from cart?')) {
            window.location.href = '<?= base_url('cart/remove/') ?>' + cartId;
        }
        return;
    }

    fetch('<?= base_url('cart/update-quantity') ?>', {
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
            document.getElementById('quantity-' + cartId).textContent = newQuantity;
            // Reload the page to update total
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

// Proceed to checkout
function proceedToCheckout() {
    // You can implement checkout logic here
    alert('Checkout functionality will be implemented next!');
}

// Add to cart from other pages
function addToCart(productId, quantity = 1) {
    fetch('<?= base_url('cart/add') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId + '&quantity=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Optionally update cart count in header
        } else {
            alert(data.message);
            if (data.message === 'Please login first') {
                window.location.href = '<?= base_url('bsb_signin') ?>';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}
</script>
