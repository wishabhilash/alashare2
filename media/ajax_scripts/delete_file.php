<?php
/** This script facilitates ajax call for deleting a file. */

session_start();
include_once('../../settings.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);


$filename = base64_decode($_POST['filename']);
$dir = $_SESSION['user_dir'];
$result = mysql_query("DELETE FROM uploaded_data where file_name='$filename';");
unlink("../../".$dir."/".$filename);
echo "<a id=\"id-delete\"><img title=\"Delete\" src=\"media/images/delete.png\"></a>";
?>
