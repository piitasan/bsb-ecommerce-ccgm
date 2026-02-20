<!-- View: SIGN-UP PAGE -->

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session('errors')): ?>
    <div class="alert alert-danger">
        <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1>BYTE-SIZED BAKES</h1>
        <h3>JOIN US!</h3>
    </div>

    <form action="<?= base_url('bsb_signup') ?>" method="post">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <!-- Full Name -->
                <div class="mb-3">
                    <label class="form-label">FULL NAME</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="first_name" placeholder="First name" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
                        </div>
                    </div>
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label for="user_name" class="form-label">USERNAME</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Create username" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <!-- Create Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">CREATE PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                        <button class="btn" type="button" onclick="togglePassword('password')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    <small class="text-muted">Must be at least 8 characters</small>
                </div>

                <!-- Re-enter Password -->
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">RE-ENTER PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
                        <button class="btn" type="button" onclick="togglePassword('confirm_password')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Login -->
        <div class="text-center mb-3">
            <p>or</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#"><img src="<?= base_url('assets/images/google-icon.png') ?>" alt="Google" width="40"></a>
                <a href="#"><img src="<?= base_url('assets/images/facebook-icon.png') ?>" alt="Facebook" width="40"></a>
            </div>
        </div>

        <!-- Create Account Button -->
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary">CREATE ACCOUNT</button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p>Already have an account? <a href="<?= base_url('bsb_signin') ?>">Login</a></p>
        </div>
    </form>
</div>

<script>
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
}
</script>