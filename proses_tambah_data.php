<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ambil data dari formulir
$id_siswa = $_POST['id_siswa'];
$nama_siswa = $_POST['nama_siswa'];
$jenis_tinggal = $_POST['jenis_tinggal'];
$alat_transportasi = $_POST['alat_transportasi'];
$penerima_KPS = $_POST['penerima_KPS'];
$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
$penghasilan_ayah = $_POST['penghasilan_ayah'];
$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
$penghasilan_ibu = $_POST['penghasilan_ibu'];
$penerima_KIP = $_POST['penerima_KIP'];
$penerima_KKS = $_POST['penerima_KKS'];
$keterangan = $_POST['keterangan'];

// cek apakah id_mahasiswa sudah ada di database
$id_check_query = "SELECT * FROM data_training WHERE id_siswa='$id_siswa' LIMIT 1";
$id_check_result = mysqli_query($conn, $id_check_query);
$id_exists = mysqli_fetch_assoc($id_check_result);

// cek apakah nama_mahasiswa sudah ada di database
$nama_check_query = "SELECT * FROM data_training WHERE nama_siswa='$nama_siswa' LIMIT 1";
$nama_check_result = mysqli_query($conn, $nama_check_query);
$nama_exists = mysqli_fetch_assoc($nama_check_result);

// Cek apakah data dengan field-field lainnya sudah ada di database
$duplicate_check_query = "SELECT * FROM data_training WHERE 
                          jenis_tinggal='$jenis_tinggal' AND
                          alat_transportasi='$alat_transportasi' AND
                          penerima_KPS='$penerima_KPS' AND
                          pekerjaan_ayah='$pekerjaan_ayah' AND
                          penghasilan_ayah='$penghasilan_ayah' AND
                          pekerjaan_ibu='$pekerjaan_ibu' AND
                          penghasilan_ibu='$penghasilan_ibu' AND
                          penerima_KIP='$penerima_KIP' AND
                          penerima_KKS='$penerima_KKS' AND
                          keterangan='$keterangan'
                          LIMIT 1";

$duplicate_check_result = mysqli_query($conn, $duplicate_check_query);

if ($duplicate_check_result && mysqli_num_rows($duplicate_check_result) > 0) {
    $duplicate_exists = mysqli_fetch_assoc($duplicate_check_result);
    // Tangani jika duplikat ditemukan, misalnya menampilkan pesan atau melakukan tindakan lain
} else {
    $duplicate_exists = false;
    // Tangani jika tidak ada duplikat, misalnya melanjutkan proses penyimpanan data baru
}

if ($id_exists) {
    echo "<script>alert('NISN siswa sudah ada di database. Silakan gunakan NISN Mahasiswa yang berbeda.');</script>";
    echo "<script>window.location.href='datatraining.php#formTambah';</script>";
} elseif ($nama_exists) {
    echo "<script>alert('Nama Mahasiswa sudah ada di database. Silakan gunakan Nama Mahasiswa yang berbeda.');</script>";
    echo "<script>window.location.href='datatraining.php#formTambah';</script>";
} elseif ($duplicate_exists) {
    echo "<script>alert('Data dengan field-field lainnya sudah ada di database. Silakan masukkan data dengan setidaknya satu field yang berbeda.');</script>";
    echo "<script>window.location.href='datatraining.php#formTambah';</script>";
} else {
    // query untuk menyimpan data ke database
    $query = "INSERT INTO data_training (id_siswa, nama_siswa, jenis_tinggal, alat_transportasi, penerima_KPS, pekerjaan_ayah, penghasilan_ayah, pekerjaan_ibu, penghasilan_ibu, penerima_KIP, penerima_KKS, keterangan) 
              VALUES ('$id_siswa', '$nama_siswa', '$jenis_tinggal', '$alat_transportasi', '$penerima_KPS', '$pekerjaan_ayah', '$penghasilan_ayah', '$pekerjaan_ibu', '$penghasilan_ibu', '$penerima_KIP', '$penerima_KKS', '$keterangan')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil disimpan');</script>";
        echo "<script>window.location.href='datatraining.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// tutup koneksi
mysqli_close($conn);
