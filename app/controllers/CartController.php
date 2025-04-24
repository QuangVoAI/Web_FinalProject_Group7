<?php
require_once 'app/models/CartModel.php';
require_once 'app/models/ProductModel.php';

class CartController {
    public function add($id) {
        $cart = new CartModel();
        $cart->addToCart($id);
        header("Location: ?controller=cart&action=view");
    }

    public function view() {
        $cart = new CartModel();
        $items = $cart->getCartItems();
        $productModel = new ProductModel();
        $products = [];
        foreach ($items as $id => $qty) {
            $p = $productModel->getProductById($id);
            if ($p) {
                $p['qty'] = $qty;
                $products[] = $p;
            }
        }
        require 'app/views/cart.php';
    }

    public function clear() {
        $cart = new CartModel();
        $cart->clearCart();
        header("Location: ?controller=cart&action=view");
    }
}