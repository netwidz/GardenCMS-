<?php
/*	

# ---------------------------------------------------------------- #
| Zahran edited                                           |
| Here goes your content                                           |
| Here goes your content                                           |
| Here goes your content                                           |
| Here goes your content                                           |
# ---------------------------------------------------------------- #

*/

class dbCon{

	# Execute SQL queries
	

	function execute_query($query=""){
	
		global $cosmetic;
		
		$result = "";
		
		if(!empty($query)){
			
			$connection = mysql_connect('localhost','root','') or die(mysql_error());
										
			$database = mysql_select_db('gardenspa',$connection) or die(mysql_error());
			
			$result = mysql_query($query) or die (mysql_error());
			
		}
		
		return $result;
		
	}
	
	# Get no. of records in resulted query
	
	function get_row_count($query=""){
	
		$result = dbCon::execute_query($query); // execute query
		
		if($result!="") return mysql_num_rows($result);
			else return -1;
			
	}
	
	# Get resulted accociative array
	
	function get_fetch_array($query=""){
	
		$result = dbCon::execute_query($query); // execute query
		
		if($result!="") return mysql_fetch_assoc($result);
			else return -1;
			
	}
	
	# Get resulted accociative array
	
	function get_fetch_rows($query=""){
		$array = array();
		$result = dbCon::execute_query($query); // execute query
		
		if($result!=""){
			while($resultset = mysql_fetch_assoc($result)){
				$array[] = $resultset;
			}
			
			return $array;
		}
		else return -1;
			
	}
	
	# trim posted values in forms and add slashes
	
	function addslash($value){
	
		return addslashes(trim($value));
			
	}
	
	# remove slashes	
	function removeslash($value){
	
		return stripslashes($value);
			
	}
	
	# Last Inserted Id	
	function lastId(){
	
		return mysql_insert_id(); // execute query
			
	}
}

?>