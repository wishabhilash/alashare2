<?php
/** This script uploads a file. */

include_once('settings.php');
include_once('sessions.php');


/*		PATCHED : HOWEVER MUST BE CORRECTED		*/
$db_username = "root";
$db_password = "wish";
$db_name = "miniproject";
$database = "mysql";
$db_host = "localhost";


mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);

$dirname = hash('sha256',$_SESSION['user']);
$id = $_SESSION['id'];

if($_FILES["file"]["error"] > 0)
	echo "Error: ". $_FILES['file']['error']."<br />";
else
{
	$time = time();
	$filename = unique_filename($_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'], "accounts/$dirname/$filename");
	$address = "accounts/$dirname/$filename";
	mysql_query("INSERT INTO uploaded_data VALUES('', '$id', '$address', '$filename')");
	
	$result = mysql_query("SELECT * from uploaded_data where data_addr='$address';");
	$obj = mysql_fetch_object($result);
	$did = $obj -> id;
	mysql_query("INSERT INTO share_info VALUES('','$id','$did');");

}

?>
