<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    
</head>

<body>
    <?php
        include 'koneksi.php';
        $sql = "SELECT project.id, project.nama_project, project.perusahaan,
                project.created_at, project.updated_at, project.progress, project.file_foto, programmer.nama, programmer.email
                FROM project JOIN programmer ON project.id = programmer.id
                ORDER BY project.id ASC";
        $data = mysqli_query($conn, $sql);
    ?>
    <center>
    <div class="judul"><b>Project Monitoring</b></div>
    <div class="table-responsive-sm">
    <table class="table table-bordered table-borderless">
        <thead class="thead-light">
            <tr>
                <th>PROJECT NAME</th>
                <th>CLIENT</th>
                <th>PROJECT LEADER</th>
                <th>START DATE</th>
                <th>END DATE</th>
                <th>PROGRESS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
                $i=1;
                while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?php echo $d['nama_project']; ?></td>
                <td><?php echo $d['perusahaan']; ?></td>
                <td>
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($d['file_foto']).'"height="25" 
                    weight="25" style="border-radius: 100px; -moz-border-radius: 100px;"/>';?>

                    <b><?php echo $d['nama']; ?><br></b>
                    <?php echo $d['email']; ?>
                </td>
                <td><?php echo $d['created_at']; ?></td>
                <td><?php echo $d['updated_at']; ?></td>
                <td><?php echo 
                        '<div class="progress">
                            <div class="progress-bar " role="progressbar" 
                            style="width: '.$d['progress'].'%;" aria-valuenow="'.$d['progress'].'" aria-valuemin="0" aria-valuemax="100" >' .$d['progress'].'%</div>
                        </div>' 
                    ?>
                </td>
                <td>
                    <a href="index.php?page=hapus&id=<?php echo $d['id']; ?>" onClick="return confirm('Apakah Anda yakin untuk menghapus?')" 
                     class="btn btn-sm btn-info btn-lg btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="index.php?page=edit&id=<?php echo $d['id']; ?>" class="btn btn-sm btn-lg btn-success"><i class='fas fa-pencil-alt'></i></a> 
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table></div></center>
</body>
</html>