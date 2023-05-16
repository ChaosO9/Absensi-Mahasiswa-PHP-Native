<?php 
include('koneksi2.php');
session_start();
$dosen_id = $_SESSION['admin_id'];
$berhasil = true;
if($sql_login=mysqli_query($koneksi, "UPDATE akun_admin SET last_login=now()")){
    $_SESSION =[];
    session_unset();
    session_destroy();
    header("Location: login.php");
}
echo mysqli_error($koneksi);
?>