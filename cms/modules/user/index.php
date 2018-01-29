<?php 
	require_once ('../../../config.inc.php');
    $objUsers = new user();
	//$path = $module['modulepath']; //echo $path;
?>

<link rel="stylesheet" href="../css/calendar.css" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function(){

	$('.delete').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to delete this user?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "delete"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=user';
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
<p><h2>System Users</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
        <input type="button" name="button" id="button" value="Add New User" 
            onclick="window.location='index.php?module=user&action=add'"/>
  </div>
	<div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
          <tr>
            <th width="30%">Name</th>
            <th width="35%">Username</th>
            <th width="15%">User Level</th>
            <th width="20%">Action</th>
          </tr>
        </table>
        <div id="records">
            <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
              <?php
                $result = $objUsers -> getRecords();
                while($array = mysql_fetch_assoc($result)){
              ?>
              <tr>
                <td width="30%"><?php echo ($array['fname'].'&nbsp;'.$array['lname'])?></td>
                <td width="35%"><?php echo $array['username']?></td>
                <td width="15%"><?php $ulevel = ($array['user_level']==0) ? 'Employee' : 'Admin'; echo $ulevel;?></td>
                <td width="20%">
                	[<a href="index.php?module=user&action=edit&id=<?php echo $array['id']?>">Edit</a>]&nbsp;
                	[<a href="javascript:void(0)" id="<?php echo $array['id']?>" class="delete">Delete</a>]
                </td>
              </tr>
              <?php
                }
              ?>
            </table>
        </div>        
    </div>
</form>