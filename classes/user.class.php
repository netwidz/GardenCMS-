<?php

class user{
	
	var $id;
	var $fname;
	var $lname;
	var $uname;
	var $password;
	var $ulevel;

	// constructors
	function __construct(){}
	
	public function user($field,$value){
		
		$query = sprintf("SELECT * FROM users WHERE $field='%s'",$value);
		//return $query;		
		if($array = dbCon::get_fetch_array($query)){
			$this->id = $id;
			$this->fname = $array['fname'];
			$this->lname = $array['lname'];
			$this->uname = $array['username'];
			$this->password = $array['password'];
			$this->ulevel = $array['level'];	
			
		}
	}
	
	// set methods
	public function setId($value){ $this->id = $value;}
	public function setFName($value){ $this->fname = $value;}
	public function setLName($value){ $this->lname = $value;}
	public function setUname($value){ $this->uname = $value;}
	public function setPassword($value){ $this->password = $value;}	
	public function setULevel($value){ $this->ulevel = $value;}
	
	// get methods
	public function getId(){ return $this->id;}
	public function getFName(){ return $this->fname;}
	public function getLName(){ return $this->lname;}
	public function getUName(){ return $this->uname;}
	public function getPassword(){ return $this->password;}	
	public function getULevel(){ return $this->ulevel;}
	
	
	// save record
	public function save(){
		$passowrd = $this -> getPassword();
		//$passowrd = cipher::encrypt($passowrd);
	
		$query = sprintf("	INSERT INTO users (fname,lname,username,password,level) VALUES ('%s','%s','%s','%s','%s')",
							$this -> getFName(),
							$this -> getLName(),
							$this -> getUName(),
							$passowrd,
							$this -> getULevel());
		
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
	
	
	// update record
	public function update(){
		
		$query = sprintf("	UPDATE users SET fname='%s', lname='%s', username='%s', level='%s'
						 	WHERE id='%s'",
							$this -> getFName(),
							$this -> getLName(),
							$this -> getUName(),
							$this -> getULevel(),
							$this->getId());
		
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
	
	// update user profile record
	public function updateProfile(){
		
		$query = sprintf("	UPDATE users SET fname='%s', lname='%s'
							WHERE username='%s'",
							$this -> getFName(),
							$this -> getLName(),
							$this -> getUName());
		
		if($result = dbCon::execute_query($query)){
			return true;	
		}
		else return false;
	}
	
	// change the password
	public function changePassword($oldvalue, $newvalue){
		
		$newvalue = dbCon::addslash($newvalue);
		
		$querycheck = sprintf("SELECT * FROM users WHERE password='%s' AND username='%s'",$oldvalue,$this -> getUName());
		
		$resultcheck = dbCon::get_row_count($querycheck);
		
		if($resultcheck == 1){
			$query = sprintf("	UPDATE users SET password='%s'
								WHERE username='%s'",
								$newvalue,
								$this -> getUName());
			
			if($result = dbCon::execute_query($query)){
				return true;	
			}
			else return false;
		}
		else return false;
	}


	// get records
	public function checkUsername($value){
		$query = sprintf("SELECT username FROM users WHERE username='%s'",$value);
		$result = dbCon::get_row_count($query);
		if($result > 0){
			return false;	
		}
		else return true;
	}
	
	// get records
	public function getRecords(){
		$query = sprintf("SELECT * FROM users ORDER BY fname");
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
	
	
	// User Login
	public function authenticate($username,$password){
		
		$query = sprintf("SELECT username FROM users WHERE username='%s' AND password='%s'",$username,$password);
		$result = dbCon::get_row_count($query);
		if($result == 1){
			return true;
		}
		else return false;
	}
	
	// User Login
	public function userLogout(){		
		session_unregister('user');
		return true;
	}
	
	/*// filter records
	public function filterRecords($date){
		$query = sprintf("SELECT * FROM organization WHERE name='%s'",$date);
		if($result = dbCon::execQuery($query)){
			return $result;	
		}
		else return false;
	}*/
	
	// delete records
	public function delete(){
		$query = sprintf("DELETE FROM users WHERE id='%s'",$this->getId());
		if($result = dbCon::execute_query($query)){
			return $result;	
		}
		else return false;
	}
}
?>