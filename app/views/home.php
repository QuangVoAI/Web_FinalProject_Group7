<?php
include_once __DIR__ . '/layout/header.php';
include_once __DIR__ . '/layout/header_content.php';
require_once '../database/config.php';

// Lấy danh mục từ bảng categories
$stmt = $conn->query("SELECT * FROM categories WHERE parent_id IS NULL");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy sản phẩm từ bảng products
$stmt = $conn->query("SELECT * FROM products WHERE is_active = 1 AND is_deleted = 0 ORDER BY product_id DESC LIMIT 8");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Latest product
$stmt = $conn->query("SELECT * FROM products WHERE is_active = 1 AND is_deleted = 0 ORDER BY product_updated DESC LIMIT 3");
$latestProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Top rated products (dựa theo sold_quantity)
$stmt = $conn->query("SELECT * FROM products WHERE is_active = 1 AND is_deleted = 0 ORDER BY sold_quantity DESC LIMIT 3");
$topRatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Review products (ngẫu nhiên 3 sản phẩm)
$stmt = $conn->query("SELECT * FROM products WHERE is_active = 1 AND is_deleted = 0 ORDER BY RAND() LIMIT 3");
$reviewProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Page Preloder -->
<div id="preloder"><div class="loader"></div></div>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <?php foreach ($categories as $category): ?>
                            <li><a href="#"><?php echo htmlspecialchars($category['category_name']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories 
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>090 636 4541</h5>
                            <span>Support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span>FRUIT FRESH</span>
                        <h2>Vegetable <br />100% Organic</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="#" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Products</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg"
                             data-setbg="img/product/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo htmlspecialchars($product['name_product']); ?></a></h6>
                            <h5>$<?php echo number_format($product['price'], 2); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <?php
            $productGroups = [
                'Latest Products' => $latestProducts,
                'Top Rated Products' => $topRatedProducts,
                'Review Products' => $reviewProducts
            ];

            foreach ($productGroups as $title => $group): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4><?= $title ?></h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <?php foreach ($group as $product): ?>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="img/product/<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?= htmlspecialchars($product['name_product']) ?></h6>
                                            <span>$<?= number_format($product['price'], 2) ?></span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<?php include_once __DIR__ . '/layout/footer.php'; ?>
