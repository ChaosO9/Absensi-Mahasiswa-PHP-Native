<?php
    session_start();

    //Mengecek apakah user sudah login sebelumnya
    if (isset($_SESSION["login"]) ) {
        header("Location: index.php");
    }

    //Menghubungkan database
    require 'koneksi2.php';

    //Proses login dan pengecekan password
    if( isset($_POST["login"]) ) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $nim = intval($email);
        
        $result = mysqli_query($koneksi, "SELECT akun_admin.*, akun_mahasiswa.email, akun_mahasiswa.nim, mahasiswa.foto FROM akun_admin
        JOIN mahasiswa ON akun_admin.nim = mahasiswa.nim 
        JOIN akun_mahasiswa ON akun_admin.nim = akun_mahasiswa.nim 
        WHERE akun_mahasiswa.email = '$email' OR akun_mahasiswa.nim = $nim");
    if( mysqli_num_rows($result) === 1) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<script> <?php print_r($row); ?> </script>';
$sqlphoto = mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE nim = '{$row["nim"]}'");
if ($sqlphoto) {
$photo = mysqli_fetch_assoc($sqlphoto);
$admin_photo = $photo['foto'];
}else{
$admin_photo = 'placeholder.jpg';
}

if( password_verify($password, $row["password"]) ) {
$_SESSION["login"] = true;
$id=$row["id_admin"];
$_SESSION['admin_id']=$row["id_admin"];
$_SESSION['admin_user_email']=$row["email"];
$_SESSION['admin_user_name']=$row["nama"];
$_SESSION['admin_user_foto']=$row["foto"];
$_SESSION['admin_user_last_login']=$row["last_login"];
header("Location: index.php");
exit;
}
}
}
//Flag error bahwa password/email salah
$error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login Mahasiswa | Sistem Absensi TI 4A</title>
</head>

<body class="login">
    <div class="container">
        <div class="row justify-content-center form-login mt-5">
            <div class="col-md-6">
                <form action="" class="panel" method="post">
                    <h3 class="mb-4 text-center text-uppercase">Login Mahasiswa TI 4A</h3>
                    <?php if( isset($error) ) :?>
                    <div class="alert alert-danger mr-5 ml-5 radius" role="alert">
                        Email / Password Anda salah
                    </div>
                    <?php endif; ?>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="email" id="email" class="form-control form-control-lg radius"
                            placeholder="Email">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="password" name="password" id="password" class="form-control form-control-lg radius"
                            placeholder="Password">
                    </div>
                    <div class="form-group mt-4 ml-5 mr-5">
                        <button type="submit" class="btn btn-info btn-login block radius" name="login">Login</button>
                    </div>
                    <div class="form-group mt-4 ml-5 mr-5">
                        <a href="registrasimahasiswa.php" class="btn btn-info btn-regis block radius"
                            role="button">Registrasi</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>