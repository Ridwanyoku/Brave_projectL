<?

session_start();

if(isset($_SESSION['role']) || $_SESSION['role'] != 'siswa' ){
    header("Location: User.php");
    exit();
}

echo "halo siswa";

?>