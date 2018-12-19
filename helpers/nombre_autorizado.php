<?php
session_start();
include "../connection.php";
include "checar_sesion_usuario.php";

require "../PHPMailer/PHPMailerAutoload.php";

$idU=$_SESSION['idU'];
$emailU=$_SESSION['emailU'];
$tipoU=$_SESSION['tipoU'];
$pmbU=$_SESSION['pmbU'];

$nombre_autorizado = $_POST['nombre_autorizado'];
$recepcion_ids = $_POST['recepcion_ids'];

$recepcion_ids = implode(",",$recepcion_ids);
date_default_timezone_set('America/Denver');
$currentDate = date('y-m-d');

$updateRecepcion='INSERT INTO mensajes(fecha,mensaje)VALUES("'.$currentDate.'","'.$nombre_autorizado.'");SET @mensaje :=(SELECT mensajes.id FROM mensajes ORDER BY id DESC LIMIT 1);update recepcion SET mensaje =@mensaje WHERE recepcion.id IN (' . $recepcion_ids .');';

if (mysqli_multi_query($enlace, $updateRecepcion)) {
 do{
        if(mysqli_more_results($enlace)){

            }
    } while(mysqli_more_results($enlace) && mysqli_next_result($enlace));
}

 $getRecepcion='select recepcion.entrada,recepcion.nombre,(concat(DATE_FORMAT(recepcion.fecha_recepcion,"%d"),"-",ELT(DATE_FORMAT(recepcion.fecha_recepcion,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),"-",DATE_FORMAT(recepcion.fecha_recepcion,"%y"))) as fecha_recepcion from recepcion where id in (' . $recepcion_ids . ')' ;

  $resultado = mysqli_query($enlace,$getRecepcion) or die(mysqli_error($enlace));
  $count = mysqli_num_rows($resultado);
  $columns = mysqli_num_fields($resultado);
    while ($row = mysqli_fetch_array($resultado, MYSQLI_NUM)) {
      $rows[] = $row;
  }
if($getRecepcion){
$mail = new PHPMailer;
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mail->Password = 'Bendecida77'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
$mail->isHTML(true);
      $mail->Sender = 'noreply@maspostwarehouseusers.com';                         // Set mailer to use SMTP

$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addAddress('info@maspostwarehouse.com');   // Add a recipient
$mail->addCC('haydeemunozdelarocha@gmail.com');

$bodyContentCliente = '<html><body style="min-height:400px;"><header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
  <div style="padding-bottom:10px;">
<h1>Nuevo Nombre Autorizado</h1>

<p>El usuario con numero de <strong>PMB:'.$pmbU.'</strong> ha autorizado a: <strong>'.$nombre_autorizado.'</strong> para recoger los paquetes:</p><table width="98%" border="0" cellpadding="0">
  <tr>
    <th bgcolor="#f6f6f6" height="30" width="20%">Entrada</th>
    <th bgcolor="#f6f6f6" height="30" width="20%">Nombre</th>
    <th bgcolor="#f6f6f6" height="30" width="20%">Fecha Recepcion</th>
  </tr>';
for($i=0;$i <= $count - 1;$i++){
        $bodyContentCliente .= '<tr>';
        for($j=0; $j<= $columns - 1; $j++){
            if($j == 5){
             $bodyContentCliente .= '<td height="30" width="20%">$' . $rows[$i][$j] . '</td>';
            } else {
             $bodyContentCliente .=  '<td height="30" width="20%">' . $rows[$i][$j] . '</td>';
            }
        }
        $bodyContentCliente .=  '</tr>';
      }
$bodyContentCliente .= '</table></div></body><footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer>';

$mail->Subject = 'Nuevo Nombre Autorizado';

$mail->Body    = $bodyContentCliente;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  $result = array('success' => true);
    echo json_encode($result);
}
} else {
   $result = array('success' => false);
  echo json_encode($result);
              }

?>
