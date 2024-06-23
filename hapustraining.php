<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Periksa apakah parameter id diberikan
if (isset($_GET['id'])) {
    $id_training = $_GET['id'];

    // Query hapus data
    $query = "DELETE FROM data_training WHERE id_siswa = $id_training";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika berhasil dihapus, arahkan ke halaman datatraining.php
        header("Location: datatraining.php");
        exit();
    } else {
        echo "Gagal menghapus data. Silakan coba lagi.";
    }
} else {
    echo "ID tidak valid.";
}
