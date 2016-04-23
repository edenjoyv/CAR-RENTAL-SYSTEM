<?php
//pdolib.php is a PHP program written
//by Frank Yap a part-time instructor at
//Cebu Technological University main campus.
//Last Update: 2/29/16

class Pdolib{
	
	private $db;
	
	public function __construct() {
		try{
			$mysql = new PDO("mysql:host=localhost", 'root', '');
			$pstatement = $mysql->prepare("CREATE DATABASE IF NOT EXISTS car_rentdb");
			$pstatement->execute();
			$this->db = new PDO("mysql:host=localhost;dbname=car_rentdb", 'root', '');
			
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function createTable($tableName,$tableStruc){
		try{
			$this->db->exec("$tableStruc");
			//echo "Table $tableName - Created!<br /><br />";
		}
		catch(Exception $e){
			echo "Table $tableName not successfully created! <br /><br />";
		}
	}
	
	public function insertRecord($insertSql){
		try{
			$this->db->exec("$insertSql");
			//echo "Table $tableName - Created!<br /><br />";
		}
		catch(Exception $e){
			echo "Insert record not successfully done! <br /><br />";
		}
	}
	
	public function tableExists($table) {

		$db_tables = array_keys($this->db->query('show tables')->fetchAll (PDO::FETCH_GROUP));

		//echo "<pre>" . var_dump($db_tables) . "</pre>"; // for debugging purposes only
		
		if(in_array($table, $db_tables)) 
		{ 
			//echo "TRUE";	// for debugging purposes only
			return TRUE;
		} else {
			//echo "FALSE";	// for debugging purposes only
			return FALSE;
		}


		
	}
	
}

?>