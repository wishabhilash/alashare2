<?php
/** This script facilitates ajax calls by inserting an enrty in the share table to mark a file shared. */

session_start();
include_once('../../settings.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);

$item_id = $_POST['item_id'];
$user_id = $_POST['user_id'];
$html = $_POST['html'];

mysql_query("INSERT INTO share_info VALUES('','$user_id','$item_id');");
echo $html;
?>
