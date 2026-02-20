<!-- View: HEADER TEMPLATE -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte-Sized Bakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <img src="<?= base_url('assets/images/logo.png') ?>" alt="BSB Logo">
            </a>

            <!-- Search Bar -->
            <form class="d-flex mx-auto">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                    <button class="btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <!-- Navigation Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('about') ?>">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('shop') ?>">SHOP</a>
                </li>
            </ul>

            <!-- Icons and Buttons -->
            <div class="d-flex align-items-center">
                <a href="<?= base_url('wishlist') ?>" class="nav-link">
                    <i class="bi bi-heart-fill"></i>
                </a>
                <a href="<?= base_url('cart') ?>" class="nav-link">
                    <i class="bi bi-cart-fill"></i>
                </a>
                <?php if (session()->get('logged_in')): ?>
                    <!-- User Profile Icon -->
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('signout') ?>">Sign Out</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Login/Signup Buttons -->
                    <a href="<?= base_url('bsb_signin') ?>" class="btn">SIGN IN</a>
                    <a href="<?= base_url('bsb_signup') ?>" class="btn">SIGN UP</a>
                <?php endif; ?>
            </div>
        </div>

    </nav>
