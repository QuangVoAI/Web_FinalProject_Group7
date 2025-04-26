<?php
// Kiểm tra trạng thái đăng nhập
$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user']['username'] : '';
?>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="/"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right">
            <div class="header__top__right__social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="header__top__right__auth">
                <?php if ($isLoggedIn): ?>
                    <span><?php echo htmlspecialchars($username); ?></span>
                    <span class="auth-divider"> | </span>
                    <a href="?page=account" class="auth-btn">My Account</a>
                    <span class="auth-divider"> | </span>
                    <a href="?page=logout" class="auth-btn logout-btn">Logout</a>
                <?php else: ?>
                    <a href="?page=login" class="auth-btn login-btn"><i class="fa fa-user"></i> Login</a>
                    <span class="auth-divider"> | </span>
                    <a href="?page=signup" class="auth-btn signup-btn"><i class="fa fa-user"></i> Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="?page=shop_grid">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="?page=shop_detail">Shop Details</a></li>
                    <li><a href="?page=cart">Shopping Cart</a></li>
                    <li><a href="?page=checkout">Check Out</a></li>
                </ul>
            </li>
            <li><a href="?page=contact">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> iamBeezy@gmail.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <!-- Top Bar -->
    <div class="header__top" style="background: #f5f5f5;">
        <div class="container">
            <div class="header__top__wrapper" style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0;">
                <div class="header__top__left" style="display: flex; align-items: center; gap: 20px;">
                    <div class="topbar-item" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-envelope"></i> <span>iamBeezy@gmail.com</span>
                    </div>
                    <div class="topbar-item" style="border-left: 1px solid #ccc; padding-left: 15px; margin-left: 10px;">
                        Free Shipping for all Order of $99
                    </div>
                </div>

                <div class="header__top__right" style="display: flex; align-items: center; gap: 15px;">
                    <div class="header__top__right__social" style="display: flex; gap: 10px;">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                    <div class="header__top__right__auth" style="display: flex; align-items: center; gap: 8px;">
                        <?php if ($isLoggedIn): ?>
                            <span><?php echo htmlspecialchars($username); ?></span>
                            <span>|</span>
                            <a href="?page=account">My Account</a>
                            <span>|</span>
                            <a href="?page=logout" class="logout-btn">Logout</a>
                        <?php else: ?>
                            <a href="?page=login"><i class="fa fa-user"></i> Login</a>
                            <span>|</span>
                            <a href="?page=signup"><i class="fa fa-user"></i> Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo + Menu + Cart -->
    <div class="container">
        <div class="row align-items-center" style="align-items: center;">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul style="display: flex; gap: 30px; justify-content: center;">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="?page=shop_grid">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="?page=shop_detail">Shop Details</a></li>
                                <li><a href="?page=cart">Shopping Cart</a></li>
                                <li><a href="?page=checkout">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="?page=contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart" style="display: flex; align-items: center; justify-content: flex-end; gap: 15px;">
                    <ul style="display: flex; gap: 10px;">
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>$150.00</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="humberger__open">
        <i class="fa fa-bars"></i>
    </div>
</header>
<!-- Header Section End -->
