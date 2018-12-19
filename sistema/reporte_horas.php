<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Reporte de Horas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/style-admin.css">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style-admin.css">

    </head>
<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
 .nav {
          display:none;
        }
  a[href]:after {
    content: none !important;
  }
footer{
  float:right;
  bottom:0;
}

</style>
<?

include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

date_default_timezone_set('America/Denver');


  if($_SESSION['tipoU']=="0"){
include "menu_fu.php";
}else if($_SESSION['tipoU']=="1"){
include "menu_f.php";    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $and='';
  if($_POST['empleados']){
  $nombre = $_POST['empleados'];
  $and .= 'AND usuarios.id ='.$_POST['empleados'];
  }
if($_POST['fecha1'] && $_POST['fecha2']){
  $fecha1 = $_POST['fecha1'];
  $fecha2=$_POST['fecha2'];
  $and = ' AND horas_empleados.entrada BETWEEN DATE_FORMAT(STR_TO_DATE("'.$fecha1.'", "%Y-%m-%d"),"%Y-%m-%d %H:%i:%s") AND DATE_FORMAT(STR_TO_DATE("'.$fecha2.'", "%Y-%m-%d"),"%Y-%m-%d %H:%i:%s")';
  $nombre='';
} else if(!$_POST['fecha1'] || !$_POST['fecha2']){
  echo "<script>alert(\"Por favor seleccione un rango de fechas válido.\");</script>";
} else {
$fecha1 = date( 'Y-m-d', strtotime( 'monday this week' ) );;
  $fecha2 = date( 'Y-m-d', strtotime( 'sunday this week' ) );

  $and = 'AND week(now(),1)=week(STR_TO_DATE(horas_empleados.entrada, "%Y-%m-%d %H:%i:%s"),1)';
}
} else {
  $fecha1 = date( 'Y-m-d', strtotime( 'monday this week' ) );;
  $fecha2 = date( 'Y-m-d', strtotime( 'sunday this week' ) );

  $and = 'AND week(now(),1)=week(STR_TO_DATE(horas_empleados.entrada, "%Y-%m-%d %H:%i:%s"),1)';
}

  ?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">
        </nav>
    </header> <!-- /. main-header -->
  <div class="page-container">
            <div class="panel panel-default reporte-panel" >
                <div class="panel-body ">
                 <h4>Reporte de Horas</h4>
                 <div id="reporte-horas-form" style="display: flex;width:100%">
                 <form action="" method="post" name="" style="display: flex;flex-direction: row;flex-wrap:wrap;flex-grow:1;justify-content: space-between;">
                  <input  type="date" class="form-control" name="fecha1" id="fecha1" value="<?php echo $fecha1;?>">
                  <input  type="date" class="form-control" name="fecha2" id="fecha2" value="<?echo $fecha2;?>
">
                  <select name="empleados" id="empleados">
                    <option value="">-- Todos --</option>
<?php
  $consulta = "SELECT id,nombre from usuarios WHERE tipo = 0 order by nombre desc";
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if(@mysql_num_rows($resultado3)>=1)
  {
while($row = mysql_fetch_assoc($resultado3)) {
  if($nombre == $row['id']){
      echo '<option value="'.$row['id'].'" selected>'.$row['nombre'].'</option>';

    }else{
        echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';

    }
  }
}
?>
                  </select>
                  <input type="submit" class="btn green-button">
                 </form>
                 </div>
                 </div>
                 </div>
   <div class="panel panel-default reporte-panel" >
                <div class="panel-body ">
                  <table class="table table-striped home-table">
                    <thead>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Entrada</th>
                      <th>Salida</th>
                      <th>Horas</th>
                    </thead>
                    <tbody>


<?php

  $consulta = "SELECT usuarios.id,DATE_FORMAT(STR_TO_DATE(horas_empleados.entrada, '%Y-%m-%d %H:%i:%s'),'%h:%i %p') as entrada,DATE_FORMAT(STR_TO_DATE(horas_empleados.salida, '%Y-%m-%d %H:%i:%s'),'%h:%i %p') as salida,DATE_FORMAT(STR_TO_DATE(horas_empleados.entrada, '%Y-%m-%d %H:%i:%s'),'%m-%d-%y') as fecha,usuarios.nombre,ROUND((TIME_TO_SEC(TIMEDIFF(horas_empleados.salida,horas_empleados.entrada))/3600),2) as horas_trabajadas FROM horas_empleados JOIN usuarios ON usuarios.id = horas_empleados.usuario_id WHERE horas_empleados.salida IS NOT NULL $and order by usuarios.id asc;";
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if(@mysql_num_rows($resultado3)>=1)
  {
while($row = mysql_fetch_assoc($resultado3)) {
  echo '<tr>';
  $count = 0;

    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['nombre'].'</td>';
    echo '<td>'.$row['fecha'].'</td>';
    echo '<td>'.$row['entrada'].'</td>';
    echo '<td>'.$row['salida'].'</td>';
    echo '<td style="font-weight:600">'.$row['horas_trabajadas'].'</td>';


}
echo '</tr>';
} else {
  echo '<td>No hay horas registradas esta semana.</td>';
}
?>


                    </tbody>
                  </table>
                  <div style="text-align:right;width:100%">
<?php

 $consulta = "SELECT ROUND(SUM(TIME_TO_SEC(TIMEDIFF(horas_empleados.salida,horas_empleados.entrada))/3600),2) as horas_trabajadas FROM horas_empleados JOIN usuarios ON usuarios.id = horas_empleados.usuario_id WHERE horas_empleados.salida IS NOT NULL $and order by usuarios.id asc;";

  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if(@mysql_num_rows($resultado3)>=1)
  {
$row = mysql_fetch_assoc($resultado3);
echo '<h4>Total de Horas: '.$row['horas_trabajadas'].'</h4>';
}

?>
</div>
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
