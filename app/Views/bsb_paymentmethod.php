<!-- View: PAYMENT METHODS PAGE -->

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
                    <a class="nav-link" href="<?= base_url('wishlist') ?>">
                        <i class="bi bi-heart-fill"></i> Wishlist
                    </a>
                    <a class="nav-link active bg-warning" href="<?= base_url('payment-method') ?>">
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
                <h2 class="mb-4">PAYMENT METHODS</h2>
                
                <hr>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- Add Payment Method Form -->
                <form action="<?= base_url('payment-method/add') ?>" method="post" class="mb-4">
                    <div class="card p-4 mb-3">
                        <h5>Add New Payment Method</h5>
                        
                        <!-- Payment Method Type -->
                        <div class="mb-3">
                            <input type="radio" name="method_type" value="credit_card" checked> Credit Card
                            <input type="radio" name="method_type" value="gcash"> GCash
                            <input type="radio" name="method_type" value="paypal"> PayPal
                        </div>

                        <!-- Credit Card Fields -->
                        <input type="text" class="form-control mb-2" name="card_number" placeholder="Card Number">
                        <input type="text" class="form-control mb-2" name="card_name" placeholder="Name on Card">
                        <input type="text" class="form-control mb-2" name="expiry_date" placeholder="MM/YY">
                        <input type="text" class="form-control mb-2" name="cvv" placeholder="CVV">

                        <div class="mb-3">
                            <input type="checkbox" name="is_default" id="is_default">
                            <label for="is_default">Set as default</label>
                        </div>

                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </form>

                <!-- Saved Payment Methods -->
                <h5 class="mt-4">Saved Payment Methods</h5>
                <hr>

                <?php if (!empty($payment_methods)): ?>
                    <?php foreach ($payment_methods as $method): ?>
                        <div class="card mb-3 p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong><?= ucfirst(str_replace('_', ' ', $method['method_type'])) ?></strong>
                                    <?php if ($method['method_type'] === 'credit_card'): ?>
                                        <p><?= $paymentMethodModel->getMaskedCardNumber($method['card_number']) ?></p>
                                    <?php endif; ?>
                                    <?php if ($method['is_default']): ?>
                                        <span class="badge bg-success">Default</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div>
                                    <?php if (!$method['is_default']): ?>
                                        <a href="<?= base_url('payment-method/set-default/' . $method['payment_method_id']) ?>" 
                                           class="btn btn-sm btn-primary">Set Default</a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('payment-method/delete/' . $method['payment_method_id']) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete?')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No payment methods saved yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>