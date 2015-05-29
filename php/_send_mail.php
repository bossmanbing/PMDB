<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from       = "no-reply@smashtracker.com";
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "tls://p3plcpnl0306.prod.phx3.secureserver.net"; // SMTP host
$mail->Port       =  465;                    // set the SMTP port
$mail->Username   = "admin@smashtracker.com";  // SMTP  username
$mail->Password   = "Fry!Br34d";  // SMTP password
$mail->SetFrom($from, 'SmashTracker');
$mail->AddReplyTo($from,'Registration');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send();
}
?>
