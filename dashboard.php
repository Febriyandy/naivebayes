<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak ada sesi username, redirect ke halaman login atau halaman lain yang sesuai
    header("Location: index.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Query untuk menghitung jumlah data training
$query_training = "SELECT COUNT(*) AS total_training FROM data_training";
$result_training = mysqli_query($conn, $query_training);
$row_training = mysqli_fetch_assoc($result_training);
$total_training = $row_training['total_training'];

// Query untuk menghitung jumlah data testing
$query_testing = "SELECT COUNT(*) AS total_testing FROM data_testing";
$result_testing = mysqli_query($conn, $query_testing);
$row_testing = mysqli_fetch_assoc($result_testing);
$total_testing = $row_testing['total_testing'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <div class="w-64 h-screen fixed pt-24 px-7 flex-col flex bg-blue-900 ">
        <div class="w-full flex cursor-pointer mb-3 gap-3 pl-4  items-center h-10 rounded-md bg-blue-400 ">
            <img src="image/home.svg" class="w-5" alt="">
            <a class="text-white px-5" href="dashboard.php">Dashboard</a>
        </div>
        <div class="w-full flex mb-3 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/data1.svg" class="w-5" alt="">
            <a class=" text-white px-5" href="dataTraining.php">Data Training</a>
        </div>
        <div class="w-full flex mb-3 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/data2.svg" class="w-5" alt="">
            <a class=" text-white px-5" href="dataTesting.php">Data Testing</a>
        </div>
        <div class="w-full flex mb-3 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/data3.svg" class="w-5" alt="">
            <a class=" text-white px-5" href="pengujian.php">Pengujian</a>
        </div>
        <div class="w-full flex mt-56 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/logout.svg" class="w-5" alt="">
            <a class=" text-white px-5" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="w-5/6 h-screen ml-64 mt-18 flex flex-col bg-gray-100">
        <img src="image/bg.jpeg" class="w-full h-2/3 relative object-cover mx-auto rounded-lg shadow-md opacity-60" alt="">
        <div class="absolute top-40 px-10 ">
            <h1 class="text-center font-bold text-3xl my-6 text-blue-900">Selamat Datang!</h1>
            <h1 class="text-center font-bold text-xl my-6 text-blue-900">Sistem Penentuan Kelayakan pada Program Indonesia Pintar (PIP) di SMA Muhammadiyah Tanjungpinang</h1>
        </div>
        
        <div class="flex justify-center gap-10 mt-5">
            <a href="dataTraining.php">
                <div class="w-60 h-40 bg-blue-900 rounded-lg shadow-md">
                    <img src="image/training.svg" class="mx-auto items-center w-10 pt-5" alt="">
                    <h1 class="font-bold text-center text-xl text-white mt-3">Data Training</h1>
                    <h1 class="font-bold text-center text-3xl text-white mt-2"><?php echo $total_training; ?></h1>
                </div>
            </a>
            <a href="dataTesting.php">
                <div class="w-60 h-40 bg-blue-900 rounded-lg shadow-md">
                    <img src="image/testing.svg" class="mx-auto w-10 pt-5" alt="">
                    <h1 class="font-bold text-center text-xl text-white mt-3">Data Testing</h1>
                    <h1 class="font-bold text-center text-3xl text-white mt-2"><?php echo $total_testing; ?></h1>
                </div>
            </a>
        </div>
    </div>
    <nav class="h-16 w-full fixed  items-center z-[1000] flex bg-white shadow-md">
        <img src="image/logo.png" class="w-14 ml-5" alt="">
        <h1 class="font-bold text-lg text-blue-900 pl-4">SMA MUHAMMADIYAH TANJUNGPINANG</h1>
    </nav>
    </div>
</body>
</html>
