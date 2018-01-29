<?php $path = $module['modulepath']; //echo $path;?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="utils/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="utils/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Cancel button
        $('#btncancel').click(function(){window.location.replace("index.php?module=pages");});

        $.validator.setDefaults({
            submitHandler: function() {

                $('#page').bind('form-pre-serialize', function(e) {
                    tinyMCE.triggerSave();
                });

                $('#page').ajaxSubmit(function(result) {
                    $("#message").show().html(result).fadeOut(5000);
                    window.location.replace('index.php?module=pages');
                });
            }
        });

        // validate signup form on keyup and submit
        $("#page").validate({
            rules: {
                title: "required"
            },
            messages: {
                title: "&nbsp;Please fill the field"
            }
        });
    });

        if ( typeof CKEDITOR == 'undefined' )
    {
        document.write(
        '<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
            'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
            'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
            'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
            'value (line 32).' ) ;
    }
    else
    {
        var editor = CKEDITOR.replace( 'editor1' );
        editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );

        // Just call CKFinder.SetupCKEditor and pass the CKEditor instance as the first argument.
        // The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
        CKFinder.setupCKEditor( editor, 'utils/ckfinder/' ) ;

        // It is also possible to pass an object with selected CKFinder properties as a second argument.
        // CKFinder.SetupCKEditor( editor, { BasePath : '../../', RememberLastFolder : false } ) ;
    }

</script>
<p><h2>Add New Content Page</h2></p>
<form name="page" id="page" method="post" action="<?php echo $path?>ajax.inc.php">
    <div class="page_controls">
        <input name="_task" id="_task" type="hidden" value="add" />
        <input name="button" id="button" type="submit" value="Submit Content" />
        <input name="btncancel" id="btncancel" type="button" value="Cancel" />
    </div>
    <div id="modContent">
        <table width="100%" border="0" cellpadding="0" cellspacing="2">
            <tr>
                <td>Browser Title *</td>
            </tr>
            <tr>
                <td><input name="title" id="title" type="text" class="txtlarge"/></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Banner Image (JPG - 979 x 200, Max: 200KB)</td>
            </tr>
            <tr>
                <td><input type="file" name="picture" id="picture" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Mode</td>
            </tr>
            <tr>
                <td>
                    <select name="mode" id="mode" class="selectlarge">
                        <option value="1">Open in the same window</option>
                        <option value="2">Open in another window</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Page Content *</td>
            </tr>
            <tr>
                <td>
                    <textarea id="editor1" name="editor1" rows="25" cols="80" style="width:97%"></textarea>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Meta - Keywords</td>
            </tr>
            <tr>
                <td><textarea name="keywords" id="keywords" class="txtarea"></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Meta - Description</td>
            </tr>
            <tr>
                <td><textarea name="description" id="description" class="txtarea"></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</form>