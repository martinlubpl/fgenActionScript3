<?php
//error_reporting(E_ALL);
require("lib/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsQmail(); // telling the class to use SMTP
$mail->IsHtml();
$mail->From = "info@fotogen.ch";
$mail->FromName = "FOTOGEN ADMIN";
$mail->AddAddress("marcin-lublin@o2.pl","MARTI");
$mail->Subject = "first mailing";
$mail->Body = "hi ! <br><br> this is <b>First mailing</b> I made myself with PHPMailer !";
$mail->AltBody = "text message no html";
if(!$mail->Send())
{
   echo "Message was not sent";
   echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
   echo "Message has been sent";
}
?>