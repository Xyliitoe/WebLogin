<?php
$servername = "****";
$username = "***";
$password = "*******";
$dbname = "*******";
$port = "***********";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
echo "连接成功";

// 关闭连接
$conn->close();
?>