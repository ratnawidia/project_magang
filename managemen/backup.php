<div style="padding:0px;">
<h1>Backup Database</h1>
	<?php 
	include "Classes/BackupDB.php";
	$bck = new BackupDB();

	$folder = "../backup/";

	if(isset($_POST['backup'])){
		$bck->backup($folder);
	}

	$bck->outputForm();
	?>
</div>
