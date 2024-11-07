<?php
require_once 'connect-db.php';
session_start();

if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $sql = "DELETE FROM comments WHERE comment_id = $comment_id";
    $conn->query($sql);
}

header("Location: quanly-blog.php");
exit();
?>
