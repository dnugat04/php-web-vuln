<?php
require_once 'connect-db.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Kiểm tra xem có dữ liệu từ form gửi đến không
if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $date = date("Y-m-d H:i:s");

    // Truy vấn thêm bài đăng vào cơ sở dữ liệu
    $sql = "INSERT INTO post (user_id, title, content, date) VALUES ($user_id, '$title', '$content', '$date')";

    // Thực hiện truy vấn và kiểm tra lỗi
    if ($conn->query($sql) === TRUE) {
        // Lấy tên người dùng từ session
        $username = $_SESSION['username']; // Đảm bảo đã lưu `username` khi đăng nhập
        echo "<script>alert('Bài viết đã được đăng bởi $username thành công!');</script>";
        echo "<script>window.location.href = 'index.php';</script>"; // Chuyển hướng về trang quản lý blog
        exit();
    } else {
        echo "Lỗi khi đăng bài: " . $conn->error;
    }
} else {
    echo "Dữ liệu không hợp lệ!";
}
?>
