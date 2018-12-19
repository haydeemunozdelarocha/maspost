<?php
  $mail->isSMTP();
  $mail->Sender = 'info@maspostwarehouseusers.com';
  $mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';
  $mail->SMTPAuth = true;
  $mail->Username = 'info@maspostwarehouseusers.com';
  $mail->Password = 'Bendecida77'; // SMTP password
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->isHTML(true);
  $mail->SMTPDebug  = false;

  $mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
  $mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
  $mail->addAddress($email);
  $mail->addCC('haydeemunozdelarocha@gmail.com');
?>