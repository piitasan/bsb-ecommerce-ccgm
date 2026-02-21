<!-- View: HISTORY PAGE -->

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
                    <a class="nav-link active" href="<?= base_url('history') ?>">
                        <i class="bi bi-clock-history"></i> History
                    </a>
                    <a class="nav-link" href="#">
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
                <h2 class="mb-4">HISTORY</h2>

                <!-- Order History Grid -->
                <div class="row">
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <img src="<?= base_url('assets/images/placeholder.jpg') ?>" class="img-fluid" alt="Product">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h5><?= esc($order['product_name'] ?? 'Lorem ipsum') ?></h5>
                                                <p class="text-muted"><?= esc($order['description'] ?? 'Lorem ipsum') ?></p>
                                                <p class="fw-bold">₱₱₱</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-center text-muted">No order history yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>