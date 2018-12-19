<?php
include "checar_sesion_usuario.php";

$emailU=$_SESSION['emailU'];

$mailCliente = new PHPMailer;
$mailCliente->isSMTP();                            // Set mailer to use SMTP
$mailCliente->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';             // Specify main and backup SMTP servers
$mailCliente->SMTPAuth = true;                     // Enable SMTP authentication
$mailCliente->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mailCliente->Password = 'Bendecida77'; // SMTP password
$mailCliente->SMTPSecure = 'ssl';
      $mailCliente->Sender = 'noreply@maspostwarehouseusers.com';                         // Set mailer to use SMTP
                 // Enable TLS encryption, `ssl` also accepted
$mailCliente->Port = 465;
$mailCliente->isHTML(true);

$mailCliente->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mailCliente->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mailCliente->addAddress($emailU);   // Add a recipient
// $mailCliente->addCC('haydeemunozdelarocha@gmail.com');

$bodyContentCliente = '<html><body style="min-height:400px;"><header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
  <div style="padding-bottom:10px;">
<h1>Nueva Entrega Express</h1>
<h3>Programada para fin de semana.</h3>
<p>Hemos recibido tu solicitud de entrega express. Los fines de semana las entregas se hacen solamente con cita. Nuestro equipo confirmara su disponibilidad para terminar de programar esta entrega. Recibiras un correo con la confirmacion. Gracias!
<p>Fecha de Entrega: <strong>'.$fecha.'</strong></p><p>PMB: <strong>'.$pmbU.'</strong></div></body><footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer>';

$mailCliente->Subject = 'Atencion: Entrega Express en Fin de Semana';

$mailCliente->Body    = $bodyContentCliente;

if(!$mailCliente->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mailCliente->ErrorInfo;
} else {
    echo 'true';
}
?>
