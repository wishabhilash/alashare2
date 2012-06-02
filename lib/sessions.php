<?php

/**	Checks if an index in $_SESSION is set or not. On sucess returns the value else empty string. */
function get_session($data)
{
//	$data = hash('sha256', $data);
	if(isset($_SESSION[$data]))
		return $_SESSION[$data];
	else
		return ""; 
}

/**	Checks if an index in $_POST is set or not. On sucess returns the value else empty string. */
function get_post($data)
{
	if(isset($_POST[$data])) return $_POST[$data];
	else return "";
}

/** Attaches a timestamp alongwith a __ in the beginning of a filename to make its name unique. */
function unique_filename($filename)
{
	$time = time();
	$filename = "$time"."__".$filename;
	return $filename;
}

/** It's the reverse of unique_filename i.e. it removes the timestamp and __ from the front of filename. */
function clean_name($filename)
{
	$filename = explode("__",$filename);
	unset($filename[0]);
	return implode($filename);
}


/** It truncates a string if it is more than 20 characters long. Instead it puts ... in between. */
function truncate($filename)
{
	$len = strlen($filename);
	$tocut = ($len - 20) + 3;
	$start = floor($len/2) - round($tocut/2);
	return substr_replace($filename, '...', $start, $tocut);
}

/* Checks the size of the users upload directory. 
 * Picked code from: http://php.net/manual/en/function.filesize.php
 * */
function user_dir_size()
{
	$mod = 1024;
	$units = explode(' ', 'B KB MB');
	$address = $_SESSION['user_dir'];
	$size = 0; 
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($address)) as $file){ 
        $size+=$file->getSize(); 
    } 
	for($i = 0; $size > $mod; $i++)	$size /= $mod;
	return round($size,2).$units[$i];
}

?>
