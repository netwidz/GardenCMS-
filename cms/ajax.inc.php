<?php
	require_once('../config.inc.php');
   require_once('../classes/user.class.php');
	
	if(isset($_POST)){
	
		$objUser = new user();
		
		// login to the system
		if(isset($_POST['_task']) && ($_POST['_task']=='login')){
			//echo '<pre>';print_r($_POST);echo '</pre>';
			$objCipher = new cipher();
			
			$uname = trim($_POST['username']);
			$password = dbCon::addslash($objCipher -> encrypt(trim($_POST['password'])));
			
			if($objUser -> authenticate($uname,$password)){
				//return true;
				$user = $objUser -> user('username',$uname);
				//echo $user;
				$_SESSION['user'] = $uname;
				
				echo '<script>window.location="index.php?module=category"</script>';
			}
			else echo 'Invalid login details';
		}
			
		//echo $_POST['uname'].'--'.$_POST['pwd'];
		
		if(isset($_POST['_task']) && ($_POST['_task']=='logout')){
			$result = $objUser -> userLogout();
			echo $result;
		}
	}
?>