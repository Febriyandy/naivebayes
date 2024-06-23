<?php
session_start();
include 'koneksi.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the entered username and password exist in the database
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check if a row is returned (valid username and password)
        if (mysqli_num_rows($result) == 1) {
            // Fetch user data and store it in the session
            $_SESSION['username'] = $username;

            // Redirect to the dashboard.php page upon successful login
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid username or password, show an alert
            echo '<script>alert("Username or password is incorrect. Please try again.");</script>';
        }
    } else {
        // Error in the query
        echo '<script>alert("Error in the query.");</script>';
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMA Muhammadiyah</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
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
<body class="min-h-screen flex items-center justify-center">
  <img src="image/bg.jpeg" alt="bg" class="w-full object-cover h-screen">
    <div class="absolute bg-white/50 backdrop-filter backdrop-blur-md p-8 rounded-lg text-center max-w-sm w-full">
        <img src="image/logo.png" alt="Logo" class="mx-auto mb-4 w-24 h-auto">
        <h1 class="text-base text-white font-body">SMA Muhammadiyah</h1>
        <p class="text-2xl font-bold text-white font-body mb-4">Login Admin</p>
        <form action="" method="POST" class="space-y-4">
            <div>
                <input type="text" name="username" placeholder="Username" class="w-full p-2 rounded border border-white/70 backdrop-filter backdrop-blur-sm focus:outline-none focus:ring-2" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" class="w-full p-2 rounded border border-white/70 backdrop-filter backdrop-blur-sm focus:outline-none focus:ring-2" required>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Masuk</button>
            </div>
        </form>
    </div>
</body>
</html>
