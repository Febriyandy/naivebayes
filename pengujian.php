<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pip";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Ambil informasi kolom dari tabel data_training
$query_info = "DESCRIBE data_training";
$result_info = mysqli_query($conn, $query_info);

// Simpan informasi kolom ke dalam array
$columns = array();
while ($row_info = mysqli_fetch_assoc($result_info)) {
    $columns[] = $row_info['Field'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <div class="w-full flex cursor-pointer mb-3 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/home.svg" class="w-5" alt="">
        <a class="text-white px-5" href="dashboard.php">Dashboard</a>
        </div>
        <div class="w-full flex mb-3 gap-3 pl-4  items-center h-10 rounded-md ">
            <img src="image/data1.svg" class="w-5" alt="">
        <a class=" text-white px-5" href="dataTraining.php">Data Training</a>
        </div>
        <div class="w-full flex mb-3 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/data2.svg" class="w-5" alt="">
        <a class=" text-white px-5" href="dataTesting.php">Data Testing</a>
        </div>
        <div class="w-full flex mb-3 gap-3 pl-4  items-center h-10 rounded-md  bg-blue-400 ">
            <img src="image/data3.svg" class="w-5" alt="">
        <a class=" text-white px-5" href="pengujian.php">Pengujian</a>
        </div>
        <div class="w-full flex mt-56 gap-3 pl-4  items-center h-10 rounded-md  ">
            <img src="image/logout.svg" class="w-5" alt="">
        <a class=" text-white px-5" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="w-5/6 h-screen ml-64 mt-18 flex flex-col bg-gray-100">
    
   
    </div>
    <nav class="h-16 w-full fixed  items-center z-[1000] flex bg-white shadow-md">
        <img src="image/logo.png" class="w-14 ml-5" alt="">
        <h1 class="font-bold text-lg text-blue-900 pl-4">SMA MUHAMMADIYAH TANJUNGPINANG</h1>
    </nav>
</body>
</html>
