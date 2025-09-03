<html>
<head>
<title>PHPMailer - Sendmail advanced test</title>
</head>
<body>

<?php
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "mail.nsremovals.com";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "info@nsremovals.com";  // SMTP username
$mail->Password = "zhBARpAy"; // SMTP password

$mail->From = "info@nsremovals.com";
$mail->FromName = "nsremovals";
$mail->AddAddress("himanshu.byte@gmail.com", "Josh Adams");
$mail->IsHTML(true);                                  // set email format to HTML
$mail->AddAttachment("phpmailer.gif");         // add attachments
$mail->Subject = "Here is the subject";
$mail->Body    = "This is the HTML message body in bold!";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
   echo "Message could not be sent.";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}
echo "Message has been sent";
?>

</body>
</html>
