<?php 
	$objOrg = new organization();
	$path = $module['modulepath']; //echo $path;
	
	$objOrg -> organization(1);
?>

<!--<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="utils/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/tinyrte.js"></script>-->
<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.setDefaults({
		submitHandler: function() {
			
			/*$('#page').bind('form-pre-serialize', function(e) {
				tinyMCE.triggerSave();
			});*/
			
			$('#page').ajaxSubmit(function(result) { 
				$("#message").show().html(result).fadeOut(5000);
			});
			
		}
	});

	// validate signup form on keyup and submit
	$("#page").validate({
		rules: {
			name: "required",
			address: "required",
			city: "required",
			state: "required",
			zipcode: "required",
			telephone: "required",
			email: {
				/*required : true,*/
				email : true
			}
		},
		messages: {
			name: "&nbsp;Please fill the field",
			address: "&nbsp;Please fill the field",
			city: "&nbsp;Please fill the field",
			state: "&nbsp;Please fill the field",
			zipcode: "&nbsp;Please fill the field",
			telephone: "&nbsp;Please fill the field",
			email: {
				/*required : "&nbsp;Please fill the field",*/
				email : "&nbsp;Invalid email address"
			}
		}
	});
});
</script>
<p><h2>Organization Details</h2></p>
<form name="page" id="page" method="post" action="<?php echo $path?>ajax.inc.php">
    <div class="page_controls">
    	<input name="_task" id="_task" type="hidden" value="edit" />
    	<input name="button" id="button" type="submit" value="Update" />
  	</div>
<div id="modContent">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="17%">Organization *</td>
            <td width="83%">
            	<input type="text" name="name" id="name" 
                	value="<?php if($objOrg -> getName()) echo $objOrg -> getName();?>"/>
            </td>
          </tr>
          <tr>
            <td>Address *</td>
            <td>
       	    <input type="text" name="address" id="address"
                	value="<?php if($objOrg -> getAddress()) echo $objOrg -> getAddress();?>"/></td>
          </tr>
          <tr>
            <td>City *</td>
            <td>
       	    <input type="text" name="city" id="city" 
                	value="<?php if($objOrg -> getCity()) echo $objOrg -> getCity();?>"/></td>
          </tr>
          <tr>
            <td>State *</td>
            <td>
       	    <input type="text" name="state" id="state" 
                	value="<?php if($objOrg -> getState()) echo $objOrg -> getState();?>"/></td>
          </tr>
          <tr>
            <td>Zip Code *</td>
            <td>
       	    <input type="text" name="zipcode" id="zipcode" 
                	value="<?php if($objOrg -> getZipCode()) echo $objOrg -> getZipCode();?>"/></td>
          </tr>
          <tr>
            <td>Telephone *</td>
            <td>
       	    <input type="text" name="telephone" id="telephone" 
                	value="<?php if($objOrg -> getTelephone()) echo $objOrg -> getTelephone();?>"/></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>
       	    <input type="text" name="email" id="email" 
            		value="<?php if($objOrg -> getEmail()) echo $objOrg -> getEmail();?>"/></td>
          </tr>
          <tr>
            <td valign="top">Google Map Link<br/>
            (600 x 400)</td>
            <td valign="top"><textarea name="gmap" id="gmap" class="txtarea"><?php if($objOrg -> getGmap()) echo dbCon::removeslash($objOrg -> getGmap());?></textarea></td>
          </tr>
          <!--<tr>
            <td valign="top">Manual Direction</td>
            <td><textarea id="direction" name="direction" rows="15" cols="80" style="width:97%" class="tinymce"><?php //echo $objOrg -> getDirection();?></textarea></td>
          </tr>
          <tr>
            <td valign="top">Why Bronx Medical ?</td>
            <td valign="top"><textarea name="note" id="note" class="txtarea"><?php //if($objOrg -> getNote()) echo dbCon::removeslash($objOrg -> getNote());?></textarea></td>
          </tr>
          <tr>
            <td valign="top">Contact Note</td>
            <td valign="top"><textarea name="contactnote" id="contactnote" class="txtarea"><?php //if($objOrg -> getContactNote()) echo $objOrg -> getContactNote();?></textarea></td>
          </tr>-->
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
      </table>     
  </div>
</form>