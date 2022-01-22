<?php
    include 'koneksi.php';
  
    include ("Classes/DbConfig.php"); 
    $db = new DbConfig();
?>
<html>
    <head>
        <title>Add Data</title>
    </head>
    <body>
    <?php
        if(isset($_POST['submit'])) {    
            $nama_project 	= $_POST['nama_project'];
            $perusahaan	    = $_POST['perusahaan'];
            $nama     	    = $_POST['nama'];
            $email    	    = $_POST['email'];
            $created_at     = $_POST['created_at'];
            $updated_at     = $_POST['updated_at'];
                
            $sql = "INSERT INTO project (nama_project, perusahaan, nama, email, created_at, updated_at)
                    VALUES ('$nama_project', '$perusahaan', '$nama', '$email', '$created_at', '$updated_at')";
            
            $data = mysqli_query($conn, $sql);
            if($data) echo "<font color='green'>Data berhasil ditambahkan.</font>";
            else echo "<font color='red'>Data gagal ditambahkan.</font>";
            echo "<br/><a href='index.php?page=managemen'>Lihat hasil!</a>";
            header("location:index.php?page=managemen");
        }
    ?>
    </body>
</html>