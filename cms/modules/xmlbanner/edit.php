<?php 
	$id = $_GET['id'];
	
	global $cosmetic;	
	$imgpath = $cosmetic->wwwroot;
	
	$objXMLBanner = new xmlbanner();
	
	$objXMLBanner -> xmlbanner($id);
	$path = $module['modulepath']; //echo $path;
?>

<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		// Cancel button
		$('#btncancel').click(function(){window.location.replace("index.php?module=xmlbanner");});
				
		$("a#image").livequery(function(){$(this).fancybox()});
					
		// bind 'myForm' and provide a simple callback function 
		$('#page').ajaxForm(function(result) { 
			$("#message").show().html(result).fadeOut(5000);
			window.location.replace('index.php?module=xmlbanner');
		}); 
		
	});	
</script>
<p><h2>Edit SlideShow Image</h2></p>
<form method="post" enctype="multipart/form-data" name="page" id="page" action="<?php echo $path?>ajax.inc.php">
	<div class="page_controls">
    	<input type="hidden" name="_task" id="_task" value="edit" />
        <input type="hidden" name="id" id="id" value="<?php echo $objXMLBanner -> getId()?>" />
      	<input name="button" id="button" type="submit" value="Update Picture" />
        <input name="btncancel" id="btncancel" type="button" value="Cancel" />
    </div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td>[&nbsp;<a id="image" href="<?php echo $imgpath.'xml-banner/'.$objXMLBanner -> getImgName()?>">View File</a>&nbsp;]</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Name</td>
          </tr>
          <tr>
            <td><input type="text" name="name" id="name" value="<?php echo $objXMLBanner -> getName()?>" class="txtlarge"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Pic Text</td>
          </tr>
          <tr>
            <td><textarea name="text" id="text" class="txtarea"><?php echo $objXMLBanner -> getText()?></textarea>
            (Max. 500 characters)</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Link</td>
          </tr>
          <tr>
            <td><input type="text" name="link" id="link" value="<?php echo $objXMLBanner -> getLink()?>" class="txtlarge" /></td>
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
                	<option value="_self" <?php if($objXMLBanner -> getTarget() == '_self') echo "selected"?>>Same Window</option>
                	<option value="_blank" <?php if($objXMLBanner -> getTarget() == '_blank') echo "selected"?>>New Window</option>
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
            <td><input type="text" name="duration" id="duration" value="<?php echo $objXMLBanner -> getImgDuration()?>" class="txtvsmall"/></td>
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
                	<option value="1" <?php if($objXMLBanner -> getStatus() == 1) echo "selected"?>>Active Image</option>
                	<option value="2" <?php if($objXMLBanner -> getStatus() == 2) echo "selected"?>>Inactive Image</option>
            	</select>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        
  </div>
</form>