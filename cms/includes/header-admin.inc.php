<div id="banner"></div>
<div id="header">
	<!--<h2>Banner</h2>-->
	<div id="layoutdims">
    	<div id="myjquerymenu" class="jquerycssmenu">
            <ul>
                <li><a href="#">System</a>
                  <ul>
                  <li><a href="index.php?module=organization">Organization</a></li>
                  <!--<li><a href="#">Portal Settings</a>
                  	<ul>
                    	<li><a href="index.php?module=portal">Email Settings</a></li>
                    	<li><a href="index.php?module=portal&action=poptext">Pop-Up Text Settings</a></li>
                    	<li><a href="index.php?module=portal&action=rates">Rates Document</a></li>
                    </ul>
                  </li>-->
                   <li><a href="index.php?module=user">System Users</a></a>
                    <ul>
                    <li><a href="index.php?module=user&action=password">Change Password</a></li>
                    </ul>
                  </li>
                  </ul>
                </li>
                <li><a href="#">Catalog</a>
                  <ul>
                      <li><a href="index.php?module=brand">Brands</a></li>
                      <li><a href="index.php?module=category">Category</a></li>
                      <li><a href="index.php?module=color">Colors</a></li>
                      <li><a href="index.php?module=product">Product</a></li>
                      <li><a href="index.php?module=shipping">Shipping</a></li>
                      <li><a href="index.php?module=tax">Tax</a></li>
                  </ul>
                </li>
                <li><a href="index.php?module=orders">Sales</a>
                  <!--<ul>
                      <li><a href="index.php?module=homeimg">Home Page Slideshow</a></li>
                      <li><a href="index.php?module=contact">Contact Responses</a></li>
                      <li><a href="index.php?module=lost">Lost &amp; Found</a></li>
                  </ul>-->
                </li>                
                <li><a href="#">Content Management</a>
                  <ul>                      
                      <li><a href="index.php?module=contentpics">Content Pictures</a></li>
                      <li><a href="index.php?module=pages">Manage Web Content</a></li>
                      <li><a href="index.php?module=xmlbanner">Flash Banner</a></li>
                      <li><a href="index.php?module=video">Upload Video</a></li>
                  </ul>
                </li>             
                <li><a href="#">Other</a>
                 <!-- <ul>
                      <li><a href="index.php?module=contentpics">Content Pictures</a></li>
                  </ul>-->
                </li>    
            </ul>
            <br style="clear: left" />
		</div>            
    	<div id="legend">Logged in as <strong><?php $ulevel = ($ulevel==1) ? 'Administrator' : 'Employee'; echo $ulevel; ?></strong> [<a href="javascript:vod(0)" class="logout">Logout</a>]</div>
    </div>
</div>