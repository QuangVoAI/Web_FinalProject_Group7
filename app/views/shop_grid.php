<?php
require_once '../database/config.php';

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once __DIR__ . '/layout/header.php'; ?>
<?php include_once __DIR__ . '/layout/header_content.php'; ?>

<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3" id="category-panel">
                <div class="hero__categories">
                    <div class="hero__categories__all" id="categoryToggle" style="cursor:pointer;">
                        <i class="fa fa-bars"></i>
                        <span>Product Categories</span>
                    </div>
                    <ul>
                        <?php foreach ($categories as $category): ?>
                            <li><a href="#"><?php echo htmlspecialchars($category['category_name']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9" id="product-panel">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon"><i class="fa fa-phone"></i></div>
                        <div class="hero__search__phone__text">
                            <h5>028 2008 1888</h5>
                            <span>Support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Beezy Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="?page=index">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row product-grid">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 product-item">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo htmlspecialchars($product['name_product'] ?? 'Unknown'); ?></a></h6>
                            <h5>$<?php echo number_format($product['price'] ?? 0.00, 2); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="product__pagination">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
        </div>
    </div>
</section>
<!-- Product Section End -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById('categoryToggle');
    const productPanel = document.getElementById('product-panel');

    toggleBtn.addEventListener('click', function () {
        productPanel.classList.toggle('compact');
    });
});
</script>

<style>
    .product-grid {
        display: flex;
        flex-wrap: wrap;
    }
    .product-item {
        width: 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    #product-panel.compact .product-item {
        width: 33.33%;
        flex: 0 0 33.33%;
        max-width: 33.33%;
    }
</style>

<?php include_once __DIR__ . '/layout/footer.php'; ?>
