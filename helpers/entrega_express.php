<?php
session_start();
include "../connection.php";
include "checar_sesion_usuario.php";

require "../PHPMailer/PHPMailerAutoload.php";
// require './PHPMailer/PHPMailerAutoload.php';

$idU=$_SESSION['idU'];
$emailU=$_SESSION['emailU'];
$tipoU=$_SESSION['tipoU'];
$pmbU=$_SESSION['pmbU'];

date_default_timezone_set('America/Denver');
// $fecha = '2017-11-15';
// $hora = '08:00 AM';
// $weekDay = date('w', strtotime($fecha));





$ids =$_POST['recepcion_ids'];
// $ids = [373,374,375];
$rows = array();

$confirmado = 1;
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
// $nombre='';
$nombre = $_POST['nombre'];

$hora=strftime('%I:%M %p',strtotime($hora));
$fecha=strftime('%y-%m-%d',strtotime($fecha));
$weekDay = date('w', strtotime($_POST['fecha']));


date_default_timezone_set('America/Denver');
$currentDate = date('y-m-d');


$insertEntrega = 'INSERT INTO entrega_express(fecha,confirmado) VALUES("'.$fecha.' '.$hora.'",0);';

$resultadoEntregas = mysqli_query($enlace,$insertEntrega) or die(mysqli_error($enlace));

if($resultadoEntregas){
$entrega_id = mysqli_insert_id($enlace);

for($k = 0; $k <= (count($ids)-1);$k++ ){
if(strlen($nombre)){
  echo $nombre;
  $insertAutorizado = 'INSERT INTO mensajes(fecha,mensaje)VALUES("'.$currentDate.'","'.$nombre.'");SET @mensaje :=(SELECT mensajes.id FROM mensajes ORDER BY id DESC LIMIT 1);update recepcion SET mensaje =@mensaje WHERE recepcion.id IN (' . $ids[$k] .');';

 if (mysqli_multi_query($enlace, $insertAutorizado)) {
 do{
        if(mysqli_more_results($enlace)){

            }
    } while(mysqli_more_results($enlace) && mysqli_next_result($enlace));
}
}



$insertEntregaId = 'insert into express_recepcion(recepcion_id,express_id) VALUES('.$ids[$k].', (SELECT entrega_express.express_id FROM entrega_express ORDER BY express_id DESC LIMIT 1));';
echo $insertEntregaId;
$resultadoEntrega = mysqli_query($enlace,$insertEntregaId) or die(mysqli_error($enlace));
setlocale(LC_TIME, 'es_ES');
$fecha=strftime('%d-%b-%y',strtotime($fecha));

if($k == (count($ids)-1)){
  $ids = implode(",",$ids);
 $getRecepcion='select recepcion.entrada,recepcion.nombre,(concat(DATE_FORMAT(recepcion.fecha_recepcion,"%d"),"-",ELT(DATE_FORMAT(recepcion.fecha_recepcion,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),"-",DATE_FORMAT(recepcion.fecha_recepcion,"%y"))) as fecha_recepcion from recepcion where id in (' . $ids . ')' ;

  $resultado = mysqli_query($enlace,$getRecepcion) or die(mysqli_error($enlace));
  $count = mysqli_num_rows($resultado);
  $columns = mysqli_num_fields($resultado);
    while ($row = mysqli_fetch_array($resultado, MYSQLI_NUM)) {
      $rows[] = $row;


  }
}

}


}


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
$mail->Sender = 'noreply@maspostwarehouseusers.com';                         // Set mailer to use SMTP

$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addAddress('info@maspostwarehouse.com');   // Add a recipient
$mail->addCC('haydeemunozdelarocha@gmail.com');
// $mail->addBCC('bcc@example.com');


if($weekDay == 0 || $weekDay == 6){

$bodyContent = '<html><body style="min-height:400px;"><header style="width:100%;height:100px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
<div style="padding-bottom:10px;">
<h1 style="padding-top:20px;">Fin de Semana:Nueva Entrega Express</h1>
<h3>Programada para fin de semana.</h3>
<p>Para confirmar la disponibilidad y programar esta entrega, <a href="http://maspostwarehouseusers.com/confirmar.php?ids='.$ids.'&fecha='.$fecha . '&hora='.$hora.'"> haz click aquí.</a>
<p>Fecha de Entrega: <strong>'.$fecha.' '.$hora.'</strong></p><p>PMB: <strong>'.$pmbU.'</strong>
</div>
<table width="98%" border="0" cellpadding="0">
  <tr>
    <th bgcolor="#f6f6f6" height="30" width="20%">Entrada</th>
    <th bgcolor="#f6f6f6" height="30" width="20%">Nombre</th>
    <th bgcolor="#f6f6f6" height="30" width="20%">Fecha Recepcion</th>
  </tr>';
for($i=0;$i <= $count - 1;$i++){
        $bodyContent .= '<tr>';
        for($j=0; $j<= $columns - 1; $j++){
            if($j == 5){
             $bodyContent .= '<td height="30" width="20%">$' . $rows[$i][$j] . '</td>';
            } else {
             $bodyContent .=  '<td height="30" width="20%">' . $rows[$i][$j] . '</td>';
            }
        }
        $bodyContent .=  '</tr>';
      }
$bodyContent .= '</table>';
$mail->Subject = 'Fin de Semana: Nueva Entrega Express';

} else {
  $bodyContent = '<html><body style="min-height:400px;"><header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
  <div style="padding-bottom:10px;">
<h1 style="padding-top:20px;">Nueva Entrega Express</h1>

<p>Fecha de Entrega: <strong>'.$fecha.' '.$hora.'</strong></p><p>PMB: <strong>'.$pmbU.'</strong>
</div>
<table width="98%" border="0" cellpadding="0">
  <tr>
    <th height="30" bgcolor="#f6f6f6" width="20%">Entrada</th>
    <th height="30" bgcolor="#f6f6f6" width="20%">Nombre</th>
    <th height="30" bgcolor="#f6f6f6" width="20%">Fecha Recepcion</th>
  </tr>';
for($i=0;$i <= $count - 1;$i++){
        $bodyContent .= '<tr>';
        for($j=0; $j<= $columns - 1; $j++){
            if($j == 5){
             $bodyContent .= '<td height="30" width="20%">$' . $rows[$i][$j] . '</td>';
            } else {
             $bodyContent .=  '<td height="30" width="20%">' . $rows[$i][$j] . '</td>';
            }
        }
        $bodyContent .=  '</tr>';
      }
$mail->Subject = 'Nueva Entrega Express';

}
$bodyContent .= '</table><footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer></body></html>';

$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'true';
}

include "email_express_cita.php";
