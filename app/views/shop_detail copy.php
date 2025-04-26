<?php
include_once __DIR__ . '../layout/header.php';
include_once __DIR__ . '../layout/header_content.php';
require_once '../database/config.php';

$sql = "SELECT p.*, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.category_id
        WHERE p.product_id = :id";

?>

<!-- Hero Section Begin -->
<section class="hero hero-normal">
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
                        <div class="hero__search__phone__icon"><i class="fa fa-phone"></i></div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb Section -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2><?php echo htmlspecialchars($product['name_product']); ?></h2>
                    <div class="breadcrumb__option">
                        <a href="/?page=index">Home</a>
                        <a href="#"><?php echo htmlspecialchars($product['category_name'] ?? 'Category'); ?></a>
                        <span><?php echo htmlspecialchars($product['name_product']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Details Section -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="img/product/details/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="img/product/details/<?php echo htmlspecialchars($product['image'] ?? 'default.jpg'); ?>"
                             src="img/product/details/thumb-1.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php echo htmlspecialchars($product['name_product']); ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price">$<?php echo number_format($product['price'], 2); ?></div>
                    <p><?php echo nl2br(htmlspecialchars($product['description'] ?? 'Mô tả không có')); ?></p>
                    <div class="product__details__quantity">
                        <div class="quantity"><div class="pro-qty"><input type="text" value="1"></div></div>
                    </div>
                    <a href="#" class="primary-btn">ADD TO CART</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><b>Availability</b> <span><?php echo htmlspecialchars($product['stock_quantity'] ?? 0); ?> in stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight</b> <span><?php echo htmlspecialchars($product['weight'] ?? 'N/A'); ?> kg</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="related-product">
    <div class="container">
        <div class="section-title related__product__title"><h2>Related Product</h2></div>
        <div class="row">
            <?php
            $relatedStmt = $conn->query("SELECT * FROM products LIMIT 4");
            while ($relatedProduct = $relatedStmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/<?php echo htmlspecialchars($relatedProduct['image'] ?? 'default.jpg'); ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo htmlspecialchars($relatedProduct['name_product']); ?></a></h6>
                            <h5>$<?php echo number_format($relatedProduct['price'], 2); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include_once __DIR__ . '/../layout/footer.php'; ?>
