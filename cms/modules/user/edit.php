<?php
	$id = $_GET['id'];
	
	$objUsers = new user();
	
	$objUsers -> user('id',$id);
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {			
			
			var fname = $.trim($("#fname").val());
			var lname = $.trim($("#lname").val());
			var uname = $.trim($("#uname").val());
			var pwd = $.trim($("#pwd").val());
			var level = $.trim($("#ulevel").val());

			var postdata = "id="+<?php echo $id?>+"&fname="+fname+"&lname="+lname+"&uname="+uname+"&ulevel="+level+"&_task=edit";
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
			uname: "required",
			pwd: "required",
			cpwd: {
				required : true,
				equalTo : '#pwd'
			}
		},
		messages: {
			fname: "&nbsp;Please fill the field",
			lname: "&nbsp;Please fill the field",
			uname: "&nbsp;Please fill the field",
			pwd: "&nbsp;Please fill the field",
			cpwd: {
				required : "&nbsp;Please fill the field",
				equalTo : "Password mis-match",
			}
		}
	});
});
</script>
<p>
<h2>Edit User Details</h2></p>
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
            <td>User Level</td>
            <td>
            	<select name="ulevel" id="ulevel">
                	<option value="0" 
                    	<?php if($objUsers -> getULevel()==0) echo "selected"?>>Employee</option>
                	<option value="1"
                    	<?php if($objUsers -> getULevel()==1) echo "selected"?>>Admin</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>