<?php
	$id = $_GET['id'];
	
	$objFAQ = new faq();
	
	$objFAQ -> faq($id);
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		
	$.validator.setDefaults({
		submitHandler: function() {			
			
			var title = $.trim($("#title").val());
			var answer = $.trim($("#answer").val());

			var postdata = "id="+<?php echo $id?>+"&title="+title+"&answer="+answer+"&_task=edit";
			//alert(postdata);
			$.ajax({
			   type: "POST",
			   url: "<?php echo $path?>ajax.inc.php",
			   data: postdata,
			   success: function(data){
			   	 $("#message").show().html(data).fadeOut(5000);
				 window.location.replace('index.php?module=faq');
			   }
			});

		}
	});

	// validate the form on keyup and submit
	$("#editfaq").validate({
		rules: {
			title: "required",
			answer: "required"
		},
		messages: {
			title: "&nbsp;Please fill the field",
			answer: "&nbsp;Please fill the field"
		}
	});
});
</script>
<p>
<h2>Edit Item</h2></p>
<form name="editfaq" id="editfaq" method="post">
    <div class="page_controls">
    	<input name="button" id="button" type="submit" value="Update" />
  	</div>
<div id="modContent">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">Title *</td>
            <td width="83%">
            	<input type="text" name="title" id="title" value="<?php echo $objFAQ -> getTitle();?>"/>
            </td>
          </tr>
          <tr>
            <td valign="top">Description *</td>
            <td><textarea name="answer" id="answer" class="txtarea"><?php echo $objFAQ -> getFAQAnswer();?></textarea></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>