<?php 
	$id = $_GET['id'];
	
	$objPages = new pages();
	
	$objPages -> pages($id);
	
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="utils/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/tinyrte.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	
		// Cancel button
		$('#btncancel').click(function(){window.location.replace("index.php?module=pages");});
	
		$.validator.setDefaults({
			submitHandler: function() {	
				
				$('#page').bind('form-pre-serialize', function(e) {
					tinyMCE.triggerSave();
				});
				
				$('#page').ajaxSubmit(function(result) { 
					$("#message").show().html(result).fadeOut(5000);
					window.location.replace('index.php?module=pages');
				});
			}
		});
		
		// validate signup form on keyup and submit
		$("#page").validate({
			rules: {
				title: "required"
			},
			messages: {
				title: "&nbsp;Please fill the field"
			}
		});		
		
	});	
</script>
<p><h2>Module Title</h2></p>
<form name="page" id="page" method="post" action="<?php echo $path?>ajax.inc.php">
    <div class="page_controls">
    	<input name="_task" id="_task" type="hidden" value="edit" />
        <input name="id" id="id" type="hidden" value="<?php echo $id?>" />
        <input name="banner" id="banner" type="hidden" value="<?php echo $objPages -> getBanner();?>" />
      	<input name="button" id="button" type="submit" value="Submit Content" />
        <input name="btncancel" id="btncancel" type="button" value="Cancel" />
    </div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td>Browser Title</td>
          </tr>
          <tr>
            <td><input name="title" id="title" type="text" value="<?php echo $objPages -> getTitle();?>" class="txtlarge"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Banner Image (JPG - 979 x 200, Max: 200KB)</td>
          </tr>
          <tr>
            <td><input type="file" name="picture" id="picture" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Mode</td>
          </tr>
          <tr>
            <td>
            	<select name="mode" id="mode" class="selectlarge">
                	<option value="1">Open in the same window</option>
                	<option value="2">Open in another window</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Page Content</td>
          </tr>
          <tr>
            <td>
            	<textarea id="content" name="content" rows="25" cols="80" style="width:97%" class="tinymce">
					<?php echo $objPages -> getText();?>
                </textarea>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Meta - Keywords</td>
          </tr>
          <tr>
            <td><textarea name="keywords" id="keywords" class="txtarea"><?php echo $objPages -> getKeywords();?></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Meta - Description</td>
          </tr>
          <tr>
            <td><textarea name="description" id="description" class="txtarea"><?php echo $objPages -> getDescription();?></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        
    </div>
</form>