<?php
/** This script facilitates ajax calls by fetching the other users. */

session_start();
include_once('../../settings.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);

$id = $_SESSION['id'];
$result = mysql_query("SELECT * FROM user_profile WHERE id!='$id' order by first_name;");
if(mysql_num_rows($result) > 0)
{
	while($userObj = mysql_fetch_object($result))
	{
		$name = $userObj -> first_name;
		echo "<ul id=\"selectable\">
					<li class=\"ui-state-default user_list\">
						<div><img src=\"media/images/user.png\" /></div>
						<div id=\"name\">$name</div>
					</li>
			</ul>";
	}
}
else
	echo "<div id=\"id-no-files-message\">No USERS found!!! :(</div>";

?>
