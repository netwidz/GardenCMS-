<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	
	$objUser = new user();
	
	// check username already exists
	if(isset($_GET['uname'])){
		if($objUser -> checkUsername(dbCon::addslash($_GET['uname']))) echo 'true';
		else echo 'false';
	}
		
	// save new user
	if(isset($_POST['_task']) && ($_POST['_task']=='add')){
	
		$objCipher = new cipher();
		
		$password = $objCipher -> encrypt(dbCon::addslash($_POST['pwd']));
	
		$objUser -> setFName(dbCon::addslash($_POST['fname']));
		$objUser -> setLName(dbCon::addslash($_POST['lname']));
		$objUser -> setUName(dbCon::addslash($_POST['uname']));
		$objUser -> setPassword($password);
		$objUser -> setULevel(trim($_POST['ulevel']));
		
		if($objUser -> save()){
			echo "<div class='success'>User created successfully</div>";
		}
		else echo "<div class='warning'>Unable to create user</div>";
	}
	
	// update new page
	if(isset($_POST['_task']) && ($_POST['_task']=='edit')){
	
		$objUser -> setId($_POST['id']);
	
		$objUser -> setFName(dbCon::addslash($_POST['fname']));
		$objUser -> setLName(dbCon::addslash($_POST['lname']));
		$objUser -> setUName(dbCon::addslash($_POST['uname']));
		$objUser -> setPassword(dbCon::addslash($_POST['pwd']));
		$objUser -> setULevel(trim($_POST['ulevel']));
		
		/*$x = $objUser -> update();
		echo $x;*/
		if($objUser -> update()){
			echo "<div class='success'>User updated successfully</div>";
		}
		else echo "<div class='warning'>Unable to update user</div>";
	}
	
	// edit profile
	if(isset($_POST['_task']) && ($_POST['_task']=='profile')){
	
		$objUser -> setUName($_SESSION['user']);
	
		$objUser -> setFName(dbCon::addslash($_POST['fname']));
		$objUser -> setLName(dbCon::addslash($_POST['lname']));
		
		
		/*$x = $objUser -> update();
		echo $x;*/
		if($objUser -> updateProfile()){
			echo "<div class='success'>Profile updated successfully</div>";
		}
		else echo "<div class='warning'>Unable to update the profile</div>";
	}
	
	// change password
	if(isset($_POST['_task']) && ($_POST['_task']=='pwd')){
	
		$objUser -> setUName($_SESSION['user']);
		
		$objCipher = new cipher();
		
		$oldvalue = $objCipher -> encrypt(dbCon::addslash($_POST['oldpwd']));
		$newvalue = $objCipher -> encrypt(dbCon::addslash($_POST['newpwd']));
		
		if($objUser -> changePassword($oldvalue, $newvalue)){
			echo "<div class='success'>Password updated successfully</div>";
		}
		else echo "<div class='warning'>Invalid old password</div>";
	}
	
	
	// delete content page
	if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
	
		$objUser -> setId($_POST['cid']);
		/*$x = $objPages -> update();
		echo $x;*/
		if($objUser -> delete()){
			echo "<div class='success'>User deleted successfully</div>";
		}
		else echo "<div class='warning'>Unable to delete the user</div>";
	}
}
?>