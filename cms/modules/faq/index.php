<?php 
	$objFAQ = new faq();
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="js/date.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	
	$('.delete').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to delete this item?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "delete"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=faq';
			});
		}
	});
	
	/*$('#filter').livequery('click',function(){
		
		var date = $('#date').val();
		//alert(date);
		if(date){
			$.post("<?php //echo $path?>ajax.inc.php", {
				date: ""+date+"",_task: "filter"},
				function(data){ 
					$("#records").show().html(data);
			}); 
		}
		else{
			$("#message").show().html('Please choose a date to filter.').addClass('warning');
		}
	});*/
});
</script>
<p><h2>FAQ's</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
    	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">
            	<input type="button" name="button" id="button" value="Add New Item" 
                	onclick="window.location='index.php?module=faq&action=add'"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
</div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th width="65%">Title</th>
            <th width="20%">View</th>
            <th width="15%">Action</th>
          </tr>
        </table>
        <div id="records">
            <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
              <?php
                $result = $objFAQ -> getRecords();
                while($array = mysql_fetch_assoc($result)){
              ?>
              <tr>
                <td width="65%"><?php echo $array['faq_title']?></td>
                <td width="20%">[<a id="viewContact" href="modules/faq/view.php?id=<?php echo $array['faq_id']?>">View</a>]</td>
              	<td width="15%">
                	[<a  href="index.php?module=faq&action=edit&id=<?php echo $array['faq_id']?>">Edit</a>]&nbsp;
                    [<a href="javascript:void(0)" id="<?php echo $array['faq_id']?>" class="delete">Delete</a>]
                </td>
              </tr>
              <?php
                }
              ?>
            </table>
        </div>        
    </div>
</form>