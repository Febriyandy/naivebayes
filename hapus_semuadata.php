<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pip");

// query untuk menghapus semua data dari tabel data_training
$queryHapusSemuaData = "DELETE FROM data_training";
$resultHapusSemuaData = mysqli_query($conn, $queryHapusSemuaData);

if ($resultHapusSemuaData) {
    // Redirect kembali ke halaman datatraining.php setelah menghapus data
    header("Location: datatraining.php");
    exit();
} else {
    // Tampilkan pesan kesalahan jika terjadi masalah saat menghapus data
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($conn);
?>
