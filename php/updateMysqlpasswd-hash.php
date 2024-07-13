<?php
$servername = "*****";
$port = "****";
$username = "*******";
$password = "********";
$dbname = "********";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 假设我们只有一个用户，用户名为 'admin'
$username = 'admin';
$plainPassword = 'adminpasswd'; // 原始明文密码

// 生成密码哈希
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// 更新数据库中的密码
$sql = "UPDATE users SET password='$hashedPassword' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

$conn->close();
?>
