<?php 
require_once('../config.inc.php');
require_once('timeout.inc.php');
//echo "<pre>";print_r($_SESSION['user']);echo "</pre>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
	<title>:: New Website - Admin Panel ::</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/jquerycssmenu.css"/>
    
	<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="js/jquery.livequery.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    
	<script type="text/javascript" src="js/jquerycssmenu.js"></script>
    
	<script type="text/javascript" src="../utils/fancybox/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
    <link rel="stylesheet" href="../utils/fancybox/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
    
    <link type="text/css" href="utils/jquery-ui/css/smoothness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="utils/jquery-ui/js/jquery-ui-1.8.1.custom.min.js"></script>
    
	<script type="text/javascript">
		$(document).ready(function(){
								   
			$("a#viewContact").livequery(function(){$(this).fancybox()});
								   
			$("a#view").livequery(function(){$(this).fancybox()});
			
			// logout 
			$("a.logout").click(function(){
				$.post("ajax.inc.php", {
					_task: "logout"},
					function(data){ 
						//$("#message").show().html(data);
						window.location='login.php';
					}
				);						 
			});
		});
    </script>
</head>
<body>

<?php 
	$ulevel = 1;//$objUser -> getULevel();
	if($ulevel==1)
		include_once('includes/header-admin.inc.php');
	else 
		include_once('includes/header-user.inc.php');
?>
<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			<!--<div id="breadcrumb">Home > Product</div>-->
            <div id="message"></div>
			            
            <!--<div id="modContent">-->
            	<?php
                	$module = utility::dispatchRequest();
					include_once($module['modulepage']);
					//echo $module['modulepage'];
				?>
            <!--</div>-->
			<!-- Column 1 end -->
		</div>
		<div class="col2">
			<!-- Column 2 start -->
			<h2>Overview</h2>
            <div id="overview">
            	<table width="100%" cellpadding="0" cellspacing="5">
                	<tr>
                    	<td width="80%">Total Sales:</td>
                    	<td align="right">$ 0.00</td>
                    </tr>
                	<tr>
                    	<td width="80%">Total Sales This Month:</td>
                    	<td align="right">$ 0.00</td>
                    </tr>
                	<tr>
                    	<td width="80%">Total Orders:</td>
                    	<td align="right">0</td>
                    </tr>
                	<tr>
                    	<td width="80%">Customers Waiting Approval:</td>
                    	<td align="right">0</td>
                    </tr>
                	<tr>
                    	<td width="80%">No. Of Products:</td>
                    	<td align="right">0</td>
                    </tr>
                </table>
            </div>
			<!-- Column 2 end -->
		</div>
	</div>
</div>
<?php include_once('includes/footer.inc.php')?>

</body>
</html>
