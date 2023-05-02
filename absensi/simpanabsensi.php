<?php
	include "koneksi.php";
    $id_kelas=$_GET['id'];

	$querysiswa = "select * from mahasiswa where id_kelas='$id_kelas'";
	$res_siswa=mysqli_query($koneksi,$querysiswa);
	$berhasil=true;
	while($data=mysqli_fetch_array($res_siswa)){
		$npm=$data[0];
        $tgl=date("Y-m-d");
		$id_post='ket'.$npm;
		$ket=$_POST[$id_post];
		if($sql_absen=mysqli_query($koneksi,"INSERT INTO absensi VALUES(null,'$tgl','$ket','$id_kelas','$npm')")){
			
		}else{
			$berhasil=false;
			echo 'gagal';
		}
	}
	
	if($berhasil){
		?> <script>alert('Simpan Data Berhasil')</script><?php
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=absensi.php">';		
	}else{
		?> <script>alert('Simpan Data Gagal');</script><?php		
	}
?>