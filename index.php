<html>
	<head>
		<title>Project Magang</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="header">
			<div class="logo">
				<div class="judul">Monitoring Project</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="content">
			<div class="box-konten kiri">
				<div class="menu-kiri">
					<ul>
						<li><a href="index.php?page=home">Home</a></li>
						<li class='active has-sub'><a href="#">Managemen</a>
							<ul>
								<li class='has-sub'><a href="index.php?page=managemen">Monitoring</a></li>
								<li class='last'><a href="#">Laporan</a></li>
							</ul></li>
						<li class='active has-sub'><a href="#">Add Data</a>
							<ul>
								<li class='has-sub'><a href="index.php?page=tambah_data">Data Programmer</a></li>
								<li class='has-sub'><a href="#">Data Project</a></li>
							</ul></li>
						<li><a href="#">Programmer</a></li>
						<li><a href="index.php?page=backup">Backup</a></li>
						<li><a href="#">Cetak Data</a></li>
					</ul>
				</div>
			</div>
			<div class="box-konten kanan">
				<div class="konten">
				<?php
					if(!empty($_GET['page'])){
					$hal=$_GET['page'];
					switch($hal){
						case "user" : include "user.php"; break;
						case "user_tambah" : include "user_tambah.php"; break;
						case "user_tambah_simpan" : include "user_tambah_simpan.php"; break;
						case "user_edit" : include "user_edit.php"; break;
						case "user_edit_simpan" : include "user_edit_simpan.php"; break;
						case "user_hapus" : include "user_hapus.php";break;	

						case "backup" 	 : include "managemen/backup.php"; break;
						case "managemen" : include "managemen/managemen.php"; break;
						case "tambah_data" : include "managemen/tambah_data.php"; break;
						case "simpan_data" : include "managemen/simpan_data.php"; break;
						case "edit" 	 : include "managemen/edit.php"; break;
						case "simpan_edit" : include "managemen/simpan_edit.php"; break;
						case "hapus" 	 : include "managemen/hapus.php"; break;
								
						default:
						include "home.php";
						break;	
					}
					}
					else{
						"home.php";
					}
				?>
				</div>
				
				<div class="footer">
					<p>Project Magang (Kampus Merdeka)</p>
					<p>Copyrigt &copy; 2022</p>
				</div>
			</div>
		</div>
	</body>
</html>