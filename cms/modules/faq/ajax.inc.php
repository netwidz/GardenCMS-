<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	
	$objFAQ = new faq();
	
	if(isset($_POST['_task']) && ($_POST['_task']=='filter')){
		// Filter Contact Responses
		$date = date('Y-m-d',strtotime($_POST['date']));
		//$date = '15-04-2010';
		$result = lost::filterRecords($date);
		
		//echo $result;
		$records = '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
					while($array = mysql_fetch_assoc($result)){
		$records .= '<tr>
						<td width="45%">'.dbCon::removeslash($array['title']).'</td>
						<td width="20%">'.$array['date'].'</td>
						<td width="20%">[<a id="viewContact" href="modules/lost/view.php?id='.$array['id'].'">View</a>]</td>
						<td width="15%">[<a href="index.php?module=lost&action=edit&id='.$array['id'].'">Edit</a>]&nbsp;[<a href="javascript:void(0)" id="'.$array['id'].'" class="delete">Delete</a>]</td>
					  </tr>';
					}
		$records .= '</table>';
		
		echo $records;
		
		exit(0);
	}
	
	// save new user
	if(isset($_POST['_task']) && ($_POST['_task']=='add')){
	
		
		$objFAQ -> setTitle(dbCon::addslash($_POST['title']));
		$objFAQ -> setFAQAnswer(dbCon::addslash($_POST['answer']));
		
		if($objFAQ -> save()){
			echo "<div class='success'>Record added successfully</div>";
		}
		else echo "<div class='warning'>Unable to add the record</div>";
	}
	
	// update the record
	if(isset($_POST['_task']) && ($_POST['_task']=='edit')){
	
		$objFAQ -> setId($_POST['id']);
	
		$objFAQ -> setTitle(dbCon::addslash($_POST['title']));
		$objFAQ -> setFAQAnswer(dbCon::addslash($_POST['answer']));
		
		/*$x = $objUser -> update();
		echo $x;*/
		if($objFAQ -> update()){
			echo "<div class='success'>Record updated successfully</div>";
		}
		else echo "<div class='warning'>Unable to update the record</div>";
	}
	
	
	// delete content page
	if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
	
		$objFAQ -> setId($_POST['cid']);
		/*$x = $objPages -> update();
		echo $x;*/
		if($objFAQ -> delete()){
			echo "<div class='success'>FAQ deleted successfully</div>";
		}
		else echo "<div class='warning'>Unable to delete the user</div>";
	}
}
?>