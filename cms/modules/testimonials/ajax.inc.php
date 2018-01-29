<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	$objTestimonial = new testimonials();
	
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
	
	// reply-emails
	if(isset($_POST['_task']) && ($_POST['_task']=='edit')){
		//echo "<pre>";print_r($_POST);echo "</pre>";
		
		$objTestimonial -> setId($_POST['id']);
		$objTestimonial -> setName(dbCon::addslash($_POST['name']));
		$objTestimonial -> setTitle(dbCon::addslash($_POST['title']));
		$objTestimonial -> setNote(dbCon::addslash($_POST['note']));
		$objTestimonial -> setStatus($_POST['status']);
		
		if($objTestimonial -> update()){
			echo "<div class='success'>Testimonial updated successfully.</div>";
		}
		else echo "<div class='warning'>Unable to update the testimonial.</div>";
		
	}
	
	// delete contact response
	if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
	
		$objTestimonial -> setId($_POST['cid']);
		/*$x = $objPages -> update();
		echo $x;*/
		if($objTestimonial -> delete()){
			echo "<div class='success'>Testimonial deleted successfully</div>";
		}
		else echo "<div class='warning'>Unable to delete the testimonial</div>";
	}
}
?>