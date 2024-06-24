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
    $query = "SELECT * FROM data_testing WHERE id_siswa = '$keyword' OR nama_siswa = '$keyword'";
} else {
    // Query untuk mengambil data dari tabel data_testing jika tidak ada pencarian
    $query = "SELECT * FROM data_testing";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Testing</title>
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
            <div class="w-full flex mb-3 gap-3 pl-4 items-center h-10 rounded-md ">
                <img src="image/data1.svg" class="w-5" alt="">
                <a class="text-white px-5" href="dataTraining.php">Data Training</a>
            </div>
            <div class="w-full flex mb-3 gap-3 pl-4 items-center h-10 rounded-md bg-blue-400">
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
            <h1 class="mt-24 font-bold ml-3 text-2xl">Data Testing</h1>
            <div class="flex justify-between">
            <div class="mt-5 flex">
                <form action="hapus_semuadata1.php" method="get">
                    <button class="border-blue-600 ml-5 bg-blue-900 w-70 px-5 text-white py-2 rounded-md" type="submit">Hapus Semua Data</button>
                </form>
                <form action="download_excel1.php" method="post">
                    <button class="bg-blue-900 w-40 px-5 text-white py-2 rounded-md ml-5" type="submit">Download Excel</button>
                </form>
            </div>
                <form class="mt-5 mr-10" action="dataTesting.php" method="get">
                    <input type="text" class="py-2 px-3 rounded-md" name="search" placeholder="Cari Berdasarkan NISN atau Nama">
                    <button class="bg-blue-900 w-28 text-white py-2 ml-5 rounded-md" type="submit">Cari</button>
                </form>
            </div>
            <div class="overflow-auto w-full px-5 h-96 mx-auto">
                    <div class="overflow-auto w-full  h-96 mx-auto">
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
                                    <a class='text-white py-2 px-4 rounded-md  bg-blue-600 hover:underline' href='edittesting.php?id={$row['id_siswa']}' title='Edit'>Edit</a>
                                    <a class='text-white py-2 px-4 rounded-md  bg-red-600 hover:underline' href='hapustesting.php?id={$row['id_siswa']}' title='Hapus' onclick='return confirmDelete();'>Hapus</a>
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

    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>
</body>
</html>
