<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Khởi động session
session_start();

// Định nghĩa hằng số cho đường dẫn
define('BASE_PATH', dirname(__DIR__));

// Include file khởi tạo ứng dụng
require_once BASE_PATH . '/app/controllers/HomeController.php';

// Lấy tham số từ URL
$page = isset($_GET['page']) ? $_GET['page'] : 'index';

// Khởi tạo controller
$controller = new HomeController();

// Gọi phương thức tương ứng
switch ($page) {
    case 'contact':
        $controller->contact();
        break;
    case 'cart':
        $controller->cart();
        break;
    case 'checkout': 
        $controller->checkout();
        break;
    case 'shop_grid':
        $controller->shop_grid();
        break;
    case 'shop_detail':
        $controller->shop_detail();
        break;
    case 'login':
        $controller->login();
        break;
    case 'signup':
        $controller->signup();
        break;
    case 'account': 
        $controller->account();
        break;
    case 'logout': 
        session_destroy();
        header("Location: index.php?page=index");
        exit();
    case 'index':
    default:
        $controller->index();
        break;
}
?>