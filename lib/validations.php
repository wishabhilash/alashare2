<?php
/** This library handles the validations various fields like text, password, email, etc. */


/* It validates the username on registration. */
function ValidateUsername($data)
{
	if(!$data)
		return "Username blank.";
	$result = mysql_query("SELECT username from user WHERE username='$data';");
	if(mysql_num_rows($result))
		return "Username already present.";
	return mysql_real_escape_string($data);
}

/* Validates the password. */
function ValidatePassword($data)
{
	if(!$data)
		return "Password blank.";
	if(strlen($data) < 8)
		return "Password must be atleast 8 characters long.";
	if(!preg_match("/\d+/",$data))
		return "Atleast a number must be present";
	return mysql_real_escape_string($data);
}

/* Validates the email. */
function ValidateEMail($data, $dev_mode)
{
	if(!$data)
		return "E-mail blank.";
	$email_regex = '^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$';
	if(!preg_match("/$email_regex/", $data))
		return "Invalid email address.";
	$data = mysql_real_escape_string($data);
	if(!$dev_mode)
	{
		if(mysql_num_rows(mysql_query("SELECT * FROM user WHERE email='$data';")) > 1)
			return "E-mail already registered";
		else
			return $data;
	}
	else
		return $data;
}


/* Validates login informations. */
function ValidateLogin($username, $password)
{
	$password = hash('sha256',$password);
	$result = mysql_query("SELECT username, password from user WHERE username='$username' and password='$password';");
	if(mysql_num_rows($result))
		return true;
	return false;
}

function ValidateString($string, $ret)
{
	if(!$string) return "$ret missing";
	else return $string;
}
?>
