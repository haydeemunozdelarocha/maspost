<?php
session_start();
include "../connection.php";
include "checar_sesion_usuario.php";

require "../PHPMailer/PHPMailerAutoload.php";

$pmbU=$_SESSION['pmbU'];

$nombre =$_POST['nombre'];
$id =$_POST['id'];


$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mail->Password = 'Bendecida77'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
$mail->isHTML(true);                     // TCP port to connect to
$mail->SMTPDebug  = true;
$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addAddress('info@maspostwarehouse.com');   // Add a recipient
$mail->addCC('haydeemunozdelarocha@gmail.com');
// $mail->addBCC('bcc@example.com');


$mail->Subject = 'Perfil Actualizado: Borrar Nombre Recibir';



  $bodyContent = '<html><body style="min-height:400px;"><header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
  <div style="padding-bottom:10px;">
<h1 style="padding-top:20px;">Actualizar Perfil: Borrar Cliente para Recibir</h1>

  <p>El cliente con el numero de PMB: <strong>'.$pmbU.'</strong></p>
  <p> Ha solicitado eliminar el siguiente nombre de la lista de clientes con autorizacion a recibir:</p>

  <p>ID: '.$id.'</p>
  <p>Nombre: '.$nombre.'</p>
  </div>';

$bodyContent .= '</body><footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer>';
$mail->Body    = $bodyContent;
if(!$mail->send()) {
    echo 'Message could not be sent.';
    return 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    return 'true';
}


?>
