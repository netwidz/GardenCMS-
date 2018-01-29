<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start(); //Do not remove this
//only assign a new timestamp if the session variable is empty
if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
    $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
	$_SESSION['user_file_ext']= "";
}

require_once('../../../config.inc.php');


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


$objCropper = new imageCropper();



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="" />
	<title>Jquery image upload &amp; crop</title>
	<script type="text/javascript" src="../../js/jquery-pack.js"></script>
	<script type="text/javascript" src="../../js/jquery.imgareaselect.min.js"></script>

      
</head>
<body>
  <?php
//Only display the javacript if an image has been uploaded
if(strlen($large_photo_exists)>0){
	$current_large_image_width = $objCropper->getWidth($large_image_location);
	$current_large_image_height = $objCropper->getHeight($large_image_location);?>
        <script type="text/javascript">

    function preview(img, selection) {

	var scaleX = <?php echo $thumb_width; ?> / selection.width;
	var scaleY =<?php echo $thumb_height;?> / selection.height;

	$("#thumbnail + div > img").css({
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px',
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: "-" + Math.round(scaleX * selection.x1) + "px",
		marginTop: "-" + Math.round(scaleY * selection.y1) + "px"
	});
	$("#x1").val(selection.x1);
	$("#y1").val(selection.y1);
	$("#x2").val(selection.x2);
	$("#y2").val(selection.y2);
	$("#w").val(selection.width);
	$("#h").val(selection.height);
        $
}


$(document).ready(function () {


        $("#upload_img").click(function() {
          var file = $("#img").val();
          var dataString = 'upload';
          if(file==0){

              alert("false");
              return false;
          }else{
             alert(file);
            $.ajax({
                type: "POST",
                url: "ajax.inc.php",
                data: dataString,
                cache: false,
                success: function(html){



            }
            });


              return true;
          }



        });

	$("#save_thumb").click(function() {
		var x1 = $("#x1").val();
		var y1 = $("#y1").val();
		var x2 = $("#x2").val();
		var y2 = $("#y2").val();
		var w = $("#w").val();
		var h = $("#h").val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			return true;
		}
	});
});

$(window).load(function () {
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview });
});

</script><?php }?>

<h1>Photo Upload and Crop</h1>


<?php
//Display error message if there are any
if(strlen($error)>0){
	echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";
}
if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
	echo $large_photo_exists."<br/>".$thumb_photo_exists;
	echo "<p><a href=\"ajax.inc.php?a=delete&t=".$_SESSION['random_key'].$_SESSION['user_file_ext']."\">Delete images</a></p>";
	echo "<p><a href=\"index.php\">Upload another</a></p>";
	//Clear the time stamp session and user file extension
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
}else{
		if(strlen($large_photo_exists)>0){?>

		<h2>Create Thumbnail</h2>
		<div align="center">
                    <img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
			<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
				<img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" style="position: relative;" alt="Thumbnail Preview" />
			</div>
			<br style="clear:both;"/>

                        <form name="thumbnail" action="ajax.inc.php" method="post">
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
				<input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" />
			</form>
		</div>
	<hr />
<?php 	} ?>
	<h2>Upload Photo</h2>
	<form name="photo" enctype="multipart/form-data" action="ajax.inc.php" method="post">
	Photo <input type="file" name="image" id="img" size="30" /> <input type="submit" id="upload_img" name="upload" value="Upload" />
	</form>
<?php } ?>
</body>
</html>