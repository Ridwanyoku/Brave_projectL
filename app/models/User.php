<?php
require 'db.php';
session_start();

if(isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "SELECT role FROM user WHERE username = '$username'";
    $cek_role = mysqli_query($conn, $role);
    $data_role = mysqli_fetch_assoc($cek_role);
    
    $sql = "SELECT * FROM  user WHERE username='$username' AND password='$password' ";
    
    $cek_user = mysqli_query($conn, $sql);
    $data_user= mysqli_fetch_assoc($cek_user);

    if ($data_user && $data_role){
        $_SESSION['Login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data_role['role'];

        if($_SESSION['role'] == 'siswa'){
            header("Location: siswa_dashboard.php");

        }else if ($_SESSION['role'] =='guru'){
            header("Location: guru_dashboard.php");
        }

    }

}
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