<?php
include 'connect-db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    // Kiểm tra người dùng đã tồn tại
    $checkUser = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "Tên người dùng đã tồn tại!";
    } else {
        // Thêm người dùng mới mà không mã hóa mật khẩu
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, ngay, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $email, $dob, $gender);

        if ($stmt->execute()) {
            echo "Đăng ký thành công!";
            header("Location: login.php");
            exit();
        } else {
            echo "Lỗi: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Ký</title>
</head>
<body>
<!-- tạo 1 form đăng kí bằng HTML-->
 <form method="POST" action="register.php">
    <label for="fname"> First Name: </label> <br>
    <input type="text" id="fname" name="fname"><br>
    
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname"><br>
    
    <label for="username">User name:</label><br>
    <input type="text" id="username" name="username"><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>

    <label for="email">Email: </label><br>
    <input type="text" id="email" name="email"><br>

    <label>Giới Tính:</label><br>
    <input type="radio" id="male" name="gender" value="Nam">
    <label for="male">Nam</label><br>
    
    <input type="radio" id="female" name="gender" value="Nữ">
    <label for="female">Nữ</label><br><br>
    
    <label for="date">Ngày - Tháng - Năm Sinh</label>
    <input type="date" id="date" name="date"> <br>

    <input type="submit" value="Đăng Ký">
 </form>
 
</body>
</html>