<?php
require 'vendor/autoload.php'; // Sesuaikan dengan path Composer autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "beasiswa_nb");

// Query untuk mengambil data dari tabel data_testing
$query = "SELECT * FROM data_testing";
$result = mysqli_query($conn, $query);

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'NISN Siswa');
$sheet->setCellValue('C1', 'Nama Siswa');
$sheet->setCellValue('D1', 'Jenis Tinggal');
$sheet->setCellValue('E1', 'Alat Transportasi');
$sheet->setCellValue('F1', 'Penerima KPS');
$sheet->setCellValue('G1', 'Pekerjaan Ayah');
$sheet->setCellValue('H1', 'Penghasilan Ayah/Bulan');
$sheet->setCellValue('I1', 'Pekerjaan Ibu');
$sheet->setCellValue('J1', 'Penghasilan Ibu/Bulan');
$sheet->setCellValue('K1', 'Penerima KIP');
$sheet->setCellValue('L1', 'Penerima KKS');
$sheet->setCellValue('M1', 'Keterangan');

// Data dari database
$no = 1;
$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $no);
    $sheet->setCellValue('B' . $rowNumber, $row['id_siswa']);
    $sheet->setCellValue('C' . $rowNumber, $row['nama_siswa']);
    $sheet->setCellValue('D' . $rowNumber, $row['jenis_tinggal']);
    $sheet->setCellValue('E' . $rowNumber, $row['alat_transportasi']);
    $sheet->setCellValue('F' . $rowNumber, $row['penerima_KPS']);
    $sheet->setCellValue('G' . $rowNumber, $row['pekerjaan_ayah']);
    $sheet->setCellValue('H' . $rowNumber, $row['penghasilan_ayah']);
    $sheet->setCellValue('I' . $rowNumber, $row['pekerjaan_ibu']);
    $sheet->setCellValue('J' . $rowNumber, $row['penghasilan_ibu']);
    $sheet->setCellValue('K' . $rowNumber, $row['penerima_KIP']);
    $sheet->setCellValue('L' . $rowNumber, $row['penerima_KKS']);
    $sheet->setCellValue('M' . $rowNumber, $row['keterangan']);

    $no++;
    $rowNumber++;
}
// Simpan ke file Excel
$writer = new Xlsx($spreadsheet);
$writer->save('Data_Testing.xlsx');

// Set header untuk file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Data_Testing.xlsx"');
header('Cache-Control: max-age=0');

// Output file Excel ke browser
$writer->save('php://output');
