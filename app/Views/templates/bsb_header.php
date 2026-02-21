<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - BSB' : 'BSB E-Commerce' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body style="margin: 0; padding: 0; overflow-x: hidden;">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg" style="background: linear-gradient(to right, #E8C4B8 0%, #F5E6D3 50%, #E8C4B8 100%); padding: 15px 40px;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/images/bsb-logo.png') ?>" alt="BSB Logo" style="height: 60px;">
        </a>

        <!-- Search Bar -->
        <form class="d-flex mx-auto" style="width: 400px;">
            <input class="form-control" type="search" placeholder="Search" style="border-radius: 25px; border: 2px solid #8B6F47; background-color: #FFF9F0;">
            <button class="btn ms-2" type="submit" style="background-color: #8B6F47; color: white; border-radius: 50%; width: 45px; height: 45px;">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <!-- Navigation Links -->
        <div class="d-flex align-items-center">
            <a class="nav-link mx-3" href="<?= base_url('/') ?>" style="color: white; font-weight: bold; font-size: 1.2rem;">HOME</a>
            <a class="nav-link mx-3" href="<?= base_url('about') ?>" style="color: white; font-weight: bold; font-size: 1.2rem;">ABOUT</a>
            <a class="nav-link mx-3" href="<?= base_url('shop') ?>" style="color: white; font-weight: bold; font-size: 1.2rem;">SHOP</a>

            <!-- Icons -->
            <a href="<?= base_url('wishlist') ?>" class="mx-2">
                <i class="bi bi-heart-fill" style="color: #8B4513; font-size: 1.8rem;"></i>
            </a>
            <a href="<?= base_url('cart') ?>" class="mx-2">
                <i class="bi bi-cart-fill" style="color: #8B4513; font-size: 1.8rem;"></i>
            </a>

            <!-- Login/Signup or Profile -->
            <?php if (session()->get('isLoggedIn')): ?>
                <div class="dropdown ms-3">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" style="border-radius: 20px; background-color: #B8D4D4; border: none;">
                        <i class="bi bi-person-circle"></i> <?= esc(session()->get('user_name')) ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('history') ?>">History</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('wishlist') ?>">Wishlist</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('signout') ?>">Sign Out</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="<?= base_url('bsb_signin') ?>" class="btn ms-2 px-4 py-2" style="background-color: #B8D4D4; color: #5A8F8F; border-radius: 20px; border: none; font-weight: bold;">LOGIN</a>
                <a href="<?= base_url('bsb_signup') ?>" class="btn ms-2 px-4 py-2" style="background-color: #B8D4D4; color: #5A8F8F; border-radius: 20px; border: none; font-weight: bold;">SIGNUP</a>
            <?php endif; ?>
        </div>
    </div>
</nav>