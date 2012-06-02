<?php
/** This script fetches users uploaded files for display. */

session_start();
require_once("../../lib/sessions.php");


$dir = $_SESSION['user_dir'];
$precision = 1;
$m = opendir("../../$dir");
while($filenameOld = readdir($m))
{	
	if($filenameOld != '.' && $filenameOld != '..')
	{	
		if(($filesize = filesize("../../$dir/".$filenameOld)/(1024*1024)) >= 1)
			$filesize = round($filesize, $precision) . " MB";
		else if(($filesize = filesize("../../$dir/".$filenameOld)/1024) >= 0)
			$filesize = round($filesize, $precision) . " KB";
		
		if(is_file("../../$dir/".$filenameOld)) $icon = "file.png"; 
		else $icon = "folder.png";
		
		$filename = clean_name($filenameOld);
		$fullfilename = $filename;
		if(strlen($filename) > 20)
			$filename = truncate($filename);
		
		if($icon == "folder.png")
			echo "<div id=\"data-list\" class=\"ui-state-default cursor-pointer user_list\" title=\"$fullfilename\">";
		else
			echo "<div id=\"data-list\" class=\"ui-state-default user_list\" title=\"$fullfilename\">";
		
				echo "<div id=\"data-list-pic\"><img src=\"media/images/$icon\" /></div>";
						if($icon == "folder.png")
							echo "<div id=\"data-list-size\" class=\"size-color-white\">$filesize</div>";
						else
							echo "<div id=\"data-list-size\">$filesize</div>";
						echo "<div id=\"data-list-name\">$filename</div>";
						
					
					if($icon == "file.png")
					{
						echo "<div id=\"data-list-options\" class=\"optionHide\">
							<a><img title=\"Download\" src=\"media/images/down.png\"></a>
							<a><img title=\"Share\" src=\"media/images/megaphone.png\"></a>
							<a><img title=\"Delete\" src=\"media/images/delete.png\"></a>
						</div>";
					}
			echo "</div>";
	}
	
}

?>
