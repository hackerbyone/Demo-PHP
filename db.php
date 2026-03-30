<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "myWeb";

// Tạo kết nối
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}
?>