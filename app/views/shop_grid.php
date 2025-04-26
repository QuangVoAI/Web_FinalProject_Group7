<?php
require_once '../database/config.php';

// Gọi header
include_once __DIR__ . '../layout/header.php';
include_once __DIR__ . '../layout/header_content.php';

// Lấy danh mục
$stmt = $conn->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Phân trang
$productsPerPage = 12;
$page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $productsPerPage;

// Lấy category_id
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Lấy sản phẩm
if ($category_id > 0) {
    $stmt = $conn->prepare("
        SELECT p.*, pi.image_path
        FROM products p
        LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
        WHERE p.category_id = :category_id
        AND p.is_active = 1
        AND p.is_deleted = 0
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $conn->prepare("
        SELECT COUNT(*) FROM products
        WHERE category_id = :category_id AND is_active = 1 AND is_deleted = 0
    ");
    $countStmt->execute(['category_id' => $category_id]);
} else {
    $stmt = $conn->prepare("
        SELECT p.*, pi.image_path
        FROM products p
        LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
        WHERE p.is_active = 1
        AND p.is_deleted = 0
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $conn->query("
        SELECT COUNT(*) FROM products
        WHERE is_active = 1 AND is_deleted = 0
    ");
}
$totalProducts = $countStmt->fetchColumn();
$totalPages = ceil($totalProducts / $productsPerPage);
?>

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3" id="category-panel">
                <div class="hero__categories">
                    <div class="hero__categories__all" id="categoryToggle" style="cursor:pointer;">
                        <i class="fa fa-bars"></i>
                        <span>All Departments</span>
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
                                All Departments <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon"><i class="fa fa-phone"></i></div>
                        <div class="hero__search__phone__text">
                            <h5>+84 90 636 4541</h5>
                            <span>Support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
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
            <div class="col-lg-12 text-center">
                <?php
                if ($category_id > 0) {
                    $categoryName = '';
                    foreach ($categories as $category) {
                        if ($category['category_id'] == $category_id) {
                            $categoryName = $category['category_name'];
                            break;
                        }
                    }
                    echo "<h2 class='category-title'>" . htmlspecialchars($categoryName) . "</h2>";
                } else {
                    echo "<h2 class='category-title'>All Products</h2>";
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
                            <h6><a href="?page=shop_detail&id=<?php echo $product['product_id']; ?>">
                                <?php echo htmlspecialchars($product['name_product'] ?? 'Unknown'); ?>
                            </a></h6>
                            <h5>$<?php echo number_format($product['price'] ?? 0.00, 2); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="product__pagination">
            <?php
            $baseLink = "?page=shop_grid";
            if ($category_id > 0) {
                $baseLink .= "&category_id=$category_id";
            }
            if ($page > 1) {
                echo '<a href="' . $baseLink . '&page_num=' . ($page - 1) . '"><i class="fa fa-long-arrow-left"></i></a>';
            }
            $start = max(1, $page - 2);
            $end = min($totalPages, $page + 2);
            for ($i = $start; $i <= $end; $i++) {
                echo '<a href="' . $baseLink . '&page_num=' . $i . '"';
                if ($i == $page) echo ' class="active"';
                echo '>' . $i . '</a>';
            }
            if ($page < $totalPages) {
                echo '<a href="' . $baseLink . '&page_num=' . ($page + 1) . '"><i class="fa fa-long-arrow-right"></i></a>';
            }
            ?>
        </div>

    </div>
</section>

<!-- Scripts -->
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

// 🛠 Hover mở dropdown "All Departments"
document.addEventListener('DOMContentLoaded', function () {
    const categoryToggle = document.getElementById('categoryToggle');
    const categoryPanel = document.getElementById('category-panel');
    if (categoryToggle && categoryPanel) {
        const categoryList = categoryPanel.querySelector('ul');
        categoryToggle.addEventListener('mouseenter', () => {
            categoryList.style.display = 'block';
            categoryToggle.style.background = '#ff0000';
            categoryToggle.style.color = '#fff';
        });
        categoryPanel.addEventListener('mouseleave', () => {
            categoryList.style.display = 'none';
            categoryToggle.style.background = '';
            categoryToggle.style.color = '';
        });
        categoryList.style.display = 'none';
    }
});
</script>

<!-- Custom CSS -->
<style>
/* Tiêu đề All Products hoặc Products in Category */
.category-title {
    font-size: 60px;
    font-weight: bold;
    color: #333;
    margin-bottom: 70px;
    line-height: 1.2;
}
.category-title::after {
    content: "";
    display: block;
    width: 250px;
    height: 3px;
    background: #ff0000;
    margin: 10px auto 0;
}

/* Sản phẩm */
.product__item {
    background: #fff;
    border: 1px solid #eee;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 20px 15px;
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

.product__item:hover {
    border: 1px solid #ff0000;
    box-shadow: 0px 12px 24px rgba(0,0,0,0.2);
    transform: translateY(-8px) scale(1.02);
    background: #fafafa;
}

.product__item__pic {
    width: 100%;
    height: 300px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    transition: transform 0.5s ease;
}

.product__item:hover .product__item__pic {
    transform: scale(1.05);
}

.product__item__pic__hover {
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
    width: auto;
}

.product__item:hover .product__item__pic__hover {
    bottom: 15px;
    opacity: 1;
}

.product__item__pic__hover li {
    list-style: none;
}

.product__item__pic__hover li i {
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

.product__item__pic__hover li i:hover {
    background: #ff0000;
    color: #fff;
    transform: scale(1.2) rotate(15deg);
}

.product__item__text {
    margin-top: 15px;
    text-align: center;
}

.product__item__text h6 a {
    font-size: 17px;
    font-weight: bold;
    color: #333;
    text-decoration: none;
    transition: color 0.4s ease;
}

.product__item__text h6 a:hover {
    color: #ff0000;
}

.product__item__text h5 {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    margin-top: 8px;
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

/* Hero Section Search Phone */
.hero__search__phone {
    display: flex;
    align-items: center;
    gap: 10px;
}

.hero__search__phone__icon {
    width: 50px;
    height: 50px;
    background: #f5f5f5;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero__search__phone__icon i {
    color: #f7941d;
    font-size: 20px;
}

/* 🛠 Pagination căn giữa cực đẹp */
.product__pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 50px;
    gap: 8px;
}

.product__pagination a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 1px solid #ccc;
    color: #333;
    font-weight: bold;
    border-radius: 6px;
    transition: all 0.3s;
    text-decoration: none;
    font-size: 16px;
}

.product__pagination a.active {
    background: #ff0000;
    color: #fff;
    border-color: #ff0000;
}

.product__pagination a:hover {
    background: #ff0000;
    color: #fff;
    border-color: #ff0000;
}
</style>

<?php include_once __DIR__ . '../layout/footer.php'; ?>
