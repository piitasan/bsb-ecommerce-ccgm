<!-- View: SIGN-IN PAGE -->

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
        <h3>WELCOME BACK!</h3>
    </div>

    <form action="<?= base_url('bsb_signin') ?>" method="post">
        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">USERNAME</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">PASSWORD</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                <button class="btn" type="button" onclick="togglePassword()">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="mb-3 d-flex justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    remember me?
                </label>
            </div>
            <a href="<?= base_url('forgot-password') ?>">forgot password?</a>
        </div>

        <!-- Social Login -->
        <div class="text-center mb-3">
            <p>or</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#"><img src="<?= base_url('assets/images/google-icon.png') ?>" alt="Google" width="40"></a>
                <a href="#"><img src="<?= base_url('assets/images/facebook-icon.png') ?>" alt="Facebook" width="40"></a>
            </div>
        </div>

        <!-- Login Button -->
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </div>

        <!-- Signup Link -->
        <div class="text-center">
            <p>Not registered yet? <a href="<?= base_url('bsb_signup') ?>">Create an account</a></p>
        </div>
    </form>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
}
</script>