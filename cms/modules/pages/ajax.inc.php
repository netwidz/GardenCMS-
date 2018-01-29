<?php
require_once('../../../config.inc.php');

if(isset($_POST)){	
	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	
	$objPages = new pages();
	
	// save new page
	if(isset($_POST['_task']) && ($_POST['_task']=='add')){
	
		//if(!empty($_POST['content'])){
			
			//echo "<pre>";print_r($_FILES);echo "</pre>";
			
			// upload the picture
			if(!empty($_FILES['picture']['name'])){
				
				$picture = array();
				$picture = $_FILES;
				
				$objPages -> setBanner(trim($_FILES['picture']['name']));
				
				$objPages -> uploadPic($picture);
			}
			
			$objPages -> setTitle(dbCon::addslash($_POST['title']));
			$objPages -> setMode(trim($_POST['mode']));
			$objPages -> setText(dbCon::addslash($_POST['content']));
			$objPages -> setKeywords(dbCon::addslash($_POST['keywords']));
			$objPages -> setDescription(dbCon::addslash($_POST['description']));
			
			if($objPages -> save()){
				echo '<div class="ui-state-success ui-corner-all" style="padding:0.7em;">Page created successfully</div>';
			}
			else echo '<div class="ui-state-error ui-corner-all" style="padding:0.7em;">Unable to create the page</div>';
		//}
//		else{
//			echo "<div class='warning'>Please fill the required fields</div>";
//		}
	}
	
	// update new page
	if(isset($_POST['_task']) && ($_POST['_task']=='edit')){
	
		//if(!empty($_POST['content'])){
			
	
			// upload the picture
			if(!empty($_FILES['picture']['name'])){				
				$picture = array();
				$picture = $_FILES;
				
				$objPages -> setBanner($_FILES['picture']['name']);
				$objPages -> uploadPic($picture);
			}
			else{
				$objPages -> setBanner($_POST['banner']);
			}
			
			$objPages -> setId($_POST['id']);
			$objPages -> setTitle(dbCon::addslash($_POST['title']));
			$objPages -> setMode(trim($_POST['mode']));
			$objPages -> setText(dbCon::addslash($_POST['content']));
			$objPages -> setKeywords(dbCon::addslash($_POST['keywords']));
			$objPages -> setDescription(dbCon::addslash($_POST['description']));
			
			//$x = $objPages -> update(); echo $x;
			
			if($objPages -> update()){
				echo '<div class="ui-state-success ui-corner-all" style="padding:0.7em;">Page content updated successfully</div>';
			}
			else echo '<div class="ui-state-error ui-corner-all" style="padding:0.7em;">Unable to update page content</div>';
			
		//}
//		else{
//			echo "<div class='warning'>Please fill the required fields</div>";
//		}
	}
	
	// search content page
	if(isset($_POST['_task']) && ($_POST['_task']=='search')){
	
		$field = $_POST['mode'];
		$value = trim($_POST['search']);
		
		//$result = $objPages -> searchPages($field,$value);
		
		if($result = $objPages -> searchPages($field,$value)){
			//echo $result;
			
			$records = '<table width="100%" border="0" cellpadding="0" cellspacing="2">';
						
						while($array = mysql_fetch_assoc($result)){	
			
							if($array['type']==1){
								$link = '<input name="link" id="link" type="text" readonly="true" value="page.php?id='.$array['id'].'" />';
								$delete = '[<a href="javascript:void(0)" id="'.$array['id'].'" class="delete">Delete</a>]';
							}
							else{
								$link = '--'; $delete = '';
							}
							
			$records .= '<tr>
							<td width="35%">'.$array['title'].'</td>
                			<td width="30%">'.$link.'</td>
							<td width="15%"><a id="viewContact" href="../images/home/'.$array['banner'].'">View</a></td>
							<td width="20%">[<a href="index.php?module=pages&action=edit&id='.$array['id'].'">Edit</a>]&nbsp;'.$delete.'</td>
						  </tr>';
						}
			$records .= '</table>';
			
			echo $records;
		}
		else echo '<div class="ui-state-error ui-corner-all" style="padding:0.7em;">Records Not Found !</div>';
	}
	
	// delete content page
	if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
	
		$objPages -> setId($_POST['cid']);
		/*$x = $objPages -> update();
		echo $x;*/
		if($objPages -> delete()){
			echo '<div class="ui-state-success ui-corner-all" style="padding:0.7em;">Page content deleted successfully</div>';
		}
		else echo '<div class="ui-state-error ui-corner-all" style="padding:0.7em;">Unable to delete the page</div>';
	}
	
	// remove page banner
	if(isset($_POST['_task']) && ($_POST['_task']=='removeb')){
	
		$objPages -> setId($_POST['cid']);
		/*$x = $objPages -> update();
		echo $x;*/
		if($objPages -> remove_banner()){
			echo '<div class="ui-state-success ui-corner-all" style="padding:0.7em;">Page banner deleted successfully</div>';
		}
		else echo '<div class="ui-state-error ui-corner-all" style="padding:0.7em;">Unable to delete the page</div>';
	}
}
?>