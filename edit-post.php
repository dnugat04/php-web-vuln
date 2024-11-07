<?php
require_once 'connect-db.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có quyền admin chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT role FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user['role'] !== 'admin') {
    echo "Bạn không có quyền truy cập trang này.";
    exit();
}

// Kiểm tra xem có `post_id` trong URL hay không
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Lấy dữ liệu hiện tại của bài viết từ database
    $sql = "SELECT title, content FROM post WHERE post_id = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Bài viết không tồn tại.";
        exit();
    }
} else {
    echo "Không có bài viết nào được chọn.";
    exit();
}

// Xử lý khi form được gửi đi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];

    // Cập nhật dữ liệu của bài viết trong database
    $sql = "UPDATE post SET title = '$new_title', content = '$new_content' WHERE post_id = $post_id";
    if ($conn->query($sql) === TRUE) {
        echo "Bài viết đã được cập nhật thành công!";
        header("Location: quanly-blog.php"); // Chuyển hướng về trang quản lý blog
        exit();
    } else {
        echo "Lỗi khi cập nhật bài viết: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Bài viết</title>
</head>
<body>
    <h1>Chỉnh sửa Bài viết</h1>
    <form method="POST">
        <label for="title">Tiêu đề:</label><br>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>

        <label for="content">Nội dung:</label><br>
        <textarea name="content" id="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

        <button type="submit">Cập nhật</button>
        <a href="quanly-blog.php">Quay lại</a>
    </form>
</body>
</html>
