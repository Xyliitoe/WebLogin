<?php
$servername = "*******";
$port = "******";
$username = "******";
$password = "********";
$dbname = "***********";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 假设这是一个新用户注册脚本
$newUsername = 'newuser';
$newPassword = 'newuserpasswd';

// 生成密码哈希
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// 插入新用户
$sql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    echo "New user created successfully";
} else {
    echo "Error creating user: " . $conn->error;
}

$conn->close();
?>
