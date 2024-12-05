<?php
require 'db.php';
session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Validasi input form
//     if (empty($_POST['username']) || empty($_POST['password'])) {
//         $_SESSION['login_error'] = "All fields are required.";
//         header("Location: User.php");
//         exit();
//     }

//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Query untuk mencari user berdasarkan username
//     $query = "SELECT username, password, role FROM user WHERE username = ?";
//     $statement = $pdo->prepare($query);
//     $statement->execute([$username]);
//     $user = $statement->fetch(PDO::FETCH_ASSOC);

//     // Validasi user dan password
//     if ($user && password_verify($password, $user['password'])) {
//         // Login berhasil
//         if ($user['role'] === 'siswa') {
//             header('Location: public/siswa_dashboard.php');
//             exit();
//         } else if ($user['role'] === 'guru') {
//             header('Location: public/guru_dashboard.php');
//             exit();
//         } else {
//             $_SESSION['login_error'] = "Invalid user role.";
//             header("Location: User.php");
//             exit();
//         }
//     } else {
//         // Login gagal
//         $_SESSION['login_error'] = "Invalid username or password.";
//         header("Location: User.php");
//         exit();
//     }
// }

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
    </form>
</body>
</html>