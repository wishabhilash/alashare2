<?php
/** This script facilitates ajax calls by fetching the users for sharing in the dialog. */

session_start();
include_once('../../settings.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);

$item_id = $_POST['item_id'];
$id = $_SESSION['id'];
$result = mysql_query("SELECT * FROM user_profile WHERE id!='$id' order by first_name;");
if(mysql_num_rows($result) > 0)
{
	echo "<div id=\"dialog-data-id\" title=\"$item_id\" style=\"visibility:hidden\"></div>";
	while($userObj = mysql_fetch_object($result))
	{
		$class = 'ui-state-default';
		$name = $userObj -> first_name;
		$user_id = $userObj -> id;
		if(mysql_num_rows(mysql_query("SELECT * FROM share_info WHERE uid='$user_id' and did='$item_id';")) > 0)
			$class = 'dialog-selectable-selected';

		echo "<ul id=\"dialog-selectable\">
					<li class=\"$class user_list\">
						<div><img src=\"media/images/user.png\" /></div>
						<div id=\"name\">$name</div>
						<div id=\"dialog-user-id\" title=\"$user_id\" style=\"visibility:hidden\"></div>
						<div id=\"dialog-shared\"></div>
					</li>
			</ul>";
	}
}

?>
