<?php $path = $module['modulepath']; //echo $path;?>
<html>
    <head>
        <title>Add Video</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script types="text/javascript" src="../../../js/jquery-1.3.2.js"></script>
        <script types="text/javascript" src="../../../js/jquery.validate.js"></script>
        <script types="text/javascript" src="../../../js/jquery.form.js"></script>
        <script type="text/javascript">

            function CheckExtenstion(con)
            {
                if(con.value != "")
                {
                    if(con.value.indexOf(".") > -1)
                    {
                        var ext = con.value.substring(con.value.lastIndexOf(".") + 1);
                        if( ext.toLowerCase() == "flv")
                        {
                            
                        }
                        else
                        {
                            alert('Please select flv file only');
                            document.getElementById("file_name").value='';
                        }
                    }
                    else
                    {
                        alert('Please enter valid file');
                    }
                }

            }

            $(document).ready(function(){
                $.validator.setDefaults({
                    submitHandler: function() {

                        $('#uploadVideo').ajaxSubmit(function(result) {
                            $("#message").show().html(result).fadeOut(5000);
                            window.location.replace("index.php?module=video");
                            $("#message").show().html(result);
                        });
                    }
                });
                // validate the form on keyup and submit
                $("#uploadVideo").validate({
                    rules: {
                        video_name: "required",
                        file_name:"required"
                    },
                    messages: {
                        video_name: "&nbsp;Please fill the field",
                        file_name:"&nbsp;Please select a file to upload"
                    }
                });
            });

        </script>
    </head>
    <body>
                <div id="message">
            </div>
        <form enctype='multipart/form-data' name="uploadVideo" id="uploadVideo" method="POST" action="ajax.inc.php">
            <div>
                <table>
                    <tr>
                        <td>Video Name *</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="video_name" id="video_name"/></td>
                    </tr>
                    <tr>
                        <td>Upload File</td>
                    </tr>
                    <tr>
                        <td><input type="file" name="file_name" id="file_name" onchange="CheckExtenstion(this);" /> (*.flv up to 8MB in size)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><input name="_task" id="_task" type="hidden" value="add" />
                            <input type="submit" value="Save" name="btnsave" id="btnsave"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel" name="btncancel" id="btncancel" /></td>
                    </tr>

                </table>
            </div>

        </form>


    </body>
</html>