<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Memeriksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
