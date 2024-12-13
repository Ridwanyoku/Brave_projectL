<?php

include 'db.php';

if (isset($_POST['regis'])) {
    // Kode proses form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Cek apakah username sudah ada
    $sql_check = "SELECT * FROM user WHERE username = '$username'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "Username sudah digunakan!";
    } else {
        // Query untuk memasukkan data
        $sql = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "Registrasi berhasil!";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }

    // Tutup koneksi
    mysqli_close($conn);
}


var_dump($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="register.php" method="POST">
        <input type="text" name = "username" placeholder = "username" required>
        <input type="text" name="password" placeholder = "password" required>
        <select name="role" id="role">
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select>
        <button type= "submit" name="regis">regis</button>
    </form>
</body>
</html>