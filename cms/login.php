<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
	<title>:: New Website - Administrator Login ::</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/login.css"/>
    
	<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="js/jquery.livequery.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){			
			
			$.validator.setDefaults({
				submitHandler: function() {	
					$('#loginform').ajaxSubmit(function(result) { 
						$("#message").show().html(result).addClass('error');
					});
				}
			});
			
			
			// validate signup form on keyup and submit
			$("#loginform").validate({
				rules: {
					username: "required",
					password: "required"
				},
				messages: {
					username: "This field is required",
					password: "This field is required"
				}
			});	
			
			
		});
    </script>
</head>
<body>

<div id="header"></div>

<div id="content">
	<div id="cont-text">
	  <form name="loginform" id="loginform" method="post" action="ajax.inc.php">
	    <table width="350" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2"><strong>Administration Login</strong></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><div id="message">&nbsp;</div></td>
          </tr>
          <tr>
            <td width="117" valign="top">Username</td>
            <td width="233"><input type="text" name="username" id="username" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">Password</td>
            <td><input type="password" name="password" id="password" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input type="hidden" name="_task" id="_task" value="login"></td>
            <td><input type="submit" name="button" id="button" value="Login" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      
      </form>
    </div>
</div>

<div id="footer">Copyright &copy; 2010</div>

</body>
</html>
