<?php 
	$objTestimonials = new testimonials();
	$path = $module['modulepath']; //echo $path;
?>

<script type="text/javascript">
$(document).ready(function(){
	

	$('.delete').livequery('click',function(){
		var id = $(this).attr('id');
		if(confirm("Do you want to delete this testimonial?")){
			$.post("<?php echo $path?>ajax.inc.php", {
			cid: ""+id+"",_task: "delete"},
			function(data){ 
				$("#message").show().html(data).fadeOut(5000);
				window.location='index.php?module=testimonials';
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
<p><h2>Testimonial List</h2></p>
<form name="page" id="page" method="post">
    <div class="page_controls">
    	<table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <!--<tr>
            <td width="18%" align="left">Filter By Response Date:</td>
            <td width="20%" align="left"><input type="text" name="date" id="date" class="date-pick"/></td>
            <td width="62%" align="left"><input name="filter" id="filter" type="button" value="Filter" /></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>-->
        </table>
	</div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <th width="30%">Name</th>
            <th width="25%">Email</th>
            <th width="15%">Date Added</th>
            <th width="12%">Status</th>
            <th width="18%">Action</th>
          </tr>
        </table>
        <div id="records">
            <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
              <?php
                $result = $objTestimonials -> getRecords();
				//echo $result;
                while($array = mysql_fetch_assoc($result)){
					
					$status = ($array['status']==2) ? "Active" : "Inactive";
              ?>
              <tr>
                <td width="30%"><?php echo dbCon::removeslash($array['name'])?></td>
                <td width="25%"><?php echo $array['email']?></td>
                <td width="15%"><?php echo date('d M Y',strtotime($array['date']))?></td>
                <td width="12%"><?php echo $status?></td>
                <td width="18%">
                	[<a href="index.php?module=testimonials&action=edit&id=<?php echo $array['id']?>">Edit</a>]&nbsp;
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