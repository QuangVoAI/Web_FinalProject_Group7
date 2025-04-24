<?php
// Sửa đường dẫn gọi đến file config.php
require_once __DIR__ . '/../../config/config.php';

class ProductModel {
    private $conn;

    public function __construct() {
        // Nếu bạn có kết nối DB trong config.php thì dùng global
        global $conn;
        $this->conn = $conn;
    }

    public function getAllProducts() {
        // Dữ liệu mẫu, có thể thay bằng truy vấn từ CSDL nếu cần
        return [
            ['id' => 1, 'name' => 'Áo thun nam', 'price' => 150000],
            ['id' => 2, 'name' => 'Giày thể thao', 'price' => 850000],
            ['id' => 3, 'name' => 'Túi xách nữ', 'price' => 450000],
        ];
    }
}
?>