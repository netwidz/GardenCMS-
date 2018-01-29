<?php
	$id = $_GET['id'];
	
	$objTestimonial = new testimonials();
	
	$objTestimonial -> testimonials($id);
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {
			
			$('#edittestimonials').ajaxSubmit(function(result) { 
				$("#message").show().html(result).fadeOut(5000);
				window.location.replace('index.php?module=testimonials');
			});
			
		}
	});

	// validate signup form on keyup and submit
	$("#edittestimonials").validate({
		rules: {
			title: "required",
			note: "required"
		},
		messages: {
			title: "&nbsp;Please fill the field",
			note: "&nbsp;Please fill the field"
		}
	});
});
</script>

<p><h2>Edit Testimonial</h2></p>
<form name="edittestimonials" id="edittestimonials" method="post" action="<?php echo $path?>ajax.inc.php">
    <div class="page_controls">
  		<input type="hidden" name="_task" id="_task" value="edit"/>
        <input type="hidden" name="id" id="id" value="<?php echo $id?>"/>
    	<input name="button" id="button" type="submit" value="Update" />
  	</div>
	<div id="modContent">
  	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">Title *</td>
            <td width="83%">
            	<input type="text" name="title" id="title" value="<?php echo $objTestimonial -> getTitle();?>"/>
            </td>
          </tr>
          <tr>
            <td width="17%">Name </td>
            <td width="83%">
            	<input type="text" name="name" id="name" value="<?php echo $objTestimonial -> getName();?>"/>
            </td>
          </tr>
          <tr>
            <td width="17%">Email</td>
            <td width="83%">
            	<input type="text" name="email" id="email" readonly="readonly" value="<?php echo $objTestimonial -> getEmail();?>"/>
            </td>
          </tr>
          <tr>
            <td valign="top">Description *</td>
            <td><textarea name="note" id="note" class="txtarea"><?php echo $objTestimonial -> getNote();?></textarea></td>
          </tr>
          <tr>
            <td valign="top">Status</td>
            <td>
            	<select name="status" id="status">
                	<option value="1" <?php if($objTestimonial -> getStatus() == 1) echo "selected"?>>Inactive</option>
                	<option value="2" <?php if($objTestimonial -> getStatus() == 2) echo "selected"?>>Active</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>