<?php
session_start();
include "connection.php";

require 'PHPMailer/PHPMailerAutoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

parse_str($_SERVER['QUERY_STRING'],$output);
$output['ids']=explode(",",$output['ids']);

$hora2=$_POST['hora2'];

$id =$output['ids'][0];
$express_id =$output['ids'];
$express_id = implode(",",$express_id);


$fecha = $output['fecha'];
$hora = $output['hora'];

$query = 'select clientes.email FROM entrega_express JOIN recepcion ON recepcion.id = entrega_express.recepcion_id JOIN clientes on recepcion.pmb = clientes.pmb WHERE entrega_express.recepcion_id ='.$id;

$resultado = mysqli_query($enlace,$query) or die(mysqli_error($enlace));

$res = mysqli_fetch_assoc($resultado);

$email = $res['email'];

if($email){

$mail = new PHPMailer;
<<<<<<< HEAD

=======
>>>>>>> 1586c14
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'a2plcpnl0769.prod.iad2.secureserver.net';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreply@maspostwarehouseusers.com';          // SMTP username
$mail->Password = 'Bendecida77'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;
<<<<<<< HEAD
$mail->isHTML(true);                     // TCP port to connect to

$mail->setFrom('haydeemunozdelarocha@gmail.com', 'Maspost Warehouse');
$mail->addReplyTo('haydeemunozdelarocha@gmail.com', 'Maspost Warehouse');
=======
$mail->isHTML(true);
$mail->setFrom('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
$mail->addReplyTo('noreply@maspostwarehouseusers.com', 'Maspost Warehouse');
>>>>>>> 1586c14
$mail->addAddress($email);   // Add a recipient
$mail->addCC('haydeemunozdelarocha@gmail.com');
  $bodyContent = '<html><body style="min-height:400px;"><header style="width:100%;height:70px;border-bottom: 3px #f9f9f9 solid;"><a href="http://maspostwarehouse.com"><img src="http://www.maspostwarehouseusers.com/images/maspost-sm.png" height="70px" alt="" border="0"></a></header>
  <div style="padding-bottom:10px;">
  <h2>Disponibilidad Entrega Express</h2>
<<<<<<< HEAD
  <p>La solicitud de entrega express para <strong> ' . $fecha . '</strong> tiene disponibilidad de horario a las '.$hora2.'</p>
=======
  <p>La solicitud de entrega express para <strong> ' . $fecha . '</strong> tiene disponibilidad de horario a las <strong>'.$hora2.'</strong></p>
>>>>>>> 1586c14
  <p>Para confirmar la hora y programar la entrega, <a href="http://maspostwarehouseusers.com/functions/confirmar_express.php?id='.$express_id.'&fecha='.$fecha.' '.$hora2.'">haz click aqui.</a></p><p>Para otros horarios disponibles favor de llamar al 915.351.8160</p> </div></body><footer style="width:98%;height:11px;margin-top:10px;background-color:#1c51c6;color:#FFF;padding:20px;"><div style="text-align:center;">+Post Warehouse |  2220 Bassett Ave |  El Paso, TX  |  915.351.8160</div></footer>';


$mail->Subject = 'Disponibilidad Entrega Express';

$mail->Body    = $bodyContent;


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
<<<<<<< HEAD

=======
>>>>>>> 1586c14
   echo '
<html>
    <head>
        <meta charset="utf-8">
        <title>Maspost Warehouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/profile.css">
    </head>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-default " role="navigation"

            <div class="navbar-main">
                  <div class="container">
                <div class="navbar-header">
                  <img src="images/maspost-sm.png" alt="" border="0"></a>
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
      <h2>Correo Enviado!</h2>
      <p>El cliente ha recibido una notificación con el horario disponible.</p>
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
}
} else {
 echo '
<html>
    <head>
        <meta charset="utf-8">
        <title>Maspost Warehouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/profile.css">
    </head>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-default " role="navigation"

            <div class="navbar-main">
                  <div class="container">
                <div class="navbar-header">
                  <img src="images/maspost-sm.png" alt="" border="0"></a>
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
      <p>El cliente no ha registrado una dirección de correo electrónico.</p>
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
}


}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Maspost Warehouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/profile.css">
    </head>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-default " role="navigation"

            <div class="navbar-main">
                  <div class="container">
                <div class="navbar-header">
                  <img src="images/maspost-sm.png" alt="" border="0"></a>
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
  <form action="" method="POST">
  <h2>Confirmación de Disponibilidad</h2>
  <p>Por favor confirme su disponibilidad:</p>
    <label for="hora">Hora</label>
        <select name="hora2" id="hora"  class="form-control" >
          <option value="09:00 AM">9:00 AM</option>
          <option value="09:30 AM">9:30 AM</option>
          <option value="10:00 AM">10:00 AM</option>
          <option value="10:30 AM">10:30 AM</option>
          <option value="11:00 AM">11:00 AM</option>
          <option value="11:30 AM">11:30 AM</option>
          <option value="12:00 PM">12:00 PM</option>
          <option value="12:30 PM">12:30 PM</option>
          <option value="1:00 PM">1:00 PM</option>
          <option value="1:30 PM">1:30 PM</option>
          <option value="2:00 PM">2:00 PM</option>
          <option value="2:30 PM">2:30 PM</option>
          <option value="3:00 PM">3:00 PM</option>
          <option value="3:30 PM">3:30 PM</option>
          <option value="4:00 PM">4:00 PM</option>
          <option value="4:30 PM">4:30 PM</option>
        </select>
        <br>
        <input type="submit" class="btn green-button">
  </form>
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
</html>

