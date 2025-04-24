<?php
// Định nghĩa các hằng số
define('HOST', 'localhost');
define('DATABASE', 'online_shopping');
define('USERNAME', 'root');
define('PASSWORD', '');

// Cố gắng kết nối đến cơ sở dữ liệu bằng PDO
try {
    // Tạo kết nối PDO
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USERNAME, PASSWORD);
    // Cấu hình PDO để ném ra lỗi khi có vấn đề
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công!";
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
?>
