<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Entrega Express</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/style-admin.css">
        <script src="assets/js/modernizr-2.6.2.min.js"></script>
    </head>
<?
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
date_default_timezone_set('America/Denver');


?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">
<?php  if($_SESSION['tipoU']=="0"){
include "menu_fu.php";
}else if($_SESSION['tipoU']=="1"){
include "menu_f.php";    }?>
        </nav>
    </header> <!-- /. main-header -->
  <div class="main-container">
            <div class="panel panel-default home-panel" >
                <div class="panel-body ">
                 <h4>Entrega Express</h4>
                 <p style="color:#1c51c6" id="fecha_express"></p>
                  <table class="table table-striped ">
                    <thead>
                      <th>ID</th>
                      <th>PMB</th>
                      <th>Fecha Recepción</th>
                      <th>Remitente</th>
                      <th>Ubicación</th>
                      <th>Tipo</th>
                      <th>Nombre</th>
                      <th>Fletera</th>
                      <th>Autorizado</th>
                    </thead>
                    <tbody>


<?php

$id;

  $consulta = "SELECT entrega_express.preparado,entrega_express.express_id,entrega_express.fecha,recepcion.entrada,recepcion.pmb,recepcion.fecha_recepcion,recepcion.fromm,ubicacion.nombre as ubicacion,tipo_entradas.nombre as tipo,recepcion.nombre,fleteras.nombre as fletera,mensajes.mensaje FROM entrega_express JOIN express_recepcion ON express_recepcion.express_id = entrega_express.express_id JOIN recepcion ON express_recepcion.recepcion_id = recepcion.id JOIN ubicacion ON recepcion.ubicacion = ubicacion.id JOIN tipo_entradas ON recepcion.tipo = tipo_entradas.id LEFT JOIN mensajes ON recepcion.mensaje = mensajes.id JOIN fleteras ON fleteras.id = recepcion.fletera WHERE entrega_express.express_id = ".$_GET['id']." order by ubicacion,entrada;";

  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if(@mysql_num_rows($resultado3)>=1)
  {
  $outsideCount = 0;
while($row = mysql_fetch_assoc($resultado3)) {
  echo '<tr>';
  $count = 0;

      foreach ($row as $value) {
        echo "<script>console.log(\"log\", '$value');</script>";
        if($count == 1){
          $id = $value;
        } else if($count == 2){
          if($outsideCount == 0){

            $value=strftime('%b-%d-%y %H:%M %p',strtotime($value));
          echo '<script>var elem = document.getElementById("fecha_express");elem.innerHTML = "'.$value.'";</script>';
          }
        } else if ($count == 0){
          if($value == 1){
          $preparado = true;
          }else {
            $preparado=false;
          }
        } else {
         echo '<td>'.(string)$value.'</td>';
        }
       $count++;
      }
      echo '</tr>';
  }
  $outsideCount++;

} else {
  echo '<td>No hay entregas express.</td>';
}
?>


                    </tbody>
                  </table>
                  <button onclick="<? if($preparado){echo '';}else{echo 'prepararExpress('.$id.')';}?>" style="float:right;"class="btn <? if($preparado){echo 'green-button';}else{echo 'blue-button';}?>"><? if($preparado){echo 'Entrega Lista!';}else{echo 'Confirmar';}?></button>
                </div>
            </div>
        </div>


<?php include "footer.php" ?>

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.1.min.js"><\/script>')</script>

    <!-- Bootsrap javascript file -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- owl carouseljavascript file -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Template main javascript -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
