<?php 
	$objContact = new contact();
	$path = $module['modulepath']; //echo $path;
?>
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript" src="js/jquery.datePicker.js"></script>
<link rel="stylesheet" href="css/datePicker.css" type="text/css" media="screen" />

<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-pick').datePicker({startDate:'01 Jan 2010'}).val(new Date().asString()).trigger('change');
	
	$('.delete').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to delete this contact response?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "delete"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=contact';
			});
		}
	});
	
	$('#filter').livequery('click',function(){
		
		var date = $('#date').val();
		//alert(date);
		if(date){
			$.post("<?php echo $path?>ajax.inc.php", {
				date: ""+date+"",_task: "filter"},
				function(data){ 
					$("#records").show().html(data);
			}); 
		}
		else{
			$("#message").show().html('Please choose a date to filter.').addClass('warning');
		}
	});
});
</script>
<p><h2>Contact Responses</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
    	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td width="18%" align="left">Filter By Response Date:</td>
            <td width="20%" align="left"><input type="text" name="date" id="date" class="date-pick"/></td>
            <td width="62%" align="left"><input name="filter" id="filter" type="button" value="Filter" /></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
	</div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
          <tr>
            <th width="25%">Name</th>
            <th width="20%">Email</th>
            <th width="20%">Telephone</th>
            <th width="17%">Date</th>
            <th width="18%">Action</th>
          </tr>
        </table>
        <div id="records">
            <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
              <?php
                $result = $objContact -> getRecords();
                while($array = mysql_fetch_assoc($result)){
              ?>
              <tr>
                <td width="25%"><?php echo $array['name']?></td>
                <td width="20%"><?php echo $array['email']?></td>
                <td width="20%"><?php echo $array['telephone']?></td>
                <td width="17%"><?php echo date('d M Y H:i:s',strtotime($array['date']))?></td>
                <td width="18%">
                	[<a id="viewContact" href="modules/contact/view.php?id=<?php echo $array['id']?>">View</a>]&nbsp;
                    [<a id="viewContact" href="modules/contact/reply.php?id=<?php echo $array['id']?>">Reply</a>]&nbsp;
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