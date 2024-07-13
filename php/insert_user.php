<?php
$servername = "********";
$port = "******";
$username = "******";
$password = "********";
$dbname = "*******";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 生成哈希密码
$user_password = 'testpassword';
$hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

// 插入用户
$sql = "INSERT INTO users (username, password) VALUES ('testuser', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
