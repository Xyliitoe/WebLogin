<?php
session_start();
$servername = "localhost";
$port = "*******";
$username = "web***in";
$password = "*********";
$dbname = "web***in";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: ./zhongzhuan.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}

$conn->close();
?>
