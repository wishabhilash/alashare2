<?php 
/**	This is the setting module for the whole applicaition. */

/** toggle dev and user-modes */
$DEV_MODE = true;

/** This is the application name. It is used as the prefix for all the urls */
$APP_NAME = "alashare";

/** Email of the admin	*/
$ADMIN_EMAIL = "";

/** Database connection informations. */
$db_username = "";
$db_password = "";
$db_name = "";
$database = "mysql";	//Default mysql. Future: sqlite3, postgres
$db_host = "";

/** Default upload space alloted to each user */
$UPLOAD_QUOTA = 50;


/** Universal exculdes for upload. (NOT YET IMPLEMENTED) */
$upload_exclude = array(
	'file_types' => array(),
	'size' => ''
);

?>
