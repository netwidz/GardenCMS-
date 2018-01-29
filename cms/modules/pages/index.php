<?php 
	$path = $module['modulepath']; //echo $path;
?>

<link rel="stylesheet" href="../css/calendar.css" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){

	$('.delete').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to delete this content page?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "delete"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=pages';
			});
		}
	});
	
	$('a.remove').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to remove this banner image?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "removeb"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=pages';
			});
		}
	});

	$('#filter').click(function(){
		
		var searchtxt = $('#search').val();
		var mode = $('#mode').val();
		//alert(date);
		if(searchtxt){
			$.post("<?php echo $path?>ajax.inc.php", {
				mode: ""+mode+"",search: ""+searchtxt+"",_task: "search"},
				function(data){ 
					$("#message").hide();
					$("#records").show().html(data);
			}); 
		}
		else $("#message").show().html('Please provide the search word').addClass('warning');
	});
});
</script>
<p><h2>Web Contents</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
    	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="17%" colspan="2" align="left">Content Search</td>
          </tr>
          <tr>
            <td align="left">
                <select name="mode" id="mode" class="selectsmall" >
                	<option value="title">Browser Title</option>
                </select>
                <input type="text" name="search" id="search" class="txtsmall" />
                <input name="filter" id="filter" type="button" value="Search" />
            </td>
            <td align="right">
            	<input type="button" name="button" id="button" value="Add Content Item" 
                	onclick="window.location='index.php?module=pages&action=add'"/>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
  </div>
	<div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
          <tr>
            <th width="35%">Browser Title</th>
            <th width="30%">Content URL</th>
            <th width="21%">Banner</th>
            <th width="14%">Action</th>
          </tr>
        </table>
        <div id="records">
            <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
              <?php
              	$objPages = new pages();
                $result = $objPages -> getRecords();
                while($array = mysql_fetch_assoc($result)){
				
				if($array['id']!=14){
					
					if($array['type']==1){
						$link = '<input name="link" id="link" type="text" readonly="true" value="page.php?id='.$array['id'].'" />';
						$delete = '[<a href="javascript:void(0)" id="'.$array['id'].'" class="delete">Delete</a>]';
					}
					else{
						$link = '--'; $delete = '';
					}
					
              ?>
              <tr>
                <td width="35%"><?php echo $array['title']?></td>
                <td width="30%"><?php echo $link?></td>
                <td width="21%">
                	<a id="viewContact" href="../images/home/<?php echo $array['banner']?>">View</a>&nbsp;&nbsp;
                	[<a href="javascript:void(0)" id="<?php echo $array['id']?>" class="remove">Remove</a>]
                </td>
                <td width="14%">
                	[<a href="index.php?module=pages&action=edit&id=<?php echo $array['id']?>">Edit</a>]&nbsp;
                    <?php echo $delete;?>
                </td>
              </tr>
              <?php
				}
                }
              ?>
            </table>
        </div>        
    </div>
</form>