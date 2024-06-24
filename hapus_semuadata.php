<?php
// koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// query untuk menghapus semua data dari tabel data_training
$queryHapusSemuaData = "DELETE FROM data_training";
$resultHapusSemuaData = mysqli_query($conn, $queryHapusSemuaData);

if ($resultHapusSemuaData) {
    // Redirect kembali ke halaman datatraining.php setelah menghapus data
    header("Location: dataTraining.php");
    exit();
} else {
    // Tampilkan pesan kesalahan jika terjadi masalah saat menghapus data
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($conn);
?>
