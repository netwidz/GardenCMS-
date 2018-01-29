<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	$objContact = new contact();
	
	if(isset($_POST['_task']) && ($_POST['_task']=='filter')){
		// Filter Contact Responses
		$date = date('Y-m-d',strtotime($_POST['date']));
		//$date = '15-04-2010';
		$result = contact::filterRecords($date);
		
		//echo $result;
		$records = '<table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">';
					while($array = mysql_fetch_assoc($result)){
		$records .= '<tr>
						<td width="25%">'.$array['name'].'</td>
						<td width="20%">'.$array['email'].'</td>
						<td width="22%">'.$array['telephone'].'</td>
						<td width="15%">'.$array['date'].'</td>
						<td width="18%">[<a id="viewContact" href="modules/contact/view.php?id='.$array['id'].'">View</a>]&nbsp; 
						[<a id="viewContact" href="modules/contact/reply.php?id='.$array['id'].'">Reply</a>]&nbsp;
						[<a href="javascript:void(0)" id="'.$array['id'].'" class="delete">Delete</a>]</td>
					  </tr>';
					}
		$records .= '</table>';
		
		echo $records;
	}
	
	// generate contact list
	if(isset($_POST['_task']) && ($_POST['_task']=='generatelist')){
		//echo "<pre>";print_r($_POST);echo "</pre>";
		$table = $_POST['table'];
		$separator = $_POST['separator'];
		$contact_list = $objContact -> generate_contacts($table, $separator); echo $contact_list;
		/*if($contact_list = $objContact -> generate_contacts($table, $separator)){
			echo $contact_list;
		}
		else{
			echo "<div class='warning' style='width:560px;'>Unable to generate contact list.</div>";
		}*/
		
	}
	
	// reply-emails
	if(isset($_POST['_task']) && ($_POST['_task']=='reply')){
		//echo "<pre>";print_r($_POST);echo "</pre>";
		$objContact -> setEmail($_POST['to']);
		$objContact -> setSubject(dbCon::addslash($_POST['subject']));
		$objContact -> setMessage(dbCon::addslash($_POST['reply_content']));
		//$x = $objContact -> replyEmail(); echo $x;
		if($objContact -> replyEmail()){
			echo "<div class='success' style='width:560px;'>Reply sent successfully</div>";
		}
		else{
			echo "<div class='warning' style='width:560px;'>Unable to send your reply.</div>";
		}
		
	}
	
	// delete contact response
	if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
	
		$objContact -> setId($_POST['cid']);
		/*$x = $objPages -> update();
		echo $x;*/
		if($objContact -> delete()){
			echo "<div class='success'>Contact response deleted successfully</div>";
		}
		else echo "<div class='warning'>Unable to delete the contact response</div>";
	}
}
?>