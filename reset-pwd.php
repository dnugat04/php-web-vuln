<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script>
        function redirect() {
            setTimeout(function() {
                window.location.href = "index.php"; // Chuyển hướng đến trang index.php
            }, 3000); // Thời gian chờ 3 giây
        }
    </script>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="reset-pwd.php">
        <label for="old_password">Mật khẩu cũ:</label><br>
        <input type="password" id="old_password" name="old_password" required><br>

        <label for="new_password">Mật khẩu mới:</label><br>
        <input type="password" id="new_password" name="new_password" required><br>

        <label for="confirm_password">Xác nhận mật khẩu mới:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" name="change_password" value="Đổi mật khẩu">
    </form>
</body>
</html>

<?php
    require_once 'connect-db.php'; // Chèn tập tin PHP trong tập tin khác
    // Kiểm tra phiên đăng nhập
    session_start();
    //var_dump($_SESSION['user_id']);
    //exit();
    if (!isset($_SESSION['user_id'])) {
        header('Location:login.php');
        exit;
    }
    $user_id = $_SESSION['user_id'];
    
    // Xử lý thay đổi mật khẩu
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Lấy password cũ để đối sánh
        $sql = "SELECT password FROM users WHERE id = '$user_id'";
        $result = $conn->query($sql);

        // Kiểm tra xem truy vấn có trả về kết quả không
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();  
        }

        // Đối sánh mật khẩu cũ người dùng nhập trong CSDL
        if ($old_password == $row['password']) {
            if ($old_password == $new_password) {
                $message = "Mật khẩu mới không được trùng với mật khẩu cũ!";
                exit;
            } else if ($new_password == $confirm_password) {
                $sql = "UPDATE users SET password = '$new_password' WHERE id = '$user_id'";
                $conn->query($sql);
                $message = "Mật khẩu đã được thay đổi!";
            } else {
                $message = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
            }
        } else {
            $message = "Mật khẩu cũ không đúng!";
        }

        if (isset($message)) {
            echo "<p>$message</p>";
            echo "<script>redirect();</script>"; // Gọi hàm redirect() sau khi in thông báo
        }
    }
?>