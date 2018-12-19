<?php
include "../coneccion.php";
include "../checar_sesion_admin.php";
require "../PHPMailer/PHPMailerAutoload.php";
date_default_timezone_set('America/Denver');


  $consulta = "UPDATE entrega_express SET preparado = 1 WHERE express_id = ".$_GET['id'];
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if($resultado3)
  {

  $consulta = 'select entrega_express.fecha,recepcion.pmb,clientes.email FROM entrega_express JOIN express_recepcion ON express_recepcion.express_id = entrega_express.express_id JOIN recepcion on recepcion.id = express_recepcion.recepcion_id JOIN clientes ON recepcion.pmb = clientes.pmb where entrega_express.express_id ='.$_GET['id'].' LIMIT 1;';
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
$row = mysql_fetch_assoc($resultado3);
$fecha= $row['fecha'];
$pmb= $row['pmb'];
$email=$row['email'];
setlocale(LC_TIME, 'es_ES');
$fecha= strftime('%d-%b-%y %H:%M %p',strtotime($fecha));


$Body = '<html><body style="min-height:400px;"><header style="width:100%;height:100px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
<div style="padding-bottom:10px;">
<h1 style="padding-top:20px;">Entrega Express Lista</h1>
<h3>Entrega Express Lista!</h3>
<p>Ya puedes pasar a recojer tu entrega express.</p>

<p>Fecha de Entrega: <strong>'.$fecha.'</strong></p><p>PMB: <strong>'.$pmb.'</strong>
</div>
<table width="98%" border="0" cellpadding="0">
  <tr>
    <th bgcolor="#f6f6f6" height="30" width="20%">Entrada</th>
    <th bgcolor="#f6f6f6" height="30" width="20%">Nombre</th>
    <th bgcolor="#f6f6f6" height="30" width="20%">Fecha Recepcion</th>
  </tr>';

  $consulta = 'select recepcion.entrada,recepcion.nombre,(concat(DATE_FORMAT(recepcion.fecha_recepcion,"%d"),"-",ELT(DATE_FORMAT(recepcion.fecha_recepcion,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),"-",DATE_FORMAT(recepcion.fecha_recepcion,"%y"))) as fecha_recepcion FROM express_recepcion join recepcion on express_recepcion.recepcion_id = recepcion.id WHERE express_id = '.$_GET['id'];
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());

if(@mysql_num_rows($resultado3)>=1)
  {
        $Body .= '<tr>';
while($row = mysql_fetch_assoc($resultado3)) {
  $Body .= '<tr>';

      foreach ($row as $value) {
       $Body .= '<td height="30" width="20%">' . $value . '</td>';
  }
  $Body .= '<tr>';

}


}
$EmailFrom='noreplay@maspostwarehouseusers.com';


$Body .= '</table>';
$Body .= '<footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;color:white;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer></body></html>';
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mail->Password = 'Bendecida77'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
$mail->isHTML(true);                     // TCP port to connect to
$mail->SMTPDebug  = false;
$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addAddress($email);   // Add a recipient
$mail->addCC('haydeemunozdelarocha@gmail.com');

$mail->Subject = 'Entrega Express Lista';

$mail->Body    = $Body;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mailCliente->ErrorInfo;
} else {
    echo 'true';
}
}
?>
