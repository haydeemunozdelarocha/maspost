
<?


require "PHPMailer/PHPMailerAutoload.php";



include "coneccion.php";
	

$consulta  = "SELECT date_format(vigencia, '%m/%d/%Y') , c_recibir.nombre, c_recibir.app, c_recibir.apm, clientes.credito, planes.nombre, clientes.comentarios, planes.costo_mensual, cajas_incluidos, planes.pallets_incluidos, clientes.pmb, c_recibir.email FROM `clientes` inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and c_recibir.activo=1 and clientes.vigencia=DATE(NOW() + interval 28 day) and  clientes.pmb<=1000 and id_plan<> 2 and id_plan<>4";
//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
$count=0;
while(@mysql_num_rows($resultado)>$count)
{
	$res2=mysql_fetch_row($resultado);
	//$costo_almacen=$res2[1];
	$titular="$res2[1] $res2[2] $res2[3]";
	$vigencia=$res2[0];
	$saldo=$res2[4];
	$comentario=$res2[6];
	$plan=$res2[5];
	$costo_mensual=$res2[7];
	$cajas_incluidos=$res2[8];
	$pallets_incluidos=$res2[9];
	$pmb=$res2[10];
	$email=$res2[11];
	//$email="mgarciavarela@gmail.com";
	$email2="marisa@maspostwarehouse.com";


	
	
	
	
$EmailFrom = "noreply@maspostwarehouseusers.com";

	$Subject = "Vencimiento de PMB - Maspost Warehouse - ";
	$Body = "";
	$Body .= "<html>";
	$Body .= "<head><style type=\"text/css\">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #1419EF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style5 {font-size: 14px; }
-->
</style>";
				$Body .= "<title>maspostwarehouseusers.com</title>";
				$Body .= "</head>";
	$Body .= "
<body>
<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"90\"><img src=\"http://www.maspostwarehouseusers.com/images/header_email.jpg\"  height=\"55\"></td>
    <td width=\"510\"><span class=\"style1\"></span> </td>
  </tr>
  <tr>
    <td colspan=\"2\"><p>Estimado $titular</p>
    <p>Te recordamos que tu apartado postal vence el día: $vigencia </p>
	<p>Para efectual el pago puedes acudir a la oficina o hablar por telefono y pagar con tarjeta.</p>
	<p>Si ya no deseas continuar con tu apartado favor de enviar un correo electronico especificandolo a info@maspostwarehouse.com </p>

	
    ";

   $Body .= "

   <p>$banner</p>
   <p>.</p>
    <p>Esta es una notificacion automatica por favor no contestar.</p>
    <p>Para dudas o comentarios escribir a info@maspostwarehouse.com<br>
      <br>
    </p></td>
  </tr>
</table>";//<p>Para mayores detalles sobre su paquete accesar http://www.maspostwarehouseusers.com en apartado de postales con tu usuario y password.</p>

				$Body .= "</body>";
				$Body .= "</html>";
				/*if($email!="")
				$success = mail($email, $Subject, $Body, "From: maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");*/
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	
	$mail->Port = 465;
	$mail->Host = "a2plcpnl0769.prod.iad2.secureserver.net";
	$mail->Username ='noreply@maspostwarehouseusers.com';
	$mail->Password = 'Bendecida77';
	//$mail->From = 'noreply@maspostwarehouseusers.com';
	$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Subject = $Subject;
	$mail->Body = $Body;
	$mail->AddAddress($email);//para
	
	if($email!="")
	{

				$mail->Send();
				//$success = mail($email, $Subject, $Body, "From: Maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
				$success = mail($email2, $Subject, $Body, "From: Maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
				echo"$email $pmb<br>";
	}
$count++;
}
?>

 