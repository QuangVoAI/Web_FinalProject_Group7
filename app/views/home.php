<?php
include_once __DIR__ . '../layout/header.php';
include_once __DIR__ . '../layout/header_content.php';
require_once '../database/config.php';

// Lấy danh mục từ bảng categories
$stmt = $conn->query("SELECT * FROM categories WHERE parent_id IS NULL");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy sản phẩm từ bảng products kèm ảnh thumbnail
$stmt = $conn->query("
    SELECT p.*, pi.image_path
    FROM products p
    LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
    WHERE p.is_active = 1 AND p.is_deleted = 0
    ORDER BY p.product_id DESC
    LIMIT 8
");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Latest product
$stmt = $conn->query("
    SELECT p.*, pi.image_path
    FROM products p
    LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
    WHERE p.is_active = 1 AND p.is_deleted = 0
    ORDER BY p.product_updated DESC
    LIMIT 3
");
$latestProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Top rated products
$stmt = $conn->query("
    SELECT p.*, pi.image_path
    FROM products p
    LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
    WHERE p.is_active = 1 AND p.is_deleted = 0
    ORDER BY p.sold_quantity DESC
    LIMIT 3
");
$topRatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Review products (ngẫu nhiên)
$stmt = $conn->query("
    SELECT p.*, pi.image_path
    FROM products p
    LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
    WHERE p.is_active = 1 AND p.is_deleted = 0
    ORDER BY RAND()
    LIMIT 3
");
$reviewProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Departments</span>
                    </div>
                    <ul class="hero__categories__list">
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="?page=shop_grid&category_id=<?= urlencode($category['category_id']); ?>">
                                    <?= htmlspecialchars($category['category_name']); ?>
                                </a>
                            </li>
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
                <?php
                $imagePath = $product['image_path'] ?? '/img/product/default.jpg';
                if (strpos($imagePath, 'img/') !== 0) {
                    $imagePath = 'img/product/' . $imagePath;
                }
                $imagePath = str_replace(' ', '%20', $imagePath);
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="<?= htmlspecialchars($imagePath); ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?= htmlspecialchars($product['name_product']); ?></a></h6>
                            <h5>$<?= number_format($product['price'], 2); ?></h5>
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
                                    <?php
                                    $imagePath = $product['image_path'] ?? '/img/product/default.jpg';
                                    if (strpos($imagePath, 'img/') !== 0) {
                                        $imagePath = 'img/product/' . $imagePath;
                                    }
                                    $imagePath = str_replace(' ', '%20', $imagePath);
                                    ?>
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?= htmlspecialchars($imagePath); ?>" alt="">
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
<style>
/* ===== Tiêu đề Featured Products và Latest Products... Giữ nguyên size ===== */
.section-title,
.latest-product__text {
    text-align: center;
}

.section-title h2,
.latest-product__text h4 {
    position: relative;
    display: block;
    padding-bottom: 1px;
    margin-bottom: 30px;
    font-weight: bold;
    color: #333;
}

.section-title h2::after,
.latest-product__text h4::after {
    content: "";
    display: block;
    margin: 10px auto 0;
    width: 100px;
    height: 3px;
    background-color: #ff0000;
}

/* ===== Sản phẩm Featured ===== */
.featured__item {
    background: #fff;
    border: 1px solid #eee;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 20px 15px;
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

.featured__item:hover {
    border: 1px solid #ff0000;
    box-shadow: 0px 12px 24px rgba(0,0,0,0.2);
    transform: translateY(-8px) scale(1.02);
    background: #fafafa;
}

.featured__item__pic {
    width: 100%;
    height: 300px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    transition: transform 0.5s ease;
}

.featured__item:hover .featured__item__pic {
    transform: scale(1.05);
}

.featured__item__pic__hover {
    position: absolute;
    bottom: -50px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    opacity: 0;
    transition: all 0.5s ease;
}

.featured__item:hover .featured__item__pic__hover {
    bottom: 15px;
    opacity: 1;
}

.featured__item__pic__hover li {
    list-style: none;
}

.featured__item__pic__hover li i {
    width: 44px;
    height: 44px;
    background: #fff;
    color: #333;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    font-size: 18px;
}

.featured__item__pic__hover li i:hover {
    background: #ff0000;
    color: #fff;
    transform: scale(1.2) rotate(15deg);
}

.featured__item__text {
    margin-top: 15px;
    text-align: center;
}

.featured__item__text h6 a {
    font-size: 17px;
    font-weight: bold;
    color: #333;
    text-decoration: none;
    transition: color 0.4s ease;
}

.featured__item__text h6 a:hover {
    color: #ff0000;
}

.featured__item__text h5 {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    margin-top: 8px;
}

/* Layout Featured */
.featured__filter {
    display: flex;
    flex-wrap: wrap;
}

.featured__filter .mix {
    width: 25%;
    flex: 0 0 25%;
    max-width: 25%;
    padding: 10px;
}

/* ===== Latest Products, Top Rated, Review Products ===== */
.latest-product__item {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 12px 15px;
    margin-bottom: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    min-height: 140px;
}

.latest-product__item:hover {
    border: 1px solid #ff0000;
    box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
    background: #fafafa;
}

.latest-product__item__pic {
    width: 120px;
    height: 120px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 10px;
    overflow: hidden;
    margin-right: 10px;
    flex-shrink: 0;
}

.latest-product__item__pic img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.latest-product__item__text {
    flex: 1;
}

.latest-product__item__text h6 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin: 0;
    line-height: 1.4;
    transition: color 0.4s ease;
}

.latest-product__item__text h6:hover {
    color: #ff0000;
}

.latest-product__item__text span {
    display: block;
    margin-top: 6px;
    font-size: 17px;
    color: #000;
    font-weight: bold;
}
</style>

<?php include_once __DIR__ . '/layout/footer.php'; ?>
