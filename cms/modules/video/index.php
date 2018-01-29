<?php
$path = $module['modulepath'];
$ObjVideo = new video();
?>
        <title>Video Upload</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script types="text/javascript" src="../js/jquery-1.3.2.js"></script>
        <script types="text/javascript" src="../js/jquery.validate.js"></script>
        <script types="text/javascript" src="../js/jquery.form.js"></script>
        <script types="text/javascript" src="../js/jquery.livequery.js"></script>
        <script type="text/javascript" src="../utils/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
        <script type="text/javascript" src="../utils/tinyrte.js"></script>
        <link rel="stylesheet" href="../css/calendar.css" type="text/css" media="screen" />
        <script type="text/javascript">
            $(document).ready(function(){

                $('.delete').livequery('click',function(){
                    var id = $(this).attr('id');
                    if(confirm("Do you want to delete this item?")){

                        $.post("ajax.inc.php", {
                            cid: ""+id+"",_task:"delete"},
                        function(data){
                            $("#message").show().html(data).fadeOut(5000);
                            window.location='index.php?module=video';
                        });
                    }
                });
            });
        </script>
<form name="video" id="video" method="post">
        <div>
            <table width="100%" border="0" cellpadding="0" cellspacing="2">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">
                    <input type="button" name="button" id="button" value="Add New Item" onclick="window.location='index.php?module=video&action=add'"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
	<div id="modContent">
       <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
            <tr>
                <th width="25%">Video Title</th>
                <th width="25%">Added Date</th>
                <th width="20%">Status</th>
                <th width="20%">Action</th>
            </tr>
        </table>
        <div id="records">
        <table width="100%" border="0" cellpadding="0" cellspacing="2" id="list">
            <?php
            $result = $ObjVideo -> getRecords();
            while($array = mysql_fetch_assoc($result)){
                ?>

            <tr>
                <td width="25%"><?php echo $array['name']?></td>
                <td width="25%"><?php echo $array['added_date']?></td>
                <td width="20%"><?php echo $array['status']?></td>
                <td width="20%">[<a  href="index.php?module=video&action=edit&id=<?php echo $array['id']?>">Edit</a>]
                [<a  href="javascript:void(0)" id="<?php echo $array['id']?>" class="delete">Delete</a>]</td>
            </tr>
            <?php
        }
        ?>
        </table>
        </div>
        </div>
        </form>