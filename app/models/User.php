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
}

$username = $_POST['username'];
$password = $_POST['password'];


$query = "SELECT id, password FROM user WHERE username = ?";
$statement = $pdo->prepare($query);
$statement->execute([$username]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="post">
        <input type="text" name = "username" placeholder = "username" required>
        <input type="text" name="password " placeholder = "password" required>
        <button type= "submit" name="Login">Login</button>
    </form>
</body>
</html>