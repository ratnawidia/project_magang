<?php
include 'DbConfig.php';

class BackupDB extends DbConfig {	
	
	var $config;
	var $dump;
	var $struktur = array();
	var $datei;
	
	public function __construct()
    {
        parent::__construct();
    }
	

	public function backup($folder){
		$this->config['folder'] = $folder;
		
		if(isset($_POST['backup'])){
			if(empty($_POST['table'])){
				die("Tidak ada tabel yang dipilih.");
			}

			$tables = array();
			$insert = array();
			$sql_statement = '';

			foreach($_POST['table'] AS $table){
				$this->conn->query("LOCK TABLE $table WRITE");
				
				$res = $this->conn->query('SHOW CREATE TABLE ' . $table . '');
				if ($res && $res->num_rows){
					$crt = $res->fetch_assoc();
					$createtable = $crt['Create Table'];
				}
				
				$str = "\n\n-- --------------------------------------------------------

				--
				-- Struktur tabel untuk `$table`
				-- 

				" . $createtable. ";\n\n";

				array_push($tables, $str);
				
				// table "inserts"
				$sql = 'SELECT * FROM ' . $table;
				$query = $this->conn->query($sql);
				$jml_field = $query->field_count;
				$sql_statement = '--
				-- Menambahkan data untuk `'.$table.'`
				--

				';
				

				while( $ds = $query->fetch_assoc() ){
					$ar = (array_keys($ds));
					$sql_statement .= "INSERT INTO `".$table."` (";
					for ($i=0; $i<$jml_field; $i++){
						if ($i == $jml_field-1){
							$sql_statement .= "`".$ar[$i]."`";
						} 
						else {
							$sql_statement .= $ar[$i].", ";
						}						
					}
					
					$sql_statement .= ") VALUES (";
					for ($i=0; $i<$jml_field; $i++){
						if (empty($ds[$ar[$i]])){
							$ds[$ar[$i]] = NULL;
						}
						$stt=str_replace("'", "''", $ds[$ar[$i]]);
						if ( $i==($jml_field-1) ){
							$sql_statement .= "'" . $stt . "'";
						} 
						else {
							$sql_statement .= "'" . $stt . "', ";
						}
					}
					$sql_statement .= ");\n";
				}
				

				if(!in_array($sql_statement, $insert)){
					   array_push($insert, $sql_statement);
					   unset($sql_statement);
					   }
				unset($sql_statement);
			}
				   
			// put table structure and inserts together in one var
			$this->struktur = array_combine($tables, $insert);
			//print_r($this->struktur);
			//echo "<hr/>";
			
			// create full dump
			$this->createDUMP($this->struktur);			
			//print_r($this->dump);
			
			// create zip file
			$this->createZIP();

			/** end backup **/

			// output
			echo '<h3 style="color:green;">Backup berhasil</h3><a href="' . $this->datei . '">Link Download Backup</a>
			<br />
			<br />';
			echo "<div class='sukses' style='margin-bottom:15px'><small>File backup telah dibuat, silahkan download dari link yang tersedia di atas</small></div>";
		}
	}	

	/**
	* this function create the zip file with the database dump and save it on the ftp server
	* @return
	*/
	protected function createZIP(){
		// Set permissions to 777
		chmod($this->config['folder'], 0777);

		// create zip file
		$zip = new ZipArchive();
		// Create file name
		date_default_timezone_set('Asia/Jakarta');
		$this->datei = $this->config['folder'] . date("Y-m-d (H.i.s)").".zip";
		//echo "<b>backup file: </b><div class='info' style='color:#ff0000'>". $this->datei . "</div>";

		// Checking if file could be created
		if ($zip->open($this->datei, ZIPARCHIVE::CREATE)!==TRUE) {
			exit("Tidak bisa membuka <".$this->datei.">\n");
		}

		// add mysql dump to zip file
		$zip->addFromString("dump.sql", $this->dump);
		// close file
		$zip->close();

		// Check whether file has been created
		if(!file_exists($this->datei)){
			die("File backup tidak dapat dibuat.");
		}
		
		//$this->datei = $fileenkrip;
			
		//require_once "../Classes/Kripto.php";
		//$passphrase = "fmy3ah4wbumzf13fus";
		//$fileenkrip = $this->datei . ".cbt";
		//$fileenkrip = str_ireplace(".zip", "", $fileenkrip);
		//encrypt_file($this->datei , $fileenkrip, $passphrase);
		//unlink( $this->datei );
		//$this->datei = $fileenkrip;
	}

	protected function createDUMP($dump){
		date_default_timezone_set('Asia/Jakarta');
		$date = date("j F Y, H:i:s");
		$header = <<<HEADER
-- SQL Dump
--
-- Host: {$_SERVER['HTTP_HOST']}
-- Waktu pembuatan: {$date}

--
-- Basisdata: `{$this->_database}`
--

HEADER;
		
		$sql="";
		foreach($dump AS $name => $value){
			$sql .= $name.$value;
		}
		
		$this->dump = $header.$sql;
		//echo "<pre>".$this->dump."</pre>";
	}

	public function outputForm(){
		// select all tables from database					   
		//$result = mysql_list_tables($this->config['mysql'][3]); //mysql_list_tables is deprecated: yudwi
				
		$dbname = $this->_database;
		$sql    = "SHOW TABLES FROM $dbname ";
		$result = $this->conn->query($sql);

		if (!$result) {
			echo "DB Error, tidak bisa membaca tabel\n";
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}


		$buffer = '
			<fieldset>
				<legend><b>Backup database: ' . $dbname . '</b></legend>
				<form method="post" action="">
			<select name="table[]" multiple="multiple" size="15" style="display:none;">';
		while($row = $result->fetch_row()){
			//if($row[0]!='sysadmin')
			$buffer .= '<option value="' . $row[0] . '" selected="selected">' . $row[0] . '</option>';
		}
		$buffer .= '</select>
		<br /><br />
		<input type="submit" name="backup" value="Backup" />
		</form>
		</fieldset>';
		echo $buffer;
	}
}
?>