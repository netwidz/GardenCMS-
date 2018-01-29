<?php 
require_once('../../../config.inc.php');
require_once ('../../../classes/imageCropper.class.php');
$objCropper = new imageCropper();


	//Image Locations
	$large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
	$thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];
       

	
	//Create the upload directory with the right permissions if it doesn't exist
	if(!is_dir($upload_dir)){
		mkdir($upload_dir, 0777);
		chmod($upload_dir, 0777);
	}
	
	//Check to see if any images with the same name already exist
	if (file_exists($large_image_location)){
		if(file_exists($thumb_image_location)){
			$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name.$_SESSION['user_file_ext']."\" alt=\"Thumbnail Image\"/>";
		}else{
			$thumb_photo_exists = "";
		}
	   	$large_photo_exists = "<img src=\"".$upload_path.$large_image_name.$_SESSION['user_file_ext']."\" alt=\"Large Image\"/>";
	} else {
	   	$large_photo_exists = "";
		$thumb_photo_exists = "";
	}

	if (isset($_POST["upload"])) { 
		//Get the file information
		$userfile_name = $_FILES['image']['name'];
		$userfile_tmp = $_FILES['image']['tmp_name'];
		$userfile_size = $_FILES['image']['size'];
		$userfile_type = $_FILES['image']['type'];
		$filename = basename($_FILES['image']['name']);
		$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
		
		//Only process if the file is a JPG, PNG or GIF and below the allowed limit
		if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
			
			foreach ($allowed_image_types as $mime_type => $ext) {
				//loop through the specified image types and if they match the extension then break out
				//everything is ok so go and check file size
				if($file_ext==$ext && $userfile_type==$mime_type){
					$error = "";
					break;
				}else{
					$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
				}
			}
			//check if the file size is above the allowed limit
			if ($userfile_size > ($max_file*1048576)) {
				$error.= "Images must be under ".$max_file."MB in size";
			}
			
		}
	//Everything is ok, so we can upload the image.
	if (strlen($error)==0){
		
		if (isset($_FILES['image']['name'])){
			//this file could now has an unknown file extension (we hope it's one of the ones set above!)
			$large_image_location = $large_image_location.".".$file_ext;
			$thumb_image_location = $thumb_image_location.".".$file_ext;
			
			//put the file ext in the session so we know what file to look for once its uploaded
			$_SESSION['user_file_ext']=".".$file_ext;
			
			move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);
			
			$width = $objCropper->getWidth($large_image_location);
			$height = $objCropper->getHeight($large_image_location);
                        echo $width.'dddsdssds'.$height;
			//Scale the image if it is greater than the width set above
			if ($width > $max_width){
				$scale = $max_width/$width;
				$uploaded = $objCropper->resizeImage($large_image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = $objCropper->resizeImage($large_image_location,$width,$height,$scale);
			}
			//Delete the thumbnail file so the user can create a new one
			if (file_exists($thumb_image_location)) {
				unlink($thumb_image_location);
			}
		}
		//Refresh the page to show the new uploaded image
		header("location:".$_SERVER["PHP_SELF"]);
		exit();
	}
}

	if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
		//Get the new coordinates to crop the image.
		$x1 = $_POST["x1"];
		$y1 = $_POST["y1"];
		$x2 = $_POST["x2"];
		$y2 = $_POST["y2"];
		$w = $_POST["w"];
		$h = $_POST["h"];
		//Scale the image to the thumb_width set above
		$scale = $thumb_width/$w;
		$cropped = $objCropper->resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale);
                //Reload the page again to view the thumbnail
		header("location:index.php");
		exit();
	}

     






?>