<?php
session_start(); // Bắt đầu phiên làm việc
session_destroy(); // Hủy session
header("Location: index.php"); // Chuyển hướng về trang chủ
exit(); // Dừng thực thi mã
?>
