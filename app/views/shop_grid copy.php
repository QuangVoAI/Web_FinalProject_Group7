<?php
require_once '../database/config.php';

// Gọi header trước khi xuất HTML
include_once __DIR__ . '/layout/header.php';
include_once __DIR__ . '/layout/header_content.php';

// Lấy danh mục
$stmt = $conn->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kiểm tra có category_id trên URL hay không
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Nếu có chọn danh mục, lọc sản phẩm theo danh mục đó
if ($category_id > 0) {
    $stmt = $conn->prepare(
        "SELECT p.*, pi.image_path
         FROM products p
         LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
         WHERE p.category_id = :category_id
           AND p.is_active = 1
           AND p.is_deleted = 0"
    );
    $stmt->execute(['category_id' => $category_id]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Nếu không chọn danh mục, lấy tất cả sản phẩm
    $stmt = $conn->query(
        "SELECT p.*, pi.image_path
         FROM products p
         LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
         WHERE p.is_active = 1
           AND p.is_deleted = 0"
    );
    $products = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
}
?>

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
                            <li>
                                <a href="?page=shop_grid&category_id=<?php echo $category['category_id']; ?>">
                                    <?php echo htmlspecialchars($category['category_name']); ?>
                                </a>
                            </li>
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

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <?php
                if ($category_id > 0) {
                    // Tìm tên danh mục
                    $categoryName = '';
                    foreach ($categories as $category) {
                        if ($category['category_id'] == $category_id) {
                            $categoryName = $category['category_name'];
                            break;
                        }
                    }
                    echo "<h2>Products in Category: " . htmlspecialchars($categoryName) . "</h2>";
                } else {
                    echo "<h2>All Products</h2>";
                }
                ?>
            </div>
        </div>

        <div class="row product-grid">
            <?php foreach ($products as $product): ?>
                <?php
                $imagePath = $product['image_path'] ?? 'img/product/default.jpg';
                $imagePath = str_replace(' ', '%20', $imagePath);
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 product-item">
                    <div class="product__item">
                        <a href="?page=shop_detail&id=<?php echo $product['product_id']; ?>">
                            <div class="product__item__pic set-bg" data-setbg="<?php echo $imagePath; ?>">
                                <ul class="product__item__pic__hover">
                                    <li><i class="fa fa-heart"></i></li>
                                    <li><i class="fa fa-retweet"></i></li>
                                    <li><i class="fa fa-shopping-cart"></i></li>
                                </ul>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>
                                <a href="?page=shop_detail&id=<?php echo $product['product_id']; ?>">
                                    <?php echo htmlspecialchars($product['name_product'] ?? 'Unknown'); ?>
                                </a>
                            </h6>
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

<!-- Set background for elements with class="set-bg" -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.set-bg').forEach(function (el) {
        var bg = el.getAttribute('data-setbg');
        if (bg) {
            el.style.backgroundImage = 'url(' + bg + ')';
            el.style.backgroundSize = 'cover';
            el.style.backgroundPosition = 'center';
        }
    });
});
</script>

<!-- Custom CSS -->
<style>
.product__item__text h6 a {
    font-weight: bold;
    color: #333;
    transition: all 0.3s ease;
    text-decoration: none;
}
.product__item:hover .product__item__text h6 a {
    color: #ff0000;
}
.product__item {
    transition: all 0.3s ease;
    background: #fff;
    border: 1px solid transparent;
    box-shadow: 0 0 0 rgba(0,0,0,0);
}
.product__item:hover {
    border: 1px solid #ff0000;
    box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
    transform: translateY(-5px);
    background: #f9f9f9;
}
.product__item__pic__hover {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}
.product__item__pic__hover li {
    list-style: none;
}
.product__item__pic__hover li i {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 36px;
    height: 36px;
    background: #fff;
    border-radius: 50%;
    color: #333;
    font-size: 16px;
    transition: all 0.3s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.product__item__pic__hover li i:hover {
    background: #ff0000;
    color: #fff;
}
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
