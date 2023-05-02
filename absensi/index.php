<?php
	
  session_start();
  if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
	include "koneksi.php";
	/*
	if(isset($_session['id'])){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';	
	}*/		
	$dosen_id = $_SESSION['dosen_id'];
	$dosen_name = $_SESSION["dosen_user_name"];
  $dosen_foto = $_SESSION["dosen_user_foto"];
  $dosen_last_login = $_SESSION["dosen_user_last_login"];
 
  
  $jumlah_matkul=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM matkul WHERE id_dosen='$dosen_id'"));
  $jumlah_kelas=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_dosen='$dosen_id'"));
	$jumlah_siswa=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM mahasiswa"));
	
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard | UNINDRA</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UNINDRA</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

     
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="absensi.php">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Absensi</span></a>
      </li>

      <!-- Nav Item - Tables
      <li class="nav-item">
        <a class="nav-link" href="nilai.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Nilai Tugas</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav align-items-center">
            <span class="mr-2 d-none d-lg-inline text-gray-600 medium">Terakhir Login : <span class="text-success"><?=$dosen_last_login?></span></span>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 medium"><?=$dosen_name?></span>
                <img class="img-profile rounded-circle" src="img/<?=$dosen_foto?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Setting
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

          <div class="row">

          <!-- Lihat Mahasiswa  -->
          <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-success shadow h-100 py-2">
                 <a href="lihatmhs.php" style="text-decoration:none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mahasiswa <br>yang diajarkan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_siswa?> (Mahasiswa)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            <!-- Akhir Lihat Mahasiswa -->

            <!-- Tugas -->
            <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-primary shadow h-100 py-2">
              <a href="lihatkelas.php" style="text-decoration:none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kelas <br> yang diajarkan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kelas?> (Kelas)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
              </div>
            </div>
            <!-- Akhir Tugas -->

            <!-- Rekap Absensi -->
         <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-danger shadow h-100 py-2">
              <a href="lihatmatkul.php" style="text-decoration:none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mata Kuliah <br> Yang diajarkan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_matkul?> (Mata Kuliah)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            <!-- Akhir Rekap Absensi -->
            <!-- Rekap Absensi -->
         <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-warning shadow h-100 py-2">
              <a href="#" style="text-decoration:none;" data-toggle="modal" data-target="#comingModal">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tugas <br> yang sedang aktif</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">- (Tugas)</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            <!-- Akhir Rekap Absensi -->
            
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Andikha Dian Nugraha 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Coming Soon-->
  <div class="modal fade" id="comingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Coming Soon</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Fitur ini masih belum aktif</div>
        <div class="modal-footer">
        <button class="btn btn-primary" type="button" data-dismiss="modal">Oke</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih Logout untuk keluar</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
