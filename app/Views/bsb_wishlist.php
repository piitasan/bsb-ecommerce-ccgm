<!-- View: WISHLIST PAGE -->

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card p-3">
                <!-- User Info -->
                <div class="text-center mb-3">
                    <i class="bi bi-person-circle" style="font-size: 60px;"></i>
                    <h5><?= esc(session()->get('user_name')) ?></h5>
                    <small><?= esc(session()->get('email')) ?></small>
                </div>

                <hr>

                <!-- Navigation Menu -->
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= base_url('history') ?>">
                        <i class="bi bi-clock-history"></i> History
                    </a>
                    <a class="nav-link active bg-warning" href="<?= base_url('wishlist') ?>">
                        <i class="bi bi-heart-fill"></i> Wishlist
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-credit-card"></i> Payment Methods
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear-fill"></i> Security
                    </a>

                    <hr>

                    <a class="nav-link" href="#">
                        <i class="bi bi-chat-dots"></i> Customer Support
                    </a>
                    <a class="nav-link" href="<?= base_url('signout') ?>">
                        <i class="bi bi-box-arrow-right"></i> Log out
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card p-4">
                <h2 class="mb-4">WISHLIST</h2>
                
                <hr>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Wishlist Items Grid -->
                <div class="row g-4">
                    <?php if (!empty($wishlist_items)): ?>
                        <?php foreach ($wishlist_items as $item): ?>
                            <div class="col-md-6">
                                <div class="card h-100 position-relative">
                                    <!-- Heart Icon -->
                                    <div class="position-absolute top-0 start-0 p-3" style="z-index: 10;">
                                        <a href="<?= base_url('wishlist/remove/' . $item['product_id']) ?>" 
                                           class="text-danger" 
                                           style="font-size: 32px;"
                                           onclick="return confirm('Remove this item from wishlist?')">
                                            <i class="bi bi-heart-fill"></i>
                                        </a>
                                    </div>

                                    <div class="row g-0">
                                        <!-- Product Image -->
                                        <div class="col-md-5">
                                            <img src="<?= base_url('uploads/products/' . $item['product_image']) ?>" 
                                                 class="img-fluid rounded-start h-100 object-fit-cover" 
                                                 alt="<?= esc($item['product_name']) ?>"
                                                 onerror="this.src='<?= base_url('assets/images/no-image.png') ?>'">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="col-md-7">
                                            <div class="card-body d-flex flex-column h-100">
                                                <h5 class="card-title"><?= esc($item['product_name']) ?></h5>
                                                <p class="card-text text-muted small mb-2">
                                                    <?= esc($item['category']) ?>
                                                </p>
                                                <p class="card-text fw-bold text-success fs-5 mt-auto">
                                                    ₱<?= number_format($item['price'], 2) ?>
                                                </p>
                                                
                                                <!-- Add to Cart Button -->
                                                <button class="btn btn-warning w-100 mt-2" 
                                                        onclick="addToCart(<?= $item['product_id'] ?>)">
                                                    <i class="bi bi-cart-plus"></i> ADD TO CART
                                                </button>

                                                <!-- View Product Button -->
                                                <a href="<?= base_url('product/' . $item['product_id']) ?>" 
                                                   class="btn btn-outline-secondary w-100 mt-2">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Empty Wishlist -->
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bi bi-heart text-muted" style="font-size: 80px;"></i>
                                <h4 class="mt-3 text-muted">Your wishlist is empty</h4>
                                <p class="text-muted">Start adding items you love!</p>
                                <a href="<?= base_url('products') ?>" class="btn btn-warning mt-3">
                                    Browse Products
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addToCart(productId) {
    fetch('<?= base_url('cart/add') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Added to cart!');
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>