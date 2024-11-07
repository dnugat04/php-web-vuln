<?php
require_once 'connect-db.php';
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Lấy thông tin người dùng từ database
$user_id = $_SESSION['user_id'];
$sql = "SELECT role FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$is_admin = ($user['role'] === 'admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Blog</title>
</head>
<body>
    <h1>Đây là trang để quản lý blog</h1>

    <?php if ($is_admin): ?>
        <h2>Chức năng quản lý dành cho Admin</h2>

        <!-- Hiển thị tất cả các bài viết và bình luận -->
        <?php
        // Lấy danh sách các bài đăng
        $sql_posts = "SELECT post_id, user_id, title, content, date FROM post";
        $result_posts = $conn->query($sql_posts);

        if ($result_posts->num_rows > 0) {
            while ($post = $result_posts->fetch_assoc()) {
                echo "<div>";
                echo "<h3>" . ($post['title']) . "</h3>";
                echo "<p>" . htmlspecialchars($post['content']) . "</p>";
                echo "<p>Ngày đăng: " . $post['date'] . "</p>";

                // Hiển thị các tùy chọn của Admin
                echo "<a href='edit-post.php?post_id=" . $post['post_id'] . "'>Chỉnh sửa</a> | ";
                echo "<a href='delete-post.php?post_id=" . $post['post_id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bài này không?\");'>Xóa bài</a>";

                // Hiển thị bình luận cho bài đăng
                $sql_comments = "SELECT comment_id, user_id, content, date FROM comments WHERE post_id = " . $post['post_id'];
                $result_comments = $conn->query($sql_comments);

                if ($result_comments->num_rows > 0) {
                    echo "<h4>Bình luận:</h4>";
                    while ($comment = $result_comments->fetch_assoc()) {
                        echo "<p>" . htmlspecialchars($comment['content']) . " - " . $comment['date'] . "</p>";
                        // Tùy chọn xóa bình luận
                        echo "<a href='delete-comment.php?comment_id=" . $comment['comment_id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bình luận này không?\");'>Xóa bình luận</a>";
                    }
                } else {
                    echo "<p>Không có bình luận nào.</p>";
                }
                echo "</div><hr>";
            }
        } else {
            echo "<p>Không có bài viết nào.</p>";
        }
        ?>
    <?php else: ?>
        <!-- Form đăng bài chỉ dành cho user -->
        <h2>Đăng bài mới</h2>
        <form action="post-blog.php" method="POST">
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" required><br>
            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" rows="5" required></textarea><br>
            <button type="submit">Đăng bài</button>
        </form>
    <?php endif; ?>
</body>
</html>
