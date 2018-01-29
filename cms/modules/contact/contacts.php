<?php

$path = $module['modulepath']; //echo $path;

$objContact = new contact();

?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {
			
			$('#generate-contacts').ajaxSubmit(function(result) { 
				//$("#message").show().html(result);
				$("textarea#list").val(result).css({'background-color' : '#FFF9FF', 'border' : '1px solid #d0d0d0'});

			});
			
		}
	});

	// validate signup form on keyup and submit
	$("#generate-contacts").validate({
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
<p><h2>Generate Contact List</h2></p>
<form name="generate-contacts" id="generate-contacts" method="post" action="modules/contact/ajax.inc.php">
    <div class="page_controls">
    	<input type="hidden" name="_task" id="_task" value="generatelist">
    	<input name="button" id="button" type="submit" value="Generate" />
  	</div>
<div id="modContent">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="15%">Title</td>
            <td width="85%">Generate From</td>
          </tr>
          <tr>
            <td valign="top">
            	<select name="separator" id="separator">
                	<option value=",">Comma (,)</option>
                	<option value=";">Semicolon (;)</option>
                </select>
            </td>
            <td>
            	<select name="table" id="table">
                	<option value="messages">Web Contacts</option>
                	<option value="testimonials">Testimonials</option>
                </select>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">Contact List</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="list" id="list" style="width:600px;" rows="15"></textarea></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>
