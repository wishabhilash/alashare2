<?php
/** This script facilitates ajax calls by removing an entry from the share table to unshare the file. */


session_start();
include_once('../../settings.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);

$item_id = $_POST['item_id'];
$user_id = $_POST['user_id'];
$html = $_POST['html'];

mysql_query("DELETE FROM share_info WHERE uid='$user_id' and did='$item_id';");
echo $html;
?>
