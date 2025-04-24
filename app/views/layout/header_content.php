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
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> iamBeezy@gmail.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
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
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
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
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>$150.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->