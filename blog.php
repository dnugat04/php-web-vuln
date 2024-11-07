<!--Không cần đăng nhập vẫn đọc được blog, nhưng phải đăng nhập thì mới comment được-->
<?php
require_once 'connect-db.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}

// Lấy tất cả bài post từ cơ sở dữ liệu
$sql = "SELECT * FROM post ORDER BY date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <h1>Danh sách các bài post</h1>
    <?php
    if ($result->num_rows > 0) {
        // Duyệt qua từng bài post và hiển thị
        while ($post = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>Title: " . htmlspecialchars($post['title']) . "</h2>";
            echo "<p>Content: " . htmlspecialchars($post['content']) . "</p>";
            echo "<p>Posted on: " . htmlspecialchars($post['date']) . "</p>";
            echo "<a href='blog-detail.php?id=" . $post['post_id'] . "'>Xem chi tiết</a>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>Không có bài post nào.</p>";
    }
    ?>
</body>
</html>
