<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pip");

// ambil data training berdasarkan ID yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM data_training WHERE id_siswa = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    // Redirect jika ID tidak tersedia
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
                    id_siswa = '$id_siswa',
                    nama_siswa = '$nama_siswa',
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
                    WHERE id_siswa = $id";

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

<div id="formEdit" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 h-4/5 overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
    <!-- Form Edit Data -->
        <div class="mb-4">
            <label for="id_siswa" class="block text-sm font-medium text-gray-700">NISN Siswa</label>
            <input type="text" name="id_siswa" id="id_siswa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        <div class="mb-4">
            <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
            <input type="text" name="nama_siswa" id="nama_siswa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
        <div class="mb-4">
                <label for="jenis_tinggal">Jenis Tinggal</label>
                <select name="jenis_tinggal" id="jenis_tinggal" required>
                    <option value="Ada" <?php echo ($row['jenis_tinggal'] == 'Bersama Orang Tua') ? 'selected' : ''; ?>>Bersama Orang Tua</option>
                    <option value="Tidak Ada" <?php echo ($row['jenis_tinggal'] == 'Panti Asuhan') ? 'selected' : ''; ?>>Panti Asuhan</option>
                </select>
            </div>
        <div class="mb-4">
                <label for="alat_transportasi" class="block text-sm font-medium text-gray-700">Alat Transportasi</label>
                <select name="alat_transportasi" id="alat_transportasi"required>
                    <option value="Jalan Kaki" <?php echo($row['alat_transportasi'] == 'Jalan Kaki') ? 'selected' : '' ; ?>>Jalan Kaki</option>
                    <option value="Sepeda Motor" <?php echo($row['alat_transportasi'] == 'Sepeda Motor') ? 'selected' : '' ; ?>>Sepeda Motor</option>
                    <option value="Angkutan Umum" <?php echo($row['alat_transportasi'] == 'Angkutan Umum') ? 'selected' : '' ; ?>>Angkutan Umum</option>
                    <option value="Mobil Pribadi" <?php echo($row['alat_transportasi'] == 'Mobil Pribadi') ? 'selected' : '' ; ?>>Mobil Pribadi</option>
                </select>
            </div>
        <div class="mb-4">
            <label for="penerima_KPS" class="block text-sm font-medium text-gray-700">Penerima KPS</label>
            <select name="penerima_KPS" id="penerima_KPS" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="Ya" <?php echo($row['penerima_KPS'] == 'Ya') ? 'selected' : '' ; ?>>Ya</option>
                <option value="Tidak"<?php echo($row['penerima_KPS'] == 'Tidak') ? 'selected' : '' ; ?>>Tidak</option>
                </select>
            </div>
        <div class="mb-4">
            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
            <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="Buruh" <?php echo($row['pekerjaan_ayah'] == 'Buruh') ? 'selected' : '' ; ?>>Buruh</option>
                <option value="Nelayan" <?php echo($row['pekerjaan_ayah'] == 'Nelayan') ? 'selected' : '' ; ?>>Nelayan</option>
                <option value="Sudah Meninggal" <?php echo($row['pekerjaan_ayah'] == 'Sudah Meninggal') ? 'selected' : '' ; ?>>Sudah Meninggal</option>
                <option value="Petani" <?php echo($row['pekerjaan_ayah'] == 'Petanni') ? 'selected' : '' ; ?>>Petani</option>
                <option value="PNS" <?php echo($row['pekerjaan_ayah'] == 'PNS') ? 'selected' : '' ; ?>>PNS</option>
                <option value="Karyawan Swasta" <?php echo($row['pekerjaan_ayah'] == 'Karyawan Swasta') ? 'selected' : '' ; ?>>Karyawan Swasta</option>
                <option value="Tidak Bekerja" <?php echo($row['pekerjaan_ayah'] == 'Tidak Bekerja') ? 'selected' : '' ; ?>> Tidak Bekerja</option>
                <option value="Pedagang Kecil" <?php echo($row['pekerjaan_ayah'] == 'Pedagang Kecil') ? 'selected' : '' ; ?>>Pedagang Kecil</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="penghasilan_ayah">Penghasilan Ayah/Bulan</label>
                <select name="penghasilan_ayah" id="penghasilan_ayah" required>
                    <option value="Tidak Berpenghasilan" <?php echo ($row['penghasilan_ayah'] == 'Tidak Berpenghasilan') ? 'selected' : ''; ?>>Tidak Berpenghasilan</option>
                    <option value="Rendah" <?php echo ($row['penghasilan_ayah'] == 'Rendah') ? 'selected' : ''; ?>>Rendah (< 1 juta)</option>
                    <option value="Sedang" <?php echo ($row['penghasilan_ayah'] == 'Sedang') ? 'selected' : ''; ?>>Sedang (1 juta - 2 juta)</option>
                    <option value="Tinggi" <?php echo ($row['penghasilan_ayah'] == 'Tinggi') ? 'selected' : ''; ?>>Tinggi (> 2 juta)</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="Sudah Meninggal" <?php echo($row['pekerjaan_ibu'] == 'Sudah Meninggal') ? 'selected' : '' ; ?>>Sudah Meninggal</option>
                    <option value="PNS/Polwan" <?php echo($row['pekerjaan_ibu'] == 'PNS/Polwan') ? 'selected' : '' ; ?>>PNS/Polwan</option>
                    <option value="Karyawan Swasta" <?php echo($row['pekerjaan_ibu'] == 'Karyawan Swasta') ? 'selected' : '' ; ?>>Karyawan Swasta</option>
                    <option value="Tidak Bekerja" <?php echo($row['pekerjaan_ibu'] == 'Tidak Bekerja') ? 'selected' : '' ; ?>>Tidak Bekerja</option>
                    <option value="Pedagang Kecil" <?php echo($row['pekerjaan_ibu'] == 'Pedagang Kecil') ? 'selected' : '' ; ?>>Pedagang Kecil</option>
                            </select>
            </div>
            <div class="mb-4">
                <label for="penghasilan_ibu">Penghasilan Ibu/Bulan</label>
                <select name="penghasilan_ibu" id="penghasilan_ibu" required>
                    <option value="Tidak Berpenghasilan" <?php echo ($row['penghasilan_ibu'] == 'Tidak Berpenghasilan') ? 'selected' : ''; ?>>Tidak Berpenghasilan</option>
                    <option value="Rendah" <?php echo ($row['penghasilan_ibu'] == 'Rendah') ? 'selected' : ''; ?>>Rendah (< 1 juta)</option>
                    <option value="Sedang" <?php echo ($row['penghasilan_ibu'] == 'Sedang') ? 'selected' : ''; ?>>Sedang (1 juta - 2 juta)</option>
                    <option value="Tinggi" <?php echo ($row['penghasilan_ibu'] == 'Tinggi') ? 'selected' : ''; ?>>Tinggi (> 2 juta)</option>
                </select>
            </div>
            <div class="mb-4">
            <label for="penerima_KIP" class="block text-sm font-medium text-gray-700">Penerima KIP</label>
            <select name="penerima_KIP" id="penerima_KIP" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="Ya" <?php echo($row['penerima_KIP'] == 'Ya') ? 'selected' : '' ; ?>>Ya</option>
                <option value="Tidak"<?php echo($row['penerima_KIP'] == 'Tidak') ? 'selected' : '' ; ?>>Tidak</option>
                </select>
            </div>
            </div>
            <div class="mb-4">
            <label for="penerima_KKS" class="block text-sm font-medium text-gray-700">Penerima KKS</label>
            <select name="penerima_KKS" id="penerima_KKS" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="Ya" <?php echo($row['penerima_KKS'] == 'Ya') ? 'selected' : '' ; ?>>Ya</option>
                <option value="Tidak"<?php echo($row['penerima_KKS'] == 'Tidak') ? 'selected' : '' ; ?>>Tidak</option>
                </select>
            </div>
            </div>

            <button type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </form>
    </div>

    <!-- SCRIPT -->
    <script src="js/script.js"></script>
</body>

</html>