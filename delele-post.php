<?php
require_once 'connect-db.php';
session_start();

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $sql = "DELETE FROM post WHERE post_id = $post_id";
    $conn->query($sql);
}

header("Location: quanly-blog.php");
exit();
?>
