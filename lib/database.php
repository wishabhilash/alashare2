<?php
/**	This file just connects to the database. */

include_once('settings.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);


?>
