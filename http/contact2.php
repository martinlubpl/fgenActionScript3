<?php
//error_reporting(E_ALL);

require("lib/phpmailer/class.phpmailer.php");
require("connect.php");

function check_email($email) {
	if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $email)) ||
	(preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/',$email)) ) {
		return true;
	}
	return false;
}

if (check_email($_POST['myemail'])) {
	$query = "insert into fg_newsletter (name,email) values ('".$_POST['myname']."','".$_POST['myemail']."')";
	//print $query;
	
	$result = mysql_query($query) or die("&backmessage=ERROR");
	print "&backmessage=OK";
} else {
	print "&backmessage=ERROR";
}
///
//
//
//
/*$htmlmessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
tr {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 10px;
}
-->
</style>
</head>

<body style="margin:0px">
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<a href="http://fotogen.ch"><img src="http://fotogen.ch/gfx/header.jpg" width="700" height="88" border="0"></a>
</tr>
<tr>
<td>Dear Mr/Mrs. '.$_POST['myname'].'<br />
email: <a href="mailto:'.$_POST['myemail'].'">'.$_POST['myemail'].'</a>';
$htmlmessage.='<br />
<br />
You has just sent message from FOTOGEN website<br /><br /></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Your message:</td>
</tr>
<tr>
<td bgcolor="#CCCCCC">'.$_POST['mymessage'].'</td>
</tr>
<tr>
<td>&nbsp;<br />We will contact you soon<br /><b>FOTOGEN TEAM</b></td>
</tr>
</table>

</body>
</html>';

$mail2 = new PHPMailer();
$mail2->IsQmail(); // telling the class to use SMTP
$mail2->IsHtml();
$mail2->From = "info@fotogen.ch";
//$mail2->AddReplyTo($_POST['email'],$_POST['name1']);
$mail2->AddReplyTo("info@fotogen.ch","FOTOGEN TEAM");
$mail2->FromName = "FOTOGEN ADMIN";
$mail2->AddAddress($_POST['myemail'],$_POST['myname']);
$mail2->Subject = "THANK YOU FOR SENDING MESSAGE";
$mail2->Body = $htmlmessage;
$mail2->AltBody = "Sorry, your mail client doesn't understand html";
if($mail2->Send() &&  $fgmail==true)
{
print '&backmessage=OK';

}
else
{
print '&backmessage=ERROR';

}*/









?>