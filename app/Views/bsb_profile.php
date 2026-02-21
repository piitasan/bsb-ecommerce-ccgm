<!-- View: PROFILE PAGE -->

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
                    <a class="nav-link" href="<?= base_url('payment-method') ?>">
                        <i class="bi bi-credit-card"></i> Payment Methods
                    </a>
                    <a class="nav-link" href="<?= base_url('security') ?>">
                        <i class="bi bi-gear-fill"></i> Security
                    </a>

                    <hr>

                    <a class="nav-link" href="<?= base_url('support') ?>">
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
                <!-- Profile Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle me-3" style="font-size: 60px;"></i>
                        <h3><?= esc(session()->get('user_name')) ?></h3>
                    </div>
                    <button class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                </div>

                <hr>

                <!-- Personal Information -->
                <h4 class="mb-4">PERSONAL INFORMATION</h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">FIRST NAME</label>
                        <p><?= esc(session()->get('first_name')) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">LAST NAME</label>
                        <p><?= esc(session()->get('last_name')) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">EMAIL ADDRESS</label>
                        <p><?= esc(session()->get('email')) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">PHONE NUMBER</label>
                        <p><?= esc(session()->get('phone_number') ?? 'Not provided') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>