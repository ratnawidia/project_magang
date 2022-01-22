<?php 
function dilarang_masuk_selain($level){
	if(!isset($_SESSION['username'])){
		header("location:..");
	}	
	if(!isset($_SESSION['level']) || $_SESSION['level'] != $level ){
		header("location:..");
	}
}	
?>
