<?php
	$user = $_SESSION['user'];
	
	$objUsers = new user();
	
	$objUsers -> user('username',$user);
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {			
			
			var fname = $.trim($("#fname").val());
			var lname = $.trim($("#lname").val());

			var postdata = "fname="+fname+"&lname="+lname+"&_task=profile";
			//alert(postdata);
			$.ajax({
			   type: "POST",
			   url: "<?php echo $path?>ajax.inc.php",
			   data: postdata,
			   success: function(data){
			   	 $("#message").show().html(data).fadeOut(5000);
			   }
			});

		}
	});

	// validate signup form on keyup and submit
	$("#page").validate({
		rules: {
			fname: "required",
			lname: "required"
		},
		messages: {
			fname: "&nbsp;Please fill the field",
			lname: "&nbsp;Please fill the field"
		}
	});
	
	
});
</script>
<p>
<h2>Edit Your Profile</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
    	<input name="button" id="button" type="submit" value="Update" />
  	</div>
	<div id="modContent">
 	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">First Name *</td>
            <td width="83%">
            	<input type="text" name="fname" id="fname" value="<?php echo $objUsers -> getFName();?>"/>
            </td>
          </tr>
          <tr>
            <td>Last Name *</td>
            <td>
       	    <input type="text" name="lname" id="lname" value="<?php echo $objUsers -> getLName();?>"/></td>
          </tr>
          <tr>
            <td>Username *</td>
            <td>
       	    <input type="text" name="uname" id="uname" readonly="readonly" value="<?php echo $objUsers -> getUName();?>"/></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
    </table>
   </div>
</form>