<?php
// Kiểm tra xem form đã được submit hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
 // Kết hợp First Name và Last Name
    $fullName = $fname . " " . $lname;

 // Hiển thị dữ liệu
 echo "<h2>Thông tin bạn vừa nhập:</h2>";
 echo "Họ và Tên: " . ($fullName) . "<br>";
 echo "Username: " . ($username) . "<br>";
 echo "Password: " . ($password) . "<br>";
 echo "Email: " . ($email) . "<br>";
 echo "Ngày sinh: " . ($date) . "<br>";
 echo "Giới tính: " . ($gender) . "<br>"; // Hiển thị giới tính
}
?>
<!--form đăng nhập an toàn  -->
<?php
session_start();
include 'connect-db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu
        if ($password === $user['password']) { // Thay bằng password_verify() nếu mật khẩu được mã hóa
            // Lưu thông tin người dùng vào session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'fullname' => $user['username'], // Giả sử cột fullname là 'username' (có thể đổi lại)
                'username' => $user['username'],
                'dob' => $user['ngay'],
                'gender' => $user['gender'],
                'email' => $user['email']
            ];

            // Đăng nhập thành công, chuyển hướng đến trang thông tin
            header("Location: info.php");
            exit();
        } else {
            echo "Mật khẩu không đúng!";
        }
    } else {
        echo "Tên người dùng không tồn tại!";
    }

    $stmt->close();
    $conn->close();
}
?>
<?php
require_once 'connect-db.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
    exit();
}
//Lấy thông tin post từ cơ sở dữ liệu
$sql = "SELECT * FROM post";
$result = $conn->query($sql);

if($result->num_rows >0){
    $post = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p> Titile <?php echo ($post['title']);?> </p>
    <p> Content <?php echo ($post['content']);?> </p>
</body>
</html>