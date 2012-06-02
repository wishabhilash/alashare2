<?php
/* This is a library that maps the urls to its respective function. */


$uri = $_SERVER['REQUEST_URI'];

function clean_uri($url)
{
	if(substr($url,-1) == '/')
		return substr($url, 0,-1);
	else
		return $url;
}


/* It takes an array of array of urls and name of a function as string.
 * It iterates through each element for mapping.
 * It matches the urls and executes the function with the name of the string alongwith it.
 * The function is written in the views.php
 */
function map_url($urls)
{
	global $uri;
	$match = false;
	for($i = 0; $i < count($urls); $i++)
	{
		$patt = $urls[$i][0];
		if(preg_match("/$patt/", $uri, $matches))
		{
			$urls[$i][1]();
			$match = true;
		}
		if($match) break;
	}
	if(!$match) _404_page();
}

?>
