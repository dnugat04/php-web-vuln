<?php
// db.php
$servername = "localhost"; // Thay đổi nếu server khác
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL (nếu có)
$database = "demo_web"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>