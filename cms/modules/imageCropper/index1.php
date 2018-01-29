<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start(); //Do not remove this
//only assign a new timestamp if the session variable is empty
if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
    $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
	$_SESSION['user_file_ext']= "";
}

require_once('../../../config.inc.php');

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

<script type="text/javascript">

    function preview(img, selection) {
	var scaleX = <?php echo $thumb_width; ?> / selection.width;
	var scaleY =<?php echo $thumb_height;?> / selection.height;

	$("#thumbnail + div > img").css({
		width: Math.round(scaleX * 200) + "px",
		height: Math.round(scaleY * 300) + "px",
		marginLeft: "-" + Math.round(scaleX * selection.x1) + "px",
		marginTop: "-" + Math.round(scaleY * selection.y1) + "px"
	});
	$("#x1").val(selection.x1);
	$("#y1").val(selection.y1);
	$("#x2").val(selection.x2);
	$("#y2").val(selection.y2);
	$("#w").val(selection.width);
	$("#h").val(selection.height);
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
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
});

</script>
<h1>Photo Upload and Crop</h1>
		<h2>Create Thumbnail</h2>
		<div align="center">
                    <?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>
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

	<h2>Upload Photo</h2>
	<form name="photo" enctype="multipart/form-data" action="ajax.inc.php" method="post">
	Photo <input type="file" name="image" id="img" size="30" /> <input type="submit" id="upload_img" name="upload" value="Upload" />
	</form>

</body>
</html>