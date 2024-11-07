<?php
require_once 'connect-db.php';
session_start();

// Kiểm tra nếu người dùng đã đăng nhập và có bình luận
if (isset($_POST['comment']) && isset($_SESSION['user_id']) && isset($_POST['post_id'])) {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    // Truy vấn để thêm bình luận vào cơ sở dữ liệu
    $sql = "INSERT INTO comments (content, date, user_id, post_id) VALUES ('$comment', NOW(), $user_id, $post_id)";
    $conn->query($sql);

    // Chuyển hướng quay lại trang bài viết
    header("Location: blog-detail.php?id=" . $post_id);
    exit();
} else {
    // Nếu không có phiên người dùng hoặc không có bình luận, chuyển hướng tới trang đăng nhập
    header("Location: login.php");
    exit();
}
