<?php
class HomeController {
    public function index() {
        require_once __DIR__ . '/../views/home.php';
    }

    public function contact() {
        require_once __DIR__ . '/../views/contact.php';
    }

    public function cart() {
        require_once __DIR__ . '/../views/cart.php';
    }
    
    public function checkout() {
        require_once __DIR__ . '/../views/checkout.php';
    }

    public function shop_grid() {
        require_once __DIR__ . '/../views/shop_grid.php';
    }  
    
    public function shop_detail() {
        require_once __DIR__ . '/../views/shop_detail.php';
    } 

    public function signup() {
        require_once __DIR__ . '/../views/signup.php';
    }

    public function login() {
        require_once __DIR__ . '/../views/login.php';
    }

    public function account() { 
        require_once __DIR__ . '/../views/account.php';
    }
    
}
?>