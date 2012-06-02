<?php 
/**		SESSION VARIABLE HAS THE FOLLOWING VARIABLES:
 * 		1. $_SESSION['user'] => Username.
 * 		2. $_SESSION['id'] => User's Id in database.
 * 		3. $_SESSION['user_dir'] => User's upload directory.
 */

session_start();
session_register('user');

set_include_path(get_include_path() . PATH_SEPARATOR . 'lib' . PATH_SEPARATOR . 'templates' . PATH_SEPARATOR . 'scripts');
require_once('views/views.php');
require_once('url_mapper.php');
require_once('settings.php');


/**	Append new urls here. Urls have two componenets:
 * 1. Url catcher -> A regex to match URL. (^appname/rest_regex$)
 * 2. Mapping function name -> Function to be executed (in view) for a specific URL.
 * These arrays are passed as array of arrays.
 */
$urls = array(
	array("^\/$APP_NAME\/login$",'login'),
	array("^\/$APP_NAME\/home$",'home_page'),
	array("^\/$APP_NAME\/logout$",'logout'),
	array("^\/$APP_NAME\/activation$",'activation_page'),
	array("^\/$APP_NAME\/activation\/\w+$",'confirm_activation'),
	array("^\/$APP_NAME\/upload$",'upload_data'),
	array("^\/$APP_NAME\/update_profile$",'update_profile'),
	array("^\/$APP_NAME\/download\/.+$",'download_file'),
	array("^\/$APP_NAME\/delete\/.+$",'delete_file'),
	array("^\/$APP_NAME\/profile$",'edit_profile'),
	array("^\/$APP_NAME\/register_profile$",'register_profile'),
);

/** All the URLs are processed using function map_urls found in library 'url_mapper.php'. */
map_url($urls);
?>
