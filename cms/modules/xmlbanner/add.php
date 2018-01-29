<?php $path = $module['modulepath']; //echo $path;?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		// bind 'myForm' and provide a simple callback function 
		$('#page').ajaxForm(function(result) { 
			$("#message").show().html(result).fadeOut(5000);
			window.location.replace('index.php?module=xmlbanner');
		}); 
				
	});	
</script>
<p><h2>Add New Flash Image</h2></p>
<form method="post" enctype="multipart/form-data" name="page" id="page" action="<?php echo $path?>ajax.inc.php">
	<div class="page_controls">
      <input name="button" id="button" type="submit" value="Update Picture" />
    </div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td>Upload Flash Image *</td>
          </tr>
          <tr>
            <td><input type="file" name="picture" id="picture" />
            &nbsp;(JPG,GIF,SWF - 668 x 288, Max: 200KB)</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Name</td>
          </tr>
          <tr>
            <td><input type="text" name="name" id="name" class="txtlarge"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Text </td>
          </tr>
          <tr>
            <td><textarea name="text" id="text" class="txtarea"></textarea>
            (Max. 500 characters)</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Link</td>
          </tr>
          <tr>
            <td><input type="text" name="link" id="link" class="txtlarge"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Target</td>
          </tr>
          <tr>
            <td>
            	<select name="target" id="target" class="selectsmall">
                	<option value="_self">Same Window</option>
                	<option value="_blank">New Window</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Image Duration</td>
          </tr>
          <tr>
            <td><input type="text" name="duration" id="duration" class="txtvsmall"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Control</td>
          </tr>
          <tr>
            <td>
            	<select name="mode" id="mode" class="selectsmall">
                	<option value="1">Active Image</option>
                	<option value="2">Inactive Image</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td><input type="hidden" name="_task" id="_task" value="add" /></td>
          </tr>
        </table>
        
  </div>
</form>