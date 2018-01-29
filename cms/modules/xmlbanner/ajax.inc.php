<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	
	$objXMLBanner = new xmlbanner();	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	
	if(isset($_POST['_task']) && ($_POST['_task']=='add')){
		//echo "<pre>";print_r($_FILES);echo "</pre>";
		//$x = $objXMLBanner -> writeXML(); echo $x;	
		
		$picture = array();
		$picture = $_FILES;
		//echo "<pre>";print_r($picture);echo "</pre>";
		
		if(!empty($picture['picture']['name'])){
			
			$objXMLBanner -> setName(dbCon::addslash($_POST['name']));
			$objXMLBanner -> setText(dbCon::addslash($_POST['text']));
			$objXMLBanner -> setLink(dbCon::addslash($_POST['link']));
			$objXMLBanner -> setTarget(dbCon::addslash($_POST['target']));
			$objXMLBanner -> setImgName($picture['picture']['name']);
			$objXMLBanner -> setImgDuration($_POST['duration']);
			$objXMLBanner -> setStatus($_POST['mode']);
			
			$result = $objXMLBanner -> uploadPic($picture);
			
			if($result=='1'){
				//echo 'OK';
				if($x = $objXMLBanner -> save()){ echo "<div class='success'>Picture Uploaded</div>"; }
			}
			else echo $result;
		}
		else echo "<div class='warning'>Please fill the required fields</div>";
		
		exit(0);
	}
	
	elseif(isset($_POST['_task']) && ($_POST['_task']=='edit')){
		
		//echo "<pre>";print_r($_POST);echo "</pre>";
		
		$objXMLBanner -> setId($_POST['id']);
		
		$objXMLBanner -> setName(dbCon::addslash($_POST['name']));
		$objXMLBanner -> setText(dbCon::addslash($_POST['text']));
		$objXMLBanner -> setLink(dbCon::addslash($_POST['link']));
		$objXMLBanner -> setTarget(dbCon::addslash($_POST['target']));
		$objXMLBanner -> setImgDuration($_POST['duration']);
		$objXMLBanner -> setStatus($_POST['mode']);
		
		if($result = $objXMLBanner -> update()){
			echo "<div class='success'>Picture Updated</div>"; 
		}
		else echo "<div class='warning'>Unable to update the picture</div>";
		
		exit(0);
	}
	
	elseif(isset($_POST['_task']) && ($_POST['_task']=='delete')){
		
		$objXMLBanner -> setId($_POST['cid']);
		//$result = $objXMLBanner -> delete(); echo $result;
		if($result = $objXMLBanner -> delete()){
			echo "<div class='success'>Picture Deleted</div>"; 
		}
		else echo "<div class='warning'>Unable to delete the picture</div>";
		
		exit(0);
	}
}
?>