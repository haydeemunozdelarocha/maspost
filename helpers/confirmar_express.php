<?php
session_start();
include "../connection.php";


require "../PHPMailer/PHPMailerAutoload.php";



parse_str($_SERVER['QUERY_STRING'],$output);
$output['ids']=explode(",",$output['id']);


$express_ids =$output['id'];
$fecha =$output['fecha'];



$query = 'UPDATE entrega_express SET confirmado = 1, fecha = "'.$fecha.'" WHERE recepcion_id IN('.$express_ids.');';

$resultado = mysqli_query($enlace,$query) or die(mysqli_error($enlace));


if($resultado){

 $getRecepcion='select recepcion.entrada,recepcion.nombre,(concat(DATE_FORMAT(recepcion.fecha_recepcion,"%d"),"-",ELT(DATE_FORMAT(recepcion.fecha_recepcion,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),"-",DATE_FORMAT(recepcion.fecha_recepcion,"%y"))) as fecha_recepcion from recepcion where id in (' . $express_ids . ')' ;

  $resultadoA = mysqli_query($enlace,$getRecepcion) or die(mysqli_error($enlace));
  $count = mysqli_num_rows($resultadoA);
  $columns = mysqli_num_fields($resultadoA);
    while ($row = mysqli_fetch_array($resultadoA, MYSQLI_NUM)) {
      $rows[] = $row;
  }
if($getRecepcion){
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';
$mail->Sender = 'noreply@maspostwarehouseusers.com';                         // Set mailer to use SMTP
           // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mail->Password = 'Bendecida77'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
$mail->isHTML(true);                     // TCP port to connect to
$mail->SMTPDebug  = false;
$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addAddress('info@maspostwarehouse.com');   // Add a recipient
$mail->addCC('haydeemunozdelarocha@gmail.com');
  $bodyContent = '<html><body style="min-height:400px;"><header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
  <div style="padding-bottom:10px;">
  <h2>Confirmado</h2>
  <p>La solicitud de entrega express con fecha: <strong> ' . $fecha . '</strong>
   ha sido confirmada por el cliente.</p><table width="98%" border="0" cellpadding="0">
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
      $bodyContent .= '</div></body><footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer>';


$mail->Subject = 'Confirmacion Entrega Express';

$mail->Body    = $bodyContent;


if(!$mail->send()) {
    echo '<html>
    <head>
        <meta charset="utf-8">
        <title>Maspost Warehouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="/css/profile.css">
    </head>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-default " role="navigation"

            <div class="navbar-main">
                  <div class="container">
                <div class="navbar-header">
                  <img src="/images/maspost-sm.png" alt="" border="0"></a>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php">LOGIN</a></li>
                  </ul>
                </div> <!-- /#navbar -->
                </div>
            </div> <!-- /.navbar-main -->
        </nav>
    </header> <!-- /. main-header -->

  <div class="content-container">
    <div class="panel panel-default">
  <div class="panel-body" style="min-height: 300px">
      <h2>No se pudo confirmar la entrega</h2>
      <p>Hubo un error al confirmar la entrega.</p>
      </div>
      </div>
  </div>

    <footer class="main-footer">
        <div class="footer-bottom">
            <div class="text-right">
                © +Post Warehouse 2017
        </div>
      </div>
    </footer>
  </body>
</html>';
}  else {
   echo '<html>
    <head>
        <meta charset="utf-8">
        <title>Maspost Warehouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="/css/profile.css">
    </head>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-default " role="navigation"

            <div class="navbar-main">
                  <div class="container">
                <div class="navbar-header">
                  <img src="/images/maspost-sm.png" alt="" border="0"></a>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php">LOGIN</a></li>
                  </ul>
                </div> <!-- /#navbar -->
                </div>
            </div> <!-- /.navbar-main -->
        </nav>
    </header> <!-- /. main-header -->

  <div class="content-container">
    <div class="panel panel-default">
  <div class="panel-body" style="min-height: 300px">
      <h2>Entrega Confirmada!</h2>
      <p>Su entrega ha sido programada para <strong>'.$fecha.'</strong>.</p>
      <p>En caso de retraso o cancelación favor de notificarnos por correo electrónico info@maspostwarehouse.com lo antes posible.</p>
      </div>
      </div>
  </div>

    <footer class="main-footer">
        <div class="footer-bottom">
            <div class="text-right">
                © +Post Warehouse 2017
        </div>
      </div>
    </footer>
  </body>
</html>';
}//elsemail
}//ifgetrec
}//ifresultado
?>
