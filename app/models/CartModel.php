<?php
class CartModel {
    public function addToCart($productId) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 1;
        } else {
            $_SESSION['cart'][$productId]++;
        }
    }

    public function getCartItems() {
        return $_SESSION['cart'] ?? [];
    }

    public function clearCart() {
        $_SESSION['cart'] = [];
    }
}