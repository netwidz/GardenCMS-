<?php
session_start();
unset($cosmetic);

$cosmetic -> db_hostname = "localhost"; // db server hostname
$cosmetic -> db_name = "gardenspa"; // db name
$cosmetic -> db_username = "root"; // db username
$cosmetic -> db_password = ""; // db password

$cosmetic -> wwwroot = "http://localhost/garden/"; // web root
$cosmetic -> dirroot = "C:/wamp/www/garden"; // directory root

/*
 * Image Uploading feature constants
 */

$upload_dir = "upload_pic"; 				// The directory for the images to be saved in
$upload_path = $upload_dir."/";				// The path to where the image will be saved
$large_image_prefix = "resize_"; 			// The prefix name to large image
$thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
$large_image_name = $large_image_prefix.$_SESSION['random_key'];     // New name of the large image (append the timestamp to the filename)
$thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'];     // New name of the thumbnail image (append the timestamp to the filename)
$max_file = "3"; 							// Maximum file size in MB
$max_width = "500";							// Max width allowed for the large image
$thumb_width = "100";						// Width of thumbnail image
$thumb_height = "100";						// Height of thumbnail image
// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
$allowed_image_ext = array_unique($allowed_image_types); // do not change this
$image_ext = "";	// initialise variable, do not change this.
foreach ($allowed_image_ext as $mime_type => $ext) {
    $image_ext.= strtoupper($ext)." ";
}





/*$cosmetic -> store = "http://localhost/bluebird/"; // store web root
$cosmetic -> storedirroot = "C:/wamp/www/bluebird"; // store directory root*/

//$cosmetic -> perpage = 10; // default no. of records per page

function __autoload($class_name){

    global $cosmetic;
	require_once($cosmetic->dirroot.'/classes/'.$class_name.'.class.php');

	
}
?>