<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input form
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['login_error'] = "All fields are required.";
        header("Location: User.php");
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $query = "SELECT id, username, password, role FROM user WHERE username = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Validasi user dan password
    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil
        if ($user['role'] === 'siswa') {
            header('Location: siswa_dashboard.php');
            exit();
        } else if ($user['role'] === 'guru') {
            header('Location: guru_dashboard.php');
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid user role.";
            header("Location: User.php");
            exit();
        }
    } else {
        // Login gagal
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: User.php");
        exit();
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
        <input type="text" name="password" placeholder = "password" required>
        <button type= "submit" name="Login">Login</button>
    </form>
</body>
</html>