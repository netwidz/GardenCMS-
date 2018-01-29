<?php

class settings{
	
	public function getValue($field){
		
	
		$query = sprintf("SELECT $field FROM settings WHERE id='1'");
		
		if($array = dbCon::getFetchArray($query)){
			return $array[$field];	
		}
		else return false;
	}
	
}
?>