<?php
require_once 'connect-db.php';
session_start();

// Lấy ID của bài viết từ URL
$id = $_GET['id'];
$sql = "SELECT * FROM post WHERE post_id = $id";
$post = $conn->query($sql)->fetch_assoc();

// Kiểm tra nếu bài viết không tồn tại
if (!$post) {
    echo "Bài viết không tồn tại.";
    exit();
}

// Lấy thông tin người dùng của bài viết
$user_id = $post['user_id'];
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$user = $conn->query($sql_user)->fetch_assoc();

// Lấy các bình luận của bài viết và thông tin người dùng của từng bình luận
$sql_comments = "SELECT comments.content, comments.date, users.username 
                 FROM comments 
                 JOIN users ON comments.user_id = users.id 
                 WHERE comments.post_id = $id 
                 ORDER BY comments.date DESC";
$comments = $conn->query($sql_comments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><?php echo htmlspecialchars($post['content']); ?></p>
    <p>Posted by: <?php echo htmlspecialchars($user['username']); ?> on <?php echo htmlspecialchars($post['date']); ?></p>
    <hr>

    <h3>Bình luận:</h3>
    <?php
    if ($comments->num_rows > 0) {
        while ($comment = $comments->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($comment['username']) . "</strong>: " . htmlspecialchars($comment['content']) . " - " . htmlspecialchars($comment['date']) . "</p>";
        }
    } else {
        echo "<p>Chưa có bình luận nào.</p>";
    }
    ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="add-comment.php" method="post">
            <textarea name="comment" required></textarea>
            <input type="hidden" name="post_id" value="<?php echo $id; ?>">
            <button type="submit">Gửi bình luận</button>
        </form>
    <?php else: ?>
        <p>Vui lòng <a href="login.php">đăng nhập</a> để bình luận.</p>
    <?php endif; ?>
</body>
</html>
