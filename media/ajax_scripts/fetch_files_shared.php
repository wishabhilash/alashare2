<?php
/** This script facilitates ajax calls by fetching the files shared with the user for display. */

session_start();
include_once('../../settings.php');
include_once('../../lib/sessions.php');

mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);

$user_id = $_SESSION['id'];
$precision = 1;
$result = mysql_query("select uploaded_data.id, uploaded_data.data_addr, uploaded_data.file_name from share_info, uploaded_data where share_info.did=uploaded_data.id and share_info.uid!=uploaded_data.fid and share_info.uid='$user_id';");
if(mysql_num_rows($result) > 0)
{
	while($res_obj = mysql_fetch_object($result))
	{
		$dir = $res_obj -> data_addr;
		$data_id = $res_obj -> id;
		$filenameOld = $res_obj -> file_name;
		$filename_encode = base64_encode($filenameOld);
		
		if(($filesize = filesize("../../$dir")/(1024*1024)) >= 1)
			$filesize = round($filesize, $precision) . " MB";
		else if(($filesize = filesize("../../$dir")/1024) >= 0)
			$filesize = round($filesize, $precision) . " KB";

		if(is_file("../../$dir")) $icon = "file.png"; 
		else $icon = "folder.png";

		$filename = clean_name($filenameOld);
		$fullfilename = $filename;
		if(strlen($filename) > 20)
			$filename = truncate($filename);

		if($icon == "folder.png")
			echo "<div id=\"shared-data-list\" class=\"ui-state-default cursor-pointer user_list\" title=\"$fullfilename\" />";
		else
			echo "<div id=\"shared-data-list\" class=\"ui-state-default user_list\" title=\"$fullfilename\">";

		echo "<div id=\"shared-data-list-pic\"><img src=\"media/images/$icon\" /></div>";
		if($icon == "folder.png")
			echo "<div id=\"shared-data-list-size\" class=\"size-color-white\">$filesize</div>";
		else
			echo "<div id=\"shared-data-list-size\">$filesize</div>";
		echo "<div id=\"shared-data-list-name\">$filename</div>";
					
				
		if($icon == "file.png")
		{
			echo "<div id=\"shared-data-list-options\" class=\"optionHide\" name=\"$filename_encode\">
				<a href=\"download/$filename_encode\"><img title=\"Download\" src=\"media/images/down.png\"></a>
				<div id=\"data-id\" title=\"$data_id\" style=\"visibility:hidden\">
			</div>";
		}
		echo "</div></div>";

	}
}
else
	echo "<div id=\"id-no-files-message\">Sad! Sad! None have shared files with you... :(</div>";
?>
