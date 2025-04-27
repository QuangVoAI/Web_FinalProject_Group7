<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../database/config.php';
include_once __DIR__ . '../layout/header.php';
include_once __DIR__ . '../layout/header_content.php';

// Lấy user_id
$userId = $_SESSION['user_id'];

// Lấy cart_id
$stmt = $conn->prepare("SELECT cart_id FROM cart WHERE user_id = :user_id");
$stmt->execute(['user_id' => $userId]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

// Nếu chưa có cart, tạo mới
if (!$cart) {
    $stmt = $conn->prepare("INSERT INTO cart (user_id, cart_created) VALUES (:user_id, NOW())");
    $stmt->execute(['user_id' => $userId]);
    $cartId = $conn->lastInsertId();
} else {
    $cartId = $cart['cart_id'];
}

// Lấy sản phẩm trong cart
$stmt = $conn->prepare("
    SELECT ci.cart_item_id, ci.quantity, ci.price_added, ci.discount_price, 
           p.name_product AS product_name,
           pi.image_path
    FROM cart_items ci
    LEFT JOIN products p ON ci.product_id = p.product_id
    LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.thumbnail = b'1'
    WHERE ci.cart_id = :cart_id
");
$stmt->execute(['cart_id' => $cartId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tính tổng
$subtotal = 0;
foreach ($cartItems as $item) {
    $price = $item['discount_price'] ?? $item['price_added'];
    $subtotal += $price * $item['quantity'];
}
?>

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="update_cart.php" method="post">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($cartItems)): ?>
                                    <tr><td colspan="5" style="text-align:center;">Your cart is empty.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($cartItems as $item): 
                                        $price = $item['discount_price'] ?? $item['price_added'];
                                        $imagePath = $item['image_path'] ?? 'img/default.jpg'; // ảnh mặc định nếu chưa có
                                    ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="">
                                            <h5><?php echo htmlspecialchars($item['product_name']); ?></h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            $<?php echo number_format($price, 2); ?>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="hidden" name="cart_item_id[]" value="<?php echo $item['cart_item_id']; ?>">
                                                    <input type="number" name="quantity[]" value="<?php echo $item['quantity']; ?>" min="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            $<?php echo number_format($price * $item['quantity'], 2); ?>
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="remove_cart_item.php?id=<?php echo $item['cart_item_id']; ?>"><span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="shoping__cart__btns">
                        <a href="/?page=index" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <button type="submit" class="primary-btn cart-btn cart-btn-right" style="border:none;">
                            <span class="icon_loading"></span> Update Cart
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>$<?php echo number_format($subtotal, 2); ?></span></li>
                        <li>Total <span>$<?php echo number_format($subtotal, 2); ?></span></li>
                    </ul>
                    <a href="/?page=checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<?php include_once __DIR__ . '../layout/footer.php'; ?>
