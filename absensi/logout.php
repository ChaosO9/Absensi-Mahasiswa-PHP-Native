<?php 
include('koneksi.php');
session_start();
$dosen_id = $_SESSION['dosen_id'];
$berhasil = true;
if($sql_login=mysqli_query($koneksi, "UPDATE dosen SET last_login=now()")){
    $_SESSION =[];
    session_unset();
    session_destroy;
    header("Location: login.php");
}
echo mysqli_error($koneksi);
?>