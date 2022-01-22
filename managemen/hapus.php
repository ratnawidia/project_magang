<?php
$id = $_GET['id'];


$sql = "DELETE FROM project WHERE id = '$id ' ";
$data = mysqli_query($conn, $sql);

if($data == false) {
	echo 'Error: tidak bisa menghapus data';
} 
else {
	header("Location:index.php?page=managemen");
}
 
?>