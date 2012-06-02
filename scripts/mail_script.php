<?php
/** function send_mail: sends a mail through Pear mail, that works through a provided smtp protocol like gmail. */


function send_mail($to,$subject,$body)
{
	require_once('Mail.php');
	require_once('Mail/mime.php');
	$from = "A la Share <alasharecontrol@gmail.com>";
	$host = "smtp.gmail.com";
	$username = "alasharecontrol";
	$password = "chicken65";
	$port = "587";
	$crlf = "\n";

	$headers = array ('From' => $from,
						'To' => $to,
						'Subject' => $subject);

	// Creating the Mime message
	$mime = new Mail_mime($crlf);
	// Setting the body of the email
	$mime->setHTMLBody($body);

	$body = $mime->get();
	$headers = $mime->headers($headers);


	$smtp = Mail::factory('smtp',
	array ('host' => $host,
	'port' => $port,
	'auth' => true,
	'username' => $username,
	'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
	if (PEAR::isError($mail)) return $mail->getMessage();
	else return 0;
}

?>
