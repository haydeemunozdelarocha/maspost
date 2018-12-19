<?php

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mail->Password = 'Bendecida77'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
$mail->isHTML(true);
?>
