<?

session_start();

if(isset($_SESSION['role']) || $_SESSION['role'] != 'guru' ){
    header("Location: User.php");
    exit();
}

echo "halo guru";

?>