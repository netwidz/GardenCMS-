<?php
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<link rel="stylesheet" href="../css/calendar.css" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {			
			
			var fname = $.trim($("#fname").val());
			var lname = $.trim($("#lname").val());
			var uname = $.trim($("#uname").val());
			var pwd = $.trim($("#pwd").val());
			var level = $.trim($("#ulevel").val());

			var postdata = "fname="+fname+"&lname="+lname+"&uname="+uname+"&pwd="+pwd+"&ulevel="+level+"&_task=add";
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
			lname: "required",
			uname: {
				required : true,
				remote : "<?php echo $path?>ajax.inc.php"
			},
			pwd: {
				required : true,
				minlength : 5
			},
			cpwd: {
				required : true,
				equalTo : '#pwd',
				minlength : 5
			}
		},
		messages: {
			fname: "&nbsp;Please fill the field",
			lname: "&nbsp;Please fill the field",
			uname: {
				required : "&nbsp;Please fill the field",
				remote : "&nbsp;Username already exists"
			},
			pwd: {
				required : "&nbsp;Please fill the field",
				minlength : "&nbsp;Min 5 letters"
			},
			cpwd: {
				required : "&nbsp;Please fill the field",
				equalTo : "&nbsp;Password mis-match",
			}
		}
	});
});
</script>
<p><h2>Add New User</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
    	<input name="button" id="button" type="submit" value="Create" />
  	</div>
<div id="modContent">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">First Name *</td>
            <td width="83%">
            	<input type="text" name="fname" id="fname"/>
            </td>
          </tr>
          <tr>
            <td>Last Name *</td>
            <td>
       	    <input type="text" name="lname" id="lname"/></td>
          </tr>
          <tr>
            <td>Username *</td>
            <td>
       	    <input type="text" name="uname" id="uname"/></td>
          </tr>
          <tr>
            <td>Password *</td>
            <td>
       	    <input type="password" name="pwd" id="pwd"/></td>
          </tr>
          <tr>
            <td>Confirm Password *</td>
            <td>
       	    <input type="password" name="cpwd" id="cpwd"/></td>
          </tr>
          <tr>
            <td>User Level</td>
            <td>
            	<select name="ulevel" id="ulevel">
                	<option value="0">Employee</option>
                	<option value="1">Admin</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>