<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Pencarian
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $query = "SELECT * FROM data_training WHERE id_siswa = '$keyword' OR nama_siswa = '$keyword'";
} else {
    // Query untuk mengambil data dari tabel data_training jika tidak ada pencarian
    $query = "SELECT * FROM data_training";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Training</title>
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
<body class="bg-gray-100">
    <div class="flex">
        <div class="w-64 h-screen fixed pt-24 px-7 flex-col flex bg-blue-900">
            <div class="w-full flex cursor-pointer mb-3 gap-3 pl-4 items-center h-10 rounded-md">
                <img src="image/home.svg" class="w-5" alt="">
                <a class="text-white px-5" href="dashboard.php">Dashboard</a>
            </div>
            <div class="w-full flex mb-3 gap-3 pl-4 items-center h-10 rounded-md bg-blue-400">
                <img src="image/data1.svg" class="w-5" alt="">
                <a class="text-white px-5" href="dataTraining.php">Data Training</a>
            </div>
            <div class="w-full flex mb-3 gap-3 pl-4 items-center h-10 rounded-md">
                <img src="image/data2.svg" class="w-5" alt="">
                <a class="text-white px-5" href="dataTesting.php">Data Testing</a>
            </div>
            <div class="w-full flex mb-3 gap-3 pl-4 items-center h-10 rounded-md">
                <img src="image/data3.svg" class="w-5" alt="">
                <a class="text-white px-5" href="pengujian.php">Pengujian</a>
            </div>
            <div class="w-full flex mt-56 gap-3 pl-4 items-center h-10 rounded-md">
                <img src="image/logout.svg" class="w-5" alt="">
                <a class="text-white px-5" href="logout.php">Logout</a>
            </div>
        </div>
        <div class="w-4/5 h-screen ml-64 mt-18 flex flex-col absolute bg-gray-100">
            <h1 class="mt-24 font-bold ml-3 text-2xl">Data Training</h1>
            <div class="flex justify-between">
                <form class="mt-5 flex flex-col" action="upload.php" method="post" enctype="multipart/form-data">
                    <input class="border w-70 py-1 pl-1 border-blue-600 rounded-md ml-5" type="file" name="file" accept=".xls, .xlsx" required>
                    <div class="flex gap-3">
                        <button class="bg-blue-900 w-36 mt-5 px-5 text-white py-2 ml-5 rounded-md" type="submit">Upload Data</button>
                        <span onclick="toggleForm()" class="bg-blue-900 w-56 mt-5 px-5 text-center text-white py-2 ml-5 rounded-md cursor-pointer">Tambah Data Manual</span>
                    </div>
                </form>
           
                <form class="mt-5 mr-10" action="dataTraining.php" method="get">
                    <input type="text" class="py-2 px-3 rounded-md" name="search" placeholder="Cari Berdasarkan NISN atau Nama">
                    <button class="bg-blue-900 w-28 text-white py-2 ml-5 rounded-md" type="submit">Cari</button>
                    <div class="mt-2 flex">
                <form action="hapus_semuadata.php" method="get">
                    <button class="border-blue-600 ml-5 mt-3 bg-blue-900 w-70 px-5 text-white py-2 rounded-md" type="submit">Hapus Semua Data</button>
                </form>
                <form action="download_excel.php" method="post">
                    <button class="bg-blue-900 w-40 mt-3 px-5 text-white py-2 rounded-md ml-5" type="submit">Download Excel</button>
                </form>
            </div>
                </form>
            </div>
            <div class="overflow-auto w-full px-5 h-96 mx-auto">
                <table class="w-1/2 bg-white border border-gray-200 mt-5">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">NISN</th>
                            <th class="px-4 py-2 border">Nama Siswa</th>
                            <th class="px-4 py-2 border">Jenis Tinggal</th>
                            <th class="px-4 py-2 border">Alat Transportasi</th>
                            <th class="px-4 py-2 border">Penerima KPS</th>
                            <th class="px-4 py-2 border">Pekerjaan Ayah</th>
                            <th class="px-4 py-2 border">Penghasilan Ayah/Bulan</th>
                            <th class="px-4 py-2 border">Pekerjaan Ibu</th>
                            <th class="px-4 py-2 border">Penghasilan Ibu/Bulan</th>
                            <th class="px-4 py-2 border">Penerima KIP</th>
                            <th class="px-4 py-2 border">Penerima KKS</th>
                            <th class="px-4 py-2 border">Keterangan</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 border'>{$no}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['id_siswa']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['nama_siswa']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['jenis_tinggal']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['alat_transportasi']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['penerima_KPS']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['pekerjaan_ayah']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['penghasilan_ayah']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['pekerjaan_ibu']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['penghasilan_ibu']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['penerima_KIP']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['penerima_KKS']}</td>";
                            echo "<td class='px-4 py-2 border'>{$row['keterangan']}</td>";
                            echo "<td class='px-4 py-6 h-auto border flex gap-3'>
                                    <a class='text-white py-2 px-4 rounded-md  bg-blue-600 hover:underline' href='edittraining.php?id={$row['id_siswa']}' title='Edit'>Edit</a>
                                    <a class='text-white py-2 px-4 rounded-md  bg-red-600 hover:underline' href='hapustraining.php?id={$row['id_siswa']}' title='Hapus' onclick='return confirmDelete();'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <nav class="h-16 w-full fixed items-center z-[1000] flex bg-white shadow-md">
        <img src="image/logo.png" class="w-14 ml-5" alt="">
        <h1 class="font-bold text-lg text-blue-900 pl-4">SMA MUHAMMADIYAH TANJUNGPINANG</h1>
    </nav>
    <!-- Modal Form -->
    <div id="formTambah" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 h-4/5 overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Tambah Data</h2>
                        <button onclick="toggleForm()" class="text-red-500 text-2xl">&times;</button>
                    </div>
                    <form action="proses_tambah_data.php" method="post">
                        <div class="mb-4">
                            <label for="id_siswa" class="block text-sm font-medium text-gray-700">NISN Siswa</label>
                            <input type="text" name="id_siswa" id="id_siswa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_tinggal" class="block text-sm font-medium text-gray-700">Jenis Tinggal:</label>
                            <select name="jenis_tinggal" id="jenis_tinggal" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                <option value="Panti Asuhan">Panti Asuhan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="alat_transportasi" class="block text-sm font-medium text-gray-700">Alat Transportasi:</label>
                            <select name="alat_transportasi" id="alat_transportasi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Jalan Kaki">Jalan Kaki</option>
                                <option value="Sepeda Motor">Sepeda Motor</option>
                                <option value="Angkutan Umum">Angkutan Umum</option>
                                <option value="Mobil Pribadi">Mobil Pribadi</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="penerima_KPS" class="block text-sm font-medium text-gray-700">Penerima KPS:</label>
                            <select name="penerima_KPS" id="penerima_KPS" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah:</label>
                            <select name="pekerjaan_ayah" id="pekerjaan_ayah" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Buruh">Buruh</option>
                                <option value="Nelayan">Nelayan</option>
                                <option value="Sudah Meninggal">Sudah Meninggal</option>
                                <option value="Petani">Petani</option>
                                <option value="PNS">PNS</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                                <option value="Pedagang Kecil">Pedagang Kecil</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="penghasilan_ayah" class="block text-sm font-medium text-gray-700">Penghasilan Ayah/Bulan:</label>
                            <select name="penghasilan_ayah" id="penghasilan_ayah" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                                <option value="Rendah">Rendah (< 1 juta)</option>
                                <option value="Sedang">Sedang (1 juta - 2 juta)</option>
                                <option value="Tinggi">Tinggi (> 2 juta)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu:</label>
                            <select name="pekerjaan_ibu" id="pekerjaan_ibu" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Sudah Meninggal">Sudah Meninggal</option>
                                <option value="PNS/Polwan">PNS/Polwan</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                                <option value="Pedagang Kecil">Pedagang Kecil</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="penghasilan_ibu" class="block text-sm font-medium text-gray-700">Penghasilan Ibu/Bulan:</label>
                            <select name="penghasilan_ibu" id="penghasilan_ibu" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                                <option value="Rendah">Rendah (< 1 juta)</option>
                                <option value="Sedang">Sedang (1 juta - 2 juta)</option>
                                <option value="Tinggi">Tinggi (> 2 juta)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="penerima_KIP" class="block text-sm font-medium text-gray-700">Penerima KIP:</label>
                            <select name="penerima_KIP" id="penerima_KIP" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="penerima_KKS" class="block text-sm font-medium text-gray-700">Penerima KKS:</label>
                            <select name="penerima_KKS" id="penerima_KKS" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan:</label>
                            <select name="keterangan" id="keterangan" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="Layak">Layak</option>
                                <option value="Tidak Layak">Tidak Layak</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded-md">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        function toggleForm() {
            document.getElementById('formTambah').classList.toggle('hidden');
        }
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>
</body>
</html>
