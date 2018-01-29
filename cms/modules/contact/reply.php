<?php
$id = $_GET['id'];
require_once('../../../config.inc.php');

$path = $module['modulepath']; //echo $path;

$objContact = new contact();

$objContact-> contact($id);

?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {
			
			$('#reply-form').ajaxSubmit(function(result) { 
				$("#alert").show().html(result).fadeOut(5000);
				$.fancybox.close();
			});
			
		}
	});

	// validate signup form on keyup and submit
	$("#reply-form").validate({
		rules: {
			subject: "required",
			reply_content: "required"
		},
		messages: {
			subject: "&nbsp;Please fill the field",
			reply_content: "&nbsp;Please fill the field"
		}
	});
});
</script>
<form name="reply-form" id="reply-form" method="post" action="modules/contact/ajax.inc.php">
	<div id="alert" style="display:none;"></div>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>To:</td>
      </tr>
      <tr>
        <td><input type="text" name="to" id="to" readonly="readonly" class="txtlarge" value="<?php echo $objContact->getEmail();?>"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Subject:</td>
      </tr>
      <tr>
        <td><input type="text" name="subject" id="subject" class="txtlarge" value="Inquiry reply - Beautysrus"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Message:</td>
      </tr>
      <tr>
        <td><textarea name="reply_content" id="reply_content" class="txtarea"></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="submit" name="button" id="button" value="Send Mail"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="_task" id="_task" value="reply"/>
</form>
