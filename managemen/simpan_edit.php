<?php
include "koneksi.php";
 
if(isset($_POST['update'])){    
    $id  	        = $_POST['id'];    
    $nama_project 	= $_POST['nama_project'];
    $perusahaan 	= $_POST['perusahaan'];
    $nama     	    = $_POST['nama'];
    $email    	    = $_POST['email'];
	$created_at     = $_POST['created_at'];
	$updated_at     = $_POST['updated_at'];

	$sql = "UPDATE project SET nama_project='$nama_project', perusahaan='$perusahaan', 
            nama='$nama', email='$email', created_at='$created_at',
            updated_at='$updated_at' WHERE id=$id";
				
	$data = mysqli_query($conn, $sql);
	if($data) echo "<font color='green'>Data monitoring berhasil diubah.</font>";
	else echo "<font color='red'>Data monitoring gagal diubah.</font>";
	echo "<br/><a href='index.php?page=managemen'>Lihat hasil!</a>";
    header("location:index.php?page=managemen");
}
?>