<?php
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {			
			
			var title = $.trim($("#title").val());
			var answer = $.trim($("#answer").val());
			var date = $.trim($("#date").val());

			var postdata = "title="+title+"&answer="+answer+"&_task=add";
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
	$("#addfaq").validate({
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
<p><h2>Add New Item</h2></p>
<form name="addfaq" id="addfaq" method="post">
    <div class="page_controls">
    	<input name="button" id="button" type="submit" value="Save" />
  	</div>
<div id="modContent">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">Title *</td>
            <td width="83%">
            	<input type="text" name="title" id="title"/>
            </td>
          </tr>
          <tr>
            <td valign="top">Answer *</td>
            <td><textarea name="answer" id="answer" class="txtarea"></textarea></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>