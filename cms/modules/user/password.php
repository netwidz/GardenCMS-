<?php
	$user = $_SESSION['user'];
	
	$objUsers = new user();
	
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {			
			
			var oldpwd = $.trim($("#oldpwd").val());
			var newpwd = $.trim($("#newpwd").val());

			var postdata = "oldpwd="+oldpwd+"&newpwd="+newpwd+"&_task=pwd";
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
	$("#change").validate({
		rules: {
			oldpwd: "required",
			newpwd: {
				required : true,
				minlength : 5
			},
			cnewpwd: {
				required : true,
				equalTo : "#newpwd",
				minlength : 5
			}
		},
		messages: {
			oldpwd: "&nbsp;Please fill the field",
			newpwd: {
				required : "&nbsp;Please fill the field",
				minlength : "&nbsp;Min 5 letters"
			},
			cnewpwd: {
				required : "&nbsp;Please fill the field",
				equalTo : "&nbsp;Password mis-match",
				minlength : "&nbsp;Min 5 letters"
			}
		}
	});
	
	
});
</script>
<p>
<h2>Change Your Password</h2></p>
<form name="change" id="change" method="post">
    <div class="page_controls">
    	<input name="button" id="button" type="submit" value="Update" />
  	</div>
	<div id="modContent">
 	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">Old Password *</td>
            <td width="83%">
            	<input type="password" name="oldpwd" id="oldpwd"/>
            </td>
          </tr>
          <tr>
            <td>New Password *</td>
            <td>
       	    <input type="password" name="newpwd" id="newpwd"/></td>
          </tr>
          <tr>
            <td>Confirm Password *</td>
            <td>
       	    <input type="password" name="cnewpwd" id="cnewpwd"/></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
    </table>
   </div>
</form>