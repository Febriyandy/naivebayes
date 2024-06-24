<?php
// Path harus sesuai dengan lokasi autoload.php di proyek
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses upload file
    $file = $_FILES['file']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $worksheet = $spreadsheet->getActiveSheet();

    // Melewatkan baris pertama (header)
    $isFirstRow = true;

    // Proses membaca data dan menyimpan ke database
    foreach ($worksheet->getRowIterator() as $row) {
        if ($isFirstRow) {
            $isFirstRow = false;
            continue; // Melewatkan baris pertama
        }

        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
        }

        // Mengabaikan kolom "No" jika ada
        array_shift($data);

        // cek apakah data sudah ada di database
        $duplicate_check_query = "SELECT * FROM data_training WHERE 
                                  id_siswa='{$data[0]}' AND
                                  nama_siswa='{$data[1]}' AND
                                  jenis_tinggal='{$data[2]}' AND
                                  alat_transportasi='{$data[3]}' AND
                                  penerima_KPS='{$data[4]}' AND
                                  pekerjaan_ayah='{$data[5]}' AND
                                  penghasilan_ayah='{$data[6]}' AND
                                  pekerjaan_ibu='{$data[7]}' AND
                                  penghasilan_ibu='{$data[8]}' AND
                                  penerima_KIP='{$data[9]}' AND
                                  penerima_KKS='{$data[10]}' AND
                                  keterangan='{$data[11]}'
                                  LIMIT 1";
        $duplicate_check_result = mysqli_query($conn, $duplicate_check_query);
        $duplicate_exists = mysqli_fetch_assoc($duplicate_check_result);

        // menyimpan data ke database jika tidak ada duplikat
        if (!$duplicate_exists) {
            $query = "INSERT INTO data_training (id_siswa, nama_siswa, jenis_tinggal, alat_transportasi, penerima_KPS, pekerjaan_ayah, penghasilan_ayah, pekerjaan_ibu, penghasilan_ibu, penerima_KIP, penerima_KKS, keterangan) 
                      VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}', '{$data[5]}', '{$data[6]}', '{$data[7]}', '{$data[8]}', '{$data[9]}', '{$data[10]}', '{$data[11]}')";
            mysqli_query($conn, $query);
        }
    }

    // Menampilkan alert jika data berhasil diupload
    echo "<script>alert('Data berhasil diupload');</script>";

    // Redirect ke halaman datatraining.php setelah selesai upload
    echo "<script>window.location.href='dataTraining.php';</script>";
    exit();
}
?>
