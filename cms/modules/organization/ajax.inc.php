<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	$objOrg = new organization();
	
	// delete contact response
	if(isset($_POST['_task']) && ($_POST['_task']=='edit')){
	
		$objOrg -> setId(1);
		
		$objOrg -> setName(dbCon::addslash($_POST['name']));
		$objOrg -> setAddress(dbCon::addslash($_POST['address']));
		$objOrg -> setCity(dbCon::addslash($_POST['city']));
		$objOrg -> setState(dbCon::addslash($_POST['state']));
		$objOrg -> setZipCode(dbCon::addslash($_POST['zipcode']));
		$objOrg -> setTelephone(dbCon::addslash($_POST['telephone']));
		$objOrg -> setEmail(dbCon::addslash($_POST['email']));
		$objOrg -> setGmap(dbCon::addslash($_POST['gmap']));
		/*$objOrg -> setDirection(dbCon::addslash($_POST['direction']));
		$objOrg -> setNote(dbCon::addslash($_POST['note']));
		$objOrg -> setContactNote(dbCon::addslash($_POST['contactnote']));*/
		
		
		/*$x = $objOrg -> update();
		echo $x;*/
		
		if($objOrg -> update()){
			echo "<div class='success'>Details updated successfully</div>";
		}
		else echo "<div class='warning'>Unable to update the details</div>";
	}
}
?>