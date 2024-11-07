<h1>Thông tin người dùng</h1>
<?php
session_start();
//var_dump($_SESSION['user_id']);
//    exit();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lấy thông tin người dùng từ cơ sở dữ liệu
require_once 'connect-db.php';
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user= $result->fetch_assoc();
} else {
    echo "Không tìm thấy thông tin người dùng.";
    exit();
}
// Tạo Full Name từ First Name và Last Name
//$full_name = $user['fname'] . ' ' . $user['lname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Người Dùng</title>
</head>
<body>
    <p>ID: <?php echo htmlspecialchars($user['id']); ?></p>
    <!--<p>Họ và Tên: <?php echo htmlspecialchars($full_name); ?></p>  *BỎ*-->
    <p>Tên đăng nhập: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Ngày sinh: <?php echo htmlspecialchars($user['ngay']); ?></p>
    <p>Giới tính: <?php echo htmlspecialchars($user['gender']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

    <a href="reset-pwd.php">Update Password</a><br>
    <a href="#">Update Avatar</a><br>
    <a href="logout.php">Đăng xuất</a>
</body>
</html> 