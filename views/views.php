<?php

require_once('sessions.php');
require_once('database.php');
require_once('validations.php');
require_once('mail_script.php');


/** View function for login logic */
function login($message = null, $errorlist = array())
{
	global $DEV_MODE;
	$username = get_session('user');
	if($username != "")
		header('Location: activation');
	else if(get_post('submit_signup') != "")
	{
		if(($username = ValidateUsername($_POST['username_signup'])) != $_POST['username_signup'])
			$errorlist[0] = $username;
		if(($password = ValidatePassword($_POST['password_signup'])) != $_POST['password_signup'])
			$errorlist[1] = $password;
		if(($c_password = $_POST['repassword_signup']) != $_POST['repassword_signup'])
			$errorlist[2] = "Passwords don't match.";
		if(($email = ValidateEMail($_POST['e-mail_signup'], $DEV_MODE)) != $_POST['e-mail_signup'])
			$errorlist[3] = $email;
		if(count($errorlist) > 0) show_login_page(null,$errorlist);
		else
		{
			$_SESSION['email'] = $email;
			$password = hash('sha256',$password);
			$activation_id = hash('sha256',$email);
			$query = "INSERT INTO user (username,password,email,activation_id, activated) VALUES('$username','$password','$email','$activation_id',0)";
			mysql_query($query);
			echo mysql_error();
			header('Location: activation');
		}
	}
	else if(get_post('submit_login') == "")
		show_login_page();
	else
	{	
		$username = get_post('username_login');
		$password = get_post('password_login');

		if(ValidateLogin($username, $password) && $username != "")
		{
			$_SESSION['user']=$username;
			header('Location: activation');
		}
		else
		{	
			$message="Sorry! Username and password do not match.<br/>\n";
			show_login_page($message, array());
		}
	}
}


/** Function for login page */
function show_login_page($message = "", $errorlist = array())
{
	require_once("login.php");
}


/** View function for logout */
function logout()
{
	$_SESSION['user']="";

	//Redirec to index page
	header("Location: login");
}


/** view function for home page */
function home_page()
{
	//$uri = explode("/",$_SERVER['REQUEST_URI']);
	//$uri = $uri[-1];
	/*if($_SESSION['user'] != "" && $_SESSION['user'] == $uri)
		include('home.php');*/
	if($_SESSION['user'] != "")
	{
		$id = $_SESSION['id'];
		$result = mysql_fetch_object(mysql_query("SELECT * FROM user_profile where id='$id';"));
		$user_quota = $result -> quota;
		$ajax_call = 0;
		$ajax_call2 = 0;
		$dir_size = user_dir_size();
		include('home.php');
	}
	
	/*		OTHERS PROFILE TO BE IMPLEMENTED	*/
	
	else
		header("Location: login");
}


/** View function for 404 error */
function _404_page()
{
	require_once('_404.php');
}


/** View function for activation page */
function activation_page()
{
	$username = $_SESSION['user'];
	$query = "SELECT * FROM user where username='$username';";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		$data = mysql_fetch_object($result);
		if($data -> activated == 1)
		{
			$dirname = "accounts/".hash('sha256',$username);
			if(!is_dir($dirname))
			{
				mkdir($dirname, 0777);
				$old = umask(0);
				chmod($dirname,0777);
				umask($old);
			}
			
			$result = mysql_query("SELECT id from user where username='$username';");
			$uobj = mysql_fetch_object($result);
			$id = $uobj -> id;
			$result = mysql_query("SELECT * from user_profile where id='$id';");
			
			$_SESSION['id'] = $id;
			$_SESSION['user_dir'] = $dirname;
			
			if(mysql_num_rows($result) > 0)
				header("Location: home");
			else
				header("Location: register_profile");
			
		}
	}
	else
	{
		require_once('status_unconfirmed.php');
		$to = $_SESSION['email'];
		$link = "http://".$_SERVER['HTTP_HOST']."/php/activation/".hash('sha256',$to);
		$body = "Click on the link below to confirm: <br /><a href=".$link.">".$link."</a>";
		
		send_mail("$to", "Confirmation mail: A`la Share!!!", "$body");
	}
}

/** View function for confirming activation on confirming url */
function confirm_activation()
{
	$id = explode('/',$_SERVER['REQUEST_URI']);
	$id = $id[count($id)-1];
	mysql_query("UPDATE user SET activated=1 where activation_id='$id';");
	include_once('status_confirmed.php');
}

/** View function for uploading data */
function upload_data()
{
	require_once('file_upload.php');
	header("Location: home");
}

/** View function for updating profile */
function register_profile()
{
	global $UPLOAD_QUOTA;
	$id = $_SESSION['id'];
	if(get_post('profile-update-input') != "")
	{
		if(($firstname = mysql_real_escape_string(ValidateString(get_post('profile-fname'), 'First Name'))) != get_post('profile-fname'))
		{
			$errorlist[0] = $firstname;
			$firstname = "";
		}
		if(($lastname = mysql_real_escape_string(ValidateString(get_post('profile-lname'), 'Last Name'))) != get_post('profile-lname'))
		{
			$errorlist[1] = $lastname;
			$lastname = "";
		}
		$phone = mysql_real_escape_string(get_post('profile-phone'));
		$address = mysql_real_escape_string(get_post('profile-address'));
		$city = mysql_real_escape_string(get_post('profile-city'));
		$state = mysql_real_escape_string(get_post('profile-state'));
		mysql_query("INSERT INTO user_profile (id, first_name, last_name, phone, address, city, state, quota) values('$id', '$firstname', '$lastname', '$phone', '$address', '$city', '$state', '$UPLOAD_QUOTA');");
		header("Location: home");
	}
	else
		require_once('register_profile.php');
}

/** View function for downloading a file */
function download_file()
{
	$user_id = $_SESSION['id'];
	$filename = explode('/', $_SERVER['REQUEST_URI']);
	$filename = base64_decode($filename[count($filename) - 1]);
	$result = mysql_query("select * from share_info, uploaded_data where share_info.did=uploaded_data.id and uploaded_data.file_name='$filename' and share_info.uid='$user_id';");
	if(mysql_num_rows($result) == 1)
	{
		$address = mysql_fetch_object($result);
		header("Content-disposition: attachment; filename=$filename");
		readfile($address -> data_addr);
	}
	else
		_404_page();
}


/** View function for editing profile */
function edit_profile()
{
	$id = $_SESSION['id'];
	if(get_post('profile-update-input') != "")
	{
		if(($firstname = mysql_real_escape_string(ValidateString(get_post('profile-fname'), 'First Name'))) != get_post('profile-fname'))
		{
			$errorlist[0] = $firstname;
			$firstname = "";
		}
		if(($lastname = mysql_real_escape_string(ValidateString(get_post('profile-lname'), 'Last Name'))) != get_post('profile-lname'))
		{
			$errorlist[1] = $lastname;
			$lastname = "";
		}
		$phone = mysql_real_escape_string(get_post('profile-phone'));
		$address = mysql_real_escape_string(get_post('profile-address'));
		$city = mysql_real_escape_string(get_post('profile-city'));
		$state = mysql_real_escape_string(get_post('profile-state'));
		mysql_query("UPDATE user_profile SET first_name='$firstname', last_name='$lastname', phone='$phone', address='$address', city='$city', state='$state' where id='$id';");
	}
	$userobj = mysql_fetch_object(mysql_query("SELECT * FROM user_profile WHERE id='$id';"));
	require_once('edit_profile.php');
}
?>
