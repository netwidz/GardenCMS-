<?php

class utility{

	function __construct(){}
	
	function utility(){
	
	}

	function dispatchRequest(){
		
		global $cosmetic;
		$modulepage = $cosmetic->dirroot;
		
		$module = array();
		
		$currentModule = isset($_REQUEST['module']) ? strtolower($_REQUEST['module']) : null ;
		$action = isset($_REQUEST['action']) ? strtolower($_REQUEST['action']) : null ;
		
		if(empty($currentModule) || $currentModule == null){
							
			$redirectUrl = $cosmetic->webroot. 'login.php';
			//header("location:" . $redirectUrl);
			echo "<script>window.location='".$redirectUrl."'</script>";
				
		}else{
			if(isset($_SESSION['user'])){
				if(!empty($action) && $action != null ) {
					$modulepath = 'modules/'.$currentModule.'/';
					$modulepage .= '/cms/modules/'.$currentModule. '/'.$action.'.php';
				}else {			
					$modulepath = 'modules/'.$currentModule.'/';
					$modulepage .= '/cms/modules/'.$currentModule. '/index.php';
				}
			}
			else{
				$redirectUrl = $cosmetic->webroot. 'login.php';
				//header("location:" . $redirectUrl);
				echo "<script>window.location='".$redirectUrl."'</script>";	
			}
			define('entrypoint',$currentModule);
		}
		
		//$modulepage = str_replace('/','\\',$modulepage);
		
		$module['modulepage'] = $modulepage;
		$module['modulepath'] = $modulepath;
		
		return $module;
	}// request dispatching OK
	
	
	/*
	* authenticate login
	*/
	public function authenticateLogin(){
		if(isset($_SESSION['user'])){
			return true;
		}
		else {
			$redirectUrl = $cosmetic->webroot. 'login.php';
			header("location:" . $redirectUrl);
		}
	}
	
	
	/*
	* customer login
	*/
	public function login($username, $password){
	
		global $cosmetic;
		$path = $cosmetic -> wwwroot;
		
		$query = sprintf("	SELECT customer_id FROM customer 
						 	WHERE (email='%s' AND password='%s' AND status=1 AND approved=1)",$username,$password);
		//return $query;
		if(dbCon::getRowCount($query) == 1){
			
			$array = dbCon::getFetchArray($query);
			
			session_register('customer');
			$objCustomer = new customer();
			$customer = $objCustomer -> customer($array['customer_id']);
			$_SESSION['customer'] = serialize($objCustomer);
			
			// update last login date/time
			$date = date('Y-m-d H:i:s');
			dbCon::execQuery(sprintf("UPDATE customer SET last_login='%s' WHERE email='%s'",$date,$username));
			
			echo "<script>window.location='$path'</script>";
			
			return true;
			
		}
		else return false;
			
	}
	
	
	/*
	* get next order id
	*/
	public function get_order_id(){
	
		$query = sprintf("SELECT CONCAT(order_id_prefix,'-', order_id_no) AS order_id FROM settings");
		$result = dbCon::getFetchArray($query);
		
		return $result['order_id'];
	}
	
	/*
	* update order id
	*/
	public function update_order_id(){
	
		$query = sprintf("UPDATE settings SET order_id_no = order_id_no+1");
		
		if(dbCon::execQuery($query)){
			return true;
		}
		return false;
	
	}
		
	
	/*
	* date format eg: 07/05/2010
	*/
	public function dateFormat($string){
	
		return date('m/d/Y',strtotime($string));
	}
	
	/*
	* price format eg: 10,000.00
	*/
	public function price_format($price){
	
		return number_format($price,2,'.',',');
	}
	
	
	function assign_rand_value($num){
		// accepts 1 - 36
	  	switch($num){
			case "1":
			 $rand_value = "a";
			break;
			case "2":
			 $rand_value = "b";
			break;
			case "3":
			 $rand_value = "c";
			break;
			case "4":
			 $rand_value = "d";
			break;
			case "5":
			 $rand_value = "e";
			break;
			case "6":
			 $rand_value = "f";
			break;
			case "7":
			 $rand_value = "g";
			break;
			case "8":
			 $rand_value = "h";
			break;
			case "9":
			 $rand_value = "i";
			break;
			case "10":
			 $rand_value = "j";
			break;
			case "11":
			 $rand_value = "k";
			break;
			case "12":
			 $rand_value = "l";
			break;
			case "13":
			 $rand_value = "m";
			break;
			case "14":
			 $rand_value = "n";
			break;
			case "15":
			 $rand_value = "o";
			break;
			case "16":
			 $rand_value = "p";
			break;
			case "17":
			 $rand_value = "q";
			break;
			case "18":
			 $rand_value = "r";
			break;
			case "19":
			 $rand_value = "s";
			break;
			case "20":
			 $rand_value = "t";
			break;
			case "21":
			 $rand_value = "u";
			break;
			case "22":
			 $rand_value = "v";
			break;
			case "23":
			 $rand_value = "w";
			break;
			case "24":
			 $rand_value = "x";
			break;
			case "25":
			 $rand_value = "y";
			break;
			case "26":
			 $rand_value = "z";
			break;
			case "27":
			 $rand_value = "0";
			break;
			case "28":
			 $rand_value = "1";
			break;
			case "29":
			 $rand_value = "2";
			break;
			case "30":
			 $rand_value = "3";
			break;
			case "31":
			 $rand_value = "4";
			break;
			case "32":
			 $rand_value = "5";
			break;
			case "33":
			 $rand_value = "6";
			break;
			case "34":
			 $rand_value = "7";
			break;
			case "35":
			 $rand_value = "8";
			break;
			case "36":
			 $rand_value = "9";
			break;
	  	}
		return $rand_value;
	}
	
	
	/*
	* get records from tables: custom made function for use of all the tables
	*/
	public function get_records($table, $fields){
		
		$query = sprintf("SELECT $fields FROM $table");
		$array = dbCon::getFetchRows($query);
		return $array;
	}
	
	/*
	* random string generator
	*/
	public function randomString($length){
		if($length>0){ 
			$rand_id="";
			for($i=1; $i<=$length; $i++){
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,36);
				$rand_id .= self::assign_rand_value($num);
			}
		}
		return strtoupper($rand_id);	
	}
	
	
}
?>