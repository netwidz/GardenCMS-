<?php 
	
	global $cosmetic;	
	$imgpath = $cosmetic->wwwroot;
	
	$objXMLBanner = new xmlbanner();
	$path = $module['modulepath']; //echo $path;
?>

<link rel="stylesheet" href="../css/calendar.css" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){

	$("a#image").livequery(function(){$(this).fancybox()});

	$('.delete').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to delete this file?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "delete"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=xmlbanner';
			});
		}
	});

	
});
</script>
<p><h2>Flash Image List</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
      <input type="button" name="button" id="button" value="Add Picture" 
            onclick="window.location='index.php?module=xmlbanner&action=add'"/>
    </div>
	<div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
          <tr>
            <th width="35%">Image Name</th>
            <th width="30%">Link</th>
            <th width="10%">Status</th>
            <th width="10%">Image</th>
            <th width="15%">Action</th>
          </tr>
        </table>
        <div id="records">
            <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
              <?php
                $result = $objXMLBanner -> getRecords();
                while($array = mysql_fetch_assoc($result)){
					
					$status = ($array['status']==1) ? "Active" : "Inactive";
              ?>
              <tr>
                <td width="35%"><?php echo $array['name']?></td>
                <td width="30%"><?php echo $array['link']?></td>                
                <td width="10%"><?php echo $status?></td>
                <td width="10%"><a id="image" href="<?php echo $imgpath.'xml-banner/'.$array['imgname']?>">View</a></td>
                <td width="15%">
                	[&nbsp;<a href="index.php?module=xmlbanner&amp;action=edit&amp;id=<?php echo $array['id']?>">Edit</a>&nbsp;]&nbsp;
                	[&nbsp;<a href="javascript:void(0)" id="<?php echo $array['id']?>" class="delete">Delete</a>&nbsp;]
                </td>
              </tr>
              <?php
                }
              ?>
            </table>
        </div>        
    </div>
</form>