<?php
    require 'koneksi2.php';
    function registrasi($data) {
    global $koneksi;
    $nim = intval($data["nim"]);
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $token = $data["token"];
    $nama = "";
    $email = "";

    $result = mysqli_query($koneksi, "SELECT nim FROM akun_admin WHERE nim = $nim");
    $sql_check = mysqli_query($koneksi, "SELECT akun_mahasiswa.*, mahasiswa.*  FROM akun_mahasiswa JOIN mahasiswa ON akun_mahasiswa.nim = mahasiswa.nim WHERE akun_mahasiswa.nim = $nim");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
            alert('NIM sudah terdaftar');
        </script>";
        return false;
    }

    if( ! $check = mysqli_fetch_assoc($sql_check) ) {
        echo "<script>
            alert('Anda belum terdaftar sebagai mahasiswa TI 4A');
        </script>";
        return false;
    } else{
        $last_3nim = intval(substr((string)$check["nim"], 5));
        $nama = $check["nama"];
        $email = $check["email"];
    }

    if( $password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    if( $token !== "ADMINJUJUR") {
        echo "<script>
            alert('Token tidak sesuai');
            </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    

    mysqli_query($koneksi, "INSERT INTO akun_admin VALUES ($last_3nim, $nim,'$nama','$email','$password', NULL)");

    return mysqli_affected_rows($koneksi);
}
    if( isset($_POST["register"]) ) {
        if( registrasi($_POST) > 0 ) {
            echo "<script>
                alert('Mahasiswa berhasil ditambahkan');
                document.location.href = 'loginmahasiswa.php';
                </script>";
            
        } else {
            echo mysqli_error($koneksi);
        }
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
    <title>Registrasi Mahasiswa</title>
</head>

<body class="login">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form action="" class="panel" method="post">
                    <h3 class="mb-4 text-center text-uppercase">Registrasi Mahasiswa</h3>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="nim" id="nim" class="form-control form-control-lg radius"
                            placeholder="NIM">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="nomor_absen" id="nomor_absen" class="form-control form-control-lg radius"
                            placeholder="Nomor Absen">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="nama" id="nama" class="form-control form-control-lg radius"
                            placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="email" id="email" class="form-control form-control-lg radius"
                            placeholder="Email">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pilih Jenis Kelamin
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Laki-Laki</a>
                                <a class="dropdown-item" href="#">Perempuan</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="foto" id="foto" class="form-control form-control-lg radius"
                            placeholder="Foto">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="password" name="password" id="password" class="form-control form-control-lg radius"
                            placeholder="Password">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="password" name="password2" id="password2"
                            class="form-control form-control-lg radius" placeholder="Konfirmasi Password">
                    </div>
                    
                    <div class="form-group mt-4 ml-5 mr-5">
                        <button type="submit" class="btn btn-info btn-login block radius"
                            name="register">Registrasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script src="js/bootstrap.min.js"></script>
    
</body>

</html>