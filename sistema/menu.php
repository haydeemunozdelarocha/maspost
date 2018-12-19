<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Home</title>
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
  <div id="home-container">
    <div class="row row-home">
        <div class="col-sm-8">
            <div class="panel panel-default home-panel" style="max-height: 418px;overflow: auto;">
                <div class="panel-body ">
                 <h4>Entregas Express</h4>
                  <table class="table table-striped home-table">
                    <thead>
                      <th>Fecha</th>
                      <th>No.Paquetes</th>
                      <th>PMB</th>
                      <th></th>
                    </thead>
                    <tbody>


<?php

  $consulta = "SELECT entrega_express.preparado,entrega_express.express_id,DATE_FORMAT(STR_TO_DATE(fecha, '%y-%m-%d %h:%i %p'),'%m-%d-%y %H:%i %p'),COUNT(express_recepcion.recepcion_id),recepcion.pmb FROM entrega_express JOIN express_recepcion ON express_recepcion.express_id = entrega_express.express_id JOIN recepcion ON express_recepcion.recepcion_id = recepcion.id WHERE recepcion.id_salida = 0 AND DATE_FORMAT(STR_TO_DATE(fecha, '%y-%m-%d %h:%i %p'),'%Y-%m-%d %H:%i:%s')>DATE_SUB(NOW(), INTERVAL 2 DAY) GROUP BY express_recepcion.express_id ORDER BY fecha ASC;";
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if(@mysql_num_rows($resultado3)>=1)
  {
while($row = mysql_fetch_assoc($resultado3)) {
  echo '<tr>';
  $count = 0;
  $preparado = '';
      foreach ($row as $value) {
        if($count == 0){
          if($value == 1){
            $preparado = " express-lista ";
          }
        }
        else if($count == 1){
          $id=$value;
        } else {
         echo '<td class="'.$preparado.'">'.$value.'</td>';
        }
         $count++;
      }

      echo '<td class="'.$preparado.'"><a href="detalle_express.php?id='.$id.'"><span class="glyphicon glyphicon-edit"></span></a></td>';
      echo '</tr>';
  }

} else {
  echo '<td>No hay entregas express.</td>';
}
?>


                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default" style="max-height: 400px;overflow: auto">
                <div class="panel-body">
                 <h4>Vencimientos</h4>
                  <table class="table table-striped home-table">
                    <thead>
                      <th>PMB</th>
                      <th>Vigencia</th>
                      <th>Nombre</th>
                    </thead>
                    <tbody>
<?php
 $consulta = 'SELECT clientes.pmb,DATE_FORMAT(str_to_date(clientes.vigencia,"%Y-%m-%d"),"%m/%d/%y"),c_recibir.nombre FROM clientes INNER JOIN c_recibir ON clientes.pmb = c_recibir.pmb WHERE vigencia < DATE_FORMAT(now(),"%Y-%m-%d") and  clientes.pmb <999 group by pmb order by vigencia ASC;';//clientes.tipo = 1 and
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
if(@mysql_num_rows($resultado3)>=1)
  {
    echo '<tr>';
while($row = mysql_fetch_assoc($resultado3)) {
      foreach ($row as $value) {
       echo '<td>' . $value . '</td>';
  }
  echo '<tr>';

}


}
?>
       </tbody>
                  </table>
                </div>
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
