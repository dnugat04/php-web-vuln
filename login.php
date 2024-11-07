<?php
session_start();
include 'connect-db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['user_id'] = $row['id'];
       // var_dump($_SESSION['user_id']);
        //exit();
        header("Location: index.php");
        exit();
    } else {
        echo "Thông tin đăng nhập sai";
    }
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
    <form method="POST" action="login.php">
      <label for="username"> Username: </label> <br>
        <input type="text" id="username" name="username"> <br>

        <label for="passwd">Password: </label> <br>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>

