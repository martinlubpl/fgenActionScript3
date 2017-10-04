<?php
//error_reporting(E_ALL);
include_once('connect.php');
require("lib/phpmailer/class.phpmailer.php");

$query = "SELECT * FROM fg_models WHERE id ='".$_POST['model_id']."'";
$result = mysql_query($query) or die(mysql_error());
$got = mysql_fetch_array($result);

$query2 = "SELECT * FROM fg_photos WHERE model_id='".$_POST['model_id']."'";
$result2 = mysql_query($query2) or die(mysql_error());
while ($got2 = mysql_fetch_array($result2)) {
	if ($got2['sed_card'] == 1) {
		$mystamp = $got2['stamp'];
	}
}

if (isset($_POST['action']) && $_POST['action'] =="request") {
	$htmlmessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <a href="http://www.fotogen.ch"><img src="http://www.fotogen.ch/gfx/header.jpg" width="700" height="88" border="0"></a>
  </tr>
  <tr>
    <td>Mr/Mrs. '.$_POST['name1'].'<br />
      email: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a>';
	$htmlmessage.='<br />
      <br /> 
    requested following model:<br /><br /></td>
  </tr>
  <tr>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="175"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'"><img width="175" height="246" border="0" src="http://www.fotogen.ch/images/medium/'.$mystamp.'_medium.jpg"></a>';
	$htmlmessage .= '</td>
        <td width="25">&nbsp;</td>
        <td width="500"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'">View SED CARD of the model</a><br />'.$got['first_name'].' '.$got['last_name'].' ('.$got['nick_name'].')';
	$htmlmessage .= '</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>comment:</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">'.$_POST['comments'].'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>';

	$mail = new PHPMailer();
	$mail->IsQmail(); // telling the class to use SMTP
	$mail->IsHtml();
	$mail->From = "info@fotogen.ch";
	$mail->AddReplyTo($_POST['email'],$_POST['name1']);
	$mail->FromName = "FOTOGEN ADMIN";
	$mail->AddAddress("office@fotogen.ch","FOTOGEN");
	$mail->AddBCC("chris@mcneely.ch","chris");
	$mail->AddBCC("smdesign.eu@gmail.com","smdesign");
	$mail->CharSet  =  "utf-8";
	$mail->Subject = "MODEL REQUEST FROM FG WEBSITE";
	$mail->Body = $htmlmessage;
	$mail->AltBody = "Sorry, your mail client doesn't understand html";
	if(!$mail->Send())
	{
		$fgmail = false;
	}
	else
	{
		$fgmail = true;
	}
	$htmlmessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <a href="http://www.fotogen.ch"><img src="http://www.fotogen.ch/gfx/header.jpg" width="700" height="88" border="0"></a>
  </tr>
  <tr>
    <td>Dear Mr/Mrs. '.$_POST['name1'].'<br />
      email: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a>';
	$htmlmessage.='<br />
      <br /> 
    You requested following model:<br /><br /></td>
  </tr>
  <tr>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="175"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'"><img width="175" height="246" border="0" src="http://www.fotogen.ch/images/medium/'.$mystamp.'_medium.jpg"></a>';
	$htmlmessage .= '</td>
        <td width="25">&nbsp;</td>
        <td width="500"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'">View SED CARD of the model</a><br />'.$got['first_name'].' '.$got['last_name'].' ('.$got['nick_name'].')';
	$htmlmessage .= '</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Your comments:</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">'.$_POST['comments'].'</td>
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
	$mail2->AddAddress($_POST['email'],$_POST['name1']);
	$mail2->AddBCC("smdesign.eu@gmail.com");
	$mail->CharSet  =  "utf-8";
	$mail2->Subject = "YOUR MODEL REQUEST";
	$mail2->Body = $htmlmessage;
	$mail2->AltBody = "Sorry, your mail client doesn't understand html";
	if($mail2->Send() &&  $fgmail==true)
	{
		print '&backmessage=OK';

	}
	else
	{
		print '&backmessage=ERROR';

	}

}
///////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && $_POST['action'] =="send") {
	$htmlmessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <a href="http://www.fotogen.ch"><img src="http://www.fotogen.ch/gfx/header.jpg" width="700" height="88" border="0"></a>
  </tr>
  <tr>
    <td>Dear Mr/Mrs. '.$_POST['name1'].'<br />
      email: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a>';
	$htmlmessage.='<br />
      <br /> 
    Here is the model you requested:<br /><br /></td>
  </tr>
  <tr>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="175"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'"><img width="175" height="246" border="0" src="http://www.fotogen.ch/images/medium/'.$mystamp.'_medium.jpg"></a>';
	$htmlmessage .= '</td>
        <td width="25">&nbsp;</td>
        <td width="500"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'">View SED CARD of the model</a><br />'.$got['first_name'].' '.$got['last_name'].' ('.$got['nick_name'].')';
	$htmlmessage .= '</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Your comment:</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">'.$_POST['comments'].'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>';

	
	
	$mail = new PHPMailer();
	$mail->IsQmail(); // telling the class to use SMTP
	$mail->IsHtml();
	$mail->From = "info@fotogen.ch";
	//$mail->AddReplyTo($_POST['email'],$_POST['name1']);
	$mail->FromName = "FOTOGEN ADMIN";
	$mail->AddAddress($_POST['email'],$_POST['name1']);
	$mail->AddBCC("smdesign.eu@gmail.com");
	$mail->Subject = "MODEL FROM FG WEBSITE";
	$mail->CharSet  =  "utf-8";
	$mail->Body = $htmlmessage;
	$mail->AltBody = "Sorry, your mail client doesn't understand html";
	if(!$mail->Send())
	{
		$fgmail = false;
	}
	else
	{
		$fgmail = true;
	}
	if (isset($_POST['email2'])) {
		$htmlmessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <a href="http://www.fotogen.ch"><img src="http://www.fotogen.ch/gfx/header.jpg" width="700" height="88" border="0"></a>
  </tr>
  <tr>
    <td>Hello,<br/>You have received the following model from '.$_POST['name1'].' <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a>';
		$htmlmessage.='<br /><br /></td>
  </tr>
  <tr>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="175"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'"><img width="175" height="246" border="0" src="http://www.fotogen.ch/images/medium/'.$mystamp.'_medium.jpg"></a>';
		$htmlmessage .= '</td>
        <td width="25">&nbsp;</td>
        <td width="500"><a href="http://www.fotogen.ch/index.php?sc='.$_POST['model_id'].'">View SED CARD of the model</a><br />'.$got['first_name'].' '.$got['last_name'].' ('.$got['nick_name'].')';
		$htmlmessage .= '</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Your friend\'s comments:</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">'.$_POST['comments'].'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>';

		// convert comma separated emails into array
		$sendMails = explode(",",$_POST['email2']);
		$mail2 = new PHPMailer();
		$mail2->IsQmail(); // telling the class to use SMTP
		$mail2->IsHtml();
		$mail2->From = "info@fotogen.ch";
		//$mail2->AddReplyTo($_POST['email'],$_POST['name1']);
		$mail2->AddReplyTo($_POST['email'],$_POST['name1']);
		$mail2->FromName = "FOTOGEN ADMIN";
		// Add all mails
		for ($i = 0; $i < count($sendMails); $i++) {
			$mail2->AddAddress($sendMails[$i]);
			
		}
		$mail2->AddBCC("smdesign.eu@gmail.com");
		$mail2->CharSet  =  "utf-8";
		$mail2->Subject = "FOTOGEN MODEL FROM YOUR FRIEND";
		$mail2->Body = $htmlmessage;
		$mail2->AltBody = "Sorry, your mail client doesn't understand html";
		if($mail2->Send() &&  $fgmail==true)
		{
			print '&backmessage=OK';

		}
		else
		{
			print '&backmessage=ERROR';

		}
	}
}
?>