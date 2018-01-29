<?php

$id=$_GET['id'];
$ObjVideo = new video();
$ObjVideo -> video($id);
$path = $module['modulepath'];
?>
<html>
    <head>
    <title>
        <?php if ($id != '') { echo "Edit Record"; } ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script types="text/javascript" src="../../../js/jquery-1.3.2.js"></script>
    <script types="text/javascript" src="../../../js/jquery.validate.js"></script>
    <script types="text/javascript" src="../../../js/jquery.form.js"></script>
    <script type="text/javascript">

        //function isNumberKey(evt) {
        //    var charCode = (evt.which) ? evt.which : event.keyCode
        //    if (charCode > 50 && (charCode < 48 || charCode > 50))
        //        return false;

        //        return true;
        //}

        $(document).ready(function(){
            $.validator.setDefaults({
                submitHandler: function() {

                    $('#updateVideo').ajaxSubmit(function(result) {
                        $("#message").show().html(result).fadeOut(5000);
                        window.location.replace("index.php?module=video");
                    });
                }
            });
            // validate the form on keyup and submit
            $("#updateVideo").validate({
                rules: {

                },
                messages: {

                }
            });
        });

    </script>
    <body>
        <form name="updateVideo" id="updateVideo" method="POST" action="ajax.inc.php">
            <div>
                <table>
                    <tr>
                        <td><input name="id" id="id" type="hidden" value="<?php echo $id?>" />
                        Video Name</td>
                    </tr>
                    <tr>
                        <td><input readonly="true" type="text" name="video_name" id="video_name" value="<?php echo $ObjVideo -> getName()?>" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                    </tr>
                    <tr>
                        <td>
                            <select name="status" id="status">
                                <option value="1">Approve</option>
                                <option value="2">Pending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><input name="_task" id="_task" type="hidden" value="edit" />
                            <input type="submit" value="Update" name="btnupdate" id="btnupdate" />
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Cancel" name="btncancel" id="btncancel"/></td>
                    </tr>

                </table>
            </div>
        </form>
    </body>
</html>