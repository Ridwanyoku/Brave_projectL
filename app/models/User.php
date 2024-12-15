<?php

session_start();
include 'db.php'; // Pastikan file ini berisi koneksi database

if (isset($_POST['Login'])) {
    // Ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Jangan hash ulang, password_verify akan digunakan

    // Query untuk mendapatkan data pengguna
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password benar, set session
            $_SESSION['Login'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Arahkan ke dashboard berdasarkan role
            if ($user['role'] == 'siswa') {
                header("Location: siswa_dashboard.php");
            } elseif ($user['role'] == 'guru') {
                header("Location: guru_dashboard.php");
            }
            exit();
        } else {
            // Password salah
            echo "Password salah!";
        }
    } else {
        // Username tidak ditemukan
        echo "Username tidak ditemukan!";
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="User.php" method="POST">
        <input type="text" name = "username" placeholder = "username" required>
        <!-- <input type="text" name = "role" placeholder = "role" required> -->
        <input type="text" name="password" placeholder = "password" required>
        <button type= "submit" name="Login">Login</button>
        <a href="register.php">Daftar akun</a>
    </form>
</body>
</html>