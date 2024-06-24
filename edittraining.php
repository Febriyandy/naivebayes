<?php
// koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ambil data training berdasarkan ID yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM data_training WHERE id_siswa = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // jika tidak ada data dengan ID tersebut, redirect ke halaman datatraining.php
        header("Location: datatraining.php");
        exit();
    }
} else {
    // jika tidak ada ID yang dikirimkan, redirect ke halaman datatraining.php
    header("Location: datatraining.php");
    exit();
}

// proses pengeditan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // query untuk mengupdate data training
    $update_query = "UPDATE data_training SET
                    nama_siswa = '$nama_siswa',
                    jenis_tinggal = '$jenis_tinggal',
                    alat_transportasi = '$alat_transportasi',
                    penerima_KPS = '$penerima_KPS',
                    pekerjaan_ayah = '$pekerjaan_ayah',
                    penghasilan_ayah = '$penghasilan_ayah',
                    pekerjaan_ibu = '$pekerjaan_ibu',
                    penghasilan_ibu = '$penghasilan_ibu',
                    penerima_KIP = '$penerima_KIP',
                    penerima_KKS = '$penerima_KKS',
                    keterangan = '$keterangan'
                    WHERE id_siswa = $id_siswa";

    if (mysqli_query($conn, $update_query)) {
        // Redirect ke halaman datatraining.php setelah berhasil update
        header("Location: datatraining.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Training</title>
    <link rel="icon" href="image/logo.png" type="">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
<div class="h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 h-4/5 overflow-y-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Data Siswa</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id); ?>" method="POST">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="id_siswa" class="block text-sm font-medium text-gray-700">NISN Siswa</label>
                    <input type="text" name="id_siswa" id="id_siswa" value="<?php echo $row['id_siswa']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required readonly>
                </div>
                <div>
                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                    <input type="text" name="nama_siswa" id="nama_siswa" value="<?php echo $row['nama_siswa']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="jenis_tinggal" class="block text-sm font-medium text-gray-700">Jenis Tinggal</label>
                    <select name="jenis_tinggal" id="jenis_tinggal" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Bersama Orang Tua" <?php echo ($row['jenis_tinggal'] == 'Bersama Orang Tua') ? 'selected' : ''; ?>>Bersama Orang Tua</option>
                        <option value="Panti Asuhan" <?php echo ($row['jenis_tinggal'] == 'Panti Asuhan') ? 'selected' : ''; ?>>Panti Asuhan</option>
                    </select>
                </div>
                <div>
                    <label for="alat_transportasi" class="block text-sm font-medium text-gray-700">Alat Transportasi</label>
                    <select name="alat_transportasi" id="alat_transportasi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Jalan Kaki" <?php echo ($row['alat_transportasi'] == 'Jalan Kaki') ? 'selected' : ''; ?>>Jalan Kaki</option>
                        <option value="Sepeda Motor" <?php echo ($row['alat_transportasi'] == 'Sepeda Motor') ? 'selected' : ''; ?>>Sepeda Motor</option>
                        <option value="Angkutan Umum" <?php echo ($row['alat_transportasi'] == 'Angkutan Umum') ? 'selected' : ''; ?>>Angkutan Umum</option>
                        <option value="Mobil Pribadi" <?php echo ($row['alat_transportasi'] == 'Mobil Pribadi') ? 'selected' : ''; ?>>Mobil Pribadi</option>
                    </select>
                </div>
                <div>
                    <label for="penerima_KPS" class="block text-sm font-medium text-gray-700">Penerima KPS</label>
                    <select name="penerima_KPS" id="penerima_KPS" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Ya" <?php echo ($row['penerima_KPS'] == 'Ya') ? 'selected' : ''; ?>>Ya</option>
                        <option value="Tidak" <?php echo ($row['penerima_KPS'] == 'Tidak') ? 'selected' : ''; ?>>Tidak</option>
                    </select>
                </div>
                <div>
                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                    <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Buruh" <?php echo ($row['pekerjaan_ayah'] == 'Buruh') ? 'selected' : ''; ?>>Buruh</option>
                        <option value="Nelayan" <?php echo ($row['pekerjaan_ayah'] == 'Nelayan') ? 'selected' : ''; ?>>Nelayan</option>
                        <option value="Sudah Meninggal" <?php echo ($row['pekerjaan_ayah'] == 'Sudah Meninggal') ? 'selected' : ''; ?>>Sudah Meninggal</option>
                        <option value="Petani" <?php echo ($row['pekerjaan_ayah'] == 'Petani') ? 'selected' : ''; ?>>Petani</option>
                        <option value="PNS" <?php echo ($row['pekerjaan_ayah'] == 'PNS') ? 'selected' : ''; ?>>PNS</
                        <option value="Karyawan Swasta" <?php echo ($row['pekerjaan_ayah'] == 'Karyawan Swasta') ? 'selected' : ''; ?>>Karyawan Swasta</option>
                        <option value="Tidak Bekerja" <?php echo ($row['pekerjaan_ayah'] == 'Tidak Bekerja') ? 'selected' : ''; ?>>Tidak Bekerja</option>
                        <option value="Pedagang Kecil" <?php echo ($row['pekerjaan_ayah'] == 'Pedagang Kecil') ? 'selected' : ''; ?>>Pedagang Kecil</option>
                    </select>
                </div>
                <div>
                    <label for="penghasilan_ayah" class="block text-sm font-medium text-gray-700">Penghasilan Ayah/Bulan</label>
                    <select name="penghasilan_ayah" id="penghasilan_ayah" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Tidak Berpenghasilan" <?php echo ($row['penghasilan_ayah'] == 'Tidak Berpenghasilan') ? 'selected' : ''; ?>>Tidak Berpenghasilan</option>
                        <option value="Rendah" <?php echo ($row['penghasilan_ayah'] == 'Rendah') ? 'selected' : ''; ?>>Rendah (< 1 juta)</option>
                        <option value="Sedang" <?php echo ($row['penghasilan_ayah'] == 'Sedang') ? 'selected' : ''; ?>>Sedang (1 juta - 2 juta)</option>
                        <option value="Tinggi" <?php echo ($row['penghasilan_ayah'] == 'Tinggi') ? 'selected' : ''; ?>>Tinggi (> 2 juta)</option>
                    </select>
                </div>
                <div>
                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                    <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Sudah Meninggal" <?php echo ($row['pekerjaan_ibu'] == 'Sudah Meninggal') ? 'selected' : ''; ?>>Sudah Meninggal</option>
                        <option value="PNS/Polwan" <?php echo ($row['pekerjaan_ibu'] == 'PNS/Polwan') ? 'selected' : ''; ?>>PNS/Polwan</option>
                        <option value="Karyawan Swasta" <?php echo ($row['pekerjaan_ibu'] == 'Karyawan Swasta') ? 'selected' : ''; ?>>Karyawan Swasta</option>
                        <option value="Tidak Bekerja" <?php echo ($row['pekerjaan_ibu'] == 'Tidak Bekerja') ? 'selected' : ''; ?>>Tidak Bekerja</option>
                        <option value="Pedagang Kecil" <?php echo ($row['pekerjaan_ibu'] == 'Pedagang Kecil') ? 'selected' : ''; ?>>Pedagang Kecil</option>
                    </select>
                </div>
                <div>
                    <label for="penghasilan_ibu" class="block text-sm font-medium text-gray-700">Penghasilan Ibu/Bulan</label>
                    <select name="penghasilan_ibu" id="penghasilan_ibu" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Tidak Berpenghasilan" <?php echo ($row['penghasilan_ibu'] == 'Tidak Berpenghasilan') ? 'selected' : ''; ?>>Tidak Berpenghasilan</option>
                        <option value="Rendah" <?php echo ($row['penghasilan_ibu'] == 'Rendah') ? 'selected' : ''; ?>>Rendah (< 1 juta)</option>
                        <option value="Sedang" <?php echo ($row['penghasilan_ibu'] == 'Sedang') ? 'selected' : ''; ?>>Sedang (1 juta - 2 juta)</option>
                        <option value="Tinggi" <?php echo ($row['penghasilan_ibu'] == 'Tinggi') ? 'selected' : ''; ?>>Tinggi (> 2 juta)</option>
                    </select>
                </div>
                <div>
                    <label for="penerima_KIP" class="block text-sm font-medium text-gray-700">Penerima KIP</label>
                    <select name="penerima_KIP" id="penerima_KIP" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Ya" <?php echo ($row['penerima_KIP'] == 'Ya') ? 'selected' : ''; ?>>Ya</option>
                        <option value="Tidak" <?php echo ($row['penerima_KIP'] == 'Tidak') ? 'selected' : ''; ?>>Tidak</option>
                    </select>
                </div>
                <div>
                    <label for="penerima_KKS" class="block text-sm font-medium text-gray-700">Penerima KKS</label>
                    <select name="penerima_KKS" id="penerima_KKS" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Ya" <?php echo ($row['penerima_KKS'] == 'Ya') ? 'selected' : ''; ?>>Ya</option>
                        <option value="Tidak" <?php echo ($row['penerima_KKS'] == 'Tidak') ? 'selected' : ''; ?>>Tidak</option>
                    </select>
                </div>
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <select name="keterangan" id="keterangan" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Layak" <?php echo ($row['keterangan'] == 'Layak') ? 'selected' : ''; ?>>Layak</option>
                        <option value="Tidak Layak" <?php echo ($row['keterangan'] == 'Tidak Layak') ? 'selected' : ''; ?>>Tidak Layak</option>
                    </select>
                </div>
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan Perubahan</button>
                <a href="datatraining.php" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
