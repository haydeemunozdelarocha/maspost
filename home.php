<?php
$login_required_page = true;
session_start();
require_once('connection.php');
include './helpers/is_logged_in.php';

if ($logged_in) {
  include './helpers/get_user_info.php';
}

$consulta='select str_to_date(recepcion.fecha_recepcion,"%Y-%m-%d") as fecha_recepcion, date_format(str_to_date(recepcion.fecha_recepcion,"%Y-%m-%d"),"%d-%b-%y") as fecha_format,tipo_entradas.nombre AS tipo,recepcion.fromm,fleteras.nombre AS fletera,recepcion.traking  from recepcion join tipo_entradas on recepcion.tipo = tipo_entradas.id join fleteras on recepcion.fletera = fleteras.id where fecha_entrega IS NULL AND pmb = '.$pmb.' ORDER BY fecha_recepcion DESC limit 0,5;';

$count = 0;
if (mysqli_multi_query($db, $consulta)) {
 do {
   $count++;
   if ($result=mysqli_store_result($db)) {
   $countR = 0;
      while ($row=mysqli_fetch_assoc($result)) {
        if ($count == 1) {
          $array['recepcion'][$countR] = $row;
          $countR++;
        }
      }
   }
   mysqli_free_result($result);
 } while(mysqli_more_results($db) && mysqli_next_result($db));
}

$consultaplan = 'select (case when clientes.razon_social then clientes.razon_social else c_recibir.nombre end) AS nombre,planes.nombre AS plan,clientes.pmb,clientes.credito AS saldo FROM clientes JOIN c_recibir ON c_recibir.pmb = clientes.pmb JOIN planes ON clientes.id_plan = planes.id WHERE clientes.pmb = ' . $pmb . ' AND c_recibir.tipo=1;';
$countplan = 0;
if (mysqli_multi_query($db, $consultaplan)) {
 do {
      if ($resultplan=mysqli_store_result($db)) {
        $row=mysqli_fetch_assoc($resultplan);
        $array['plan'][0] = $row;
      }
      mysqli_free_result($resultplan);
 } while(mysqli_more_results($db) && mysqli_next_result($db));
}

include "./templates/_head.php";
include "./templates/_header.php";
?>

<div class="content-container">
  <div id="go-top">
    <a id='arrow-button' href="#toppage"><span class="glyphicon glyphicon-circle-arrow-up"></span></a>
  </div>
  <div class="row row-home">
    <div class="col-sm-8">
      <div class="panel panel-home panel-default" style="min-height:77%;" id = "entradas-panel-home">
        <div class="panel-body scroll-table">
        <h2>En Bodega:</h2>
          <?php
            if (empty($array['recepcion'])) {
              echo '<p>No has recibido paquetes nuevos.</p>';
            } else {
              echo '<div id="home-desktop-container">
                     <table class="table table-striped">
                       <thead>
                         <tr>
                           <th>Recepción</th>
                           <th>Remitente</th>
                           <th>Tracking</th>
                           <th>Fletera</th>
                           <th></th>
                         </tr>
                       </thead>
                       <tbody>';
                        foreach ($array['recepcion'] as $rowR) {
                          echo '<tr>';
                          echo '<td style="width:115px">' . $rowR['fecha_format'] . '</td>';
                          echo '<td>' . $rowR['fromm'] . '</td>';
                          echo '<td>' . substr($rowR['traking'], 0, 4).'...'. substr($rowR['traking'],strlen($rowR['traking'])-4,strlen($rowR['traking'])) . '</td>';
                          echo '<td>' . $rowR['fletera'] . '</td>';
                          echo '</tr>';
                          }
                        echo '</tbody></table></div>';
                        echo'<div id="home-mobile">';
                        foreach ($array['recepcion'] as $rowR) {
                            echo '<div class="tarjeta">';
                            echo '<p><strong>Recepción:</strong> ' . $rowR['fecha_format'] . '</p>';
                            echo '<p><strong>Remitente:</strong> ' . $rowR['fromm'] . '</p>';
                            echo '<p><strong>Tracking #:</strong> ' . substr($rowR['traking'], 0, 4).'...'. substr($rowR['traking'],strlen($rowR['traking'])-4,strlen($rowR['traking'])) . '</p>';
                            echo '<p><strong>Fletera:</strong> ' . $rowR['fletera'] . '</p>';
                            echo '</div>';
                          }
                          echo '</div>';
                        }
          ?>
            <div>
              <a href="/inventario.php"><button style="float:right;" class="btn green-button">Ver más</button></a>
            </div>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="panel  panel-home panel-default" style="background-color: #31353a;color:white;">
        <div class="panel-body paquetes-nuevos">
          <?php
            foreach ($array['plan'] as $rowR) {
                echo '<div id="circle"><div id="pmb-number"><h1  style="margin-top:26px;"> ' . $rowR['pmb'] . '</h1><h5 style="margin-top:-2px;">PMB</h5></div></div>';
                echo '<h3>' . $rowR['nombre'] . '</h3>';
                echo '<h3>' . $rowR['plan'] . '</h3>';
                echo '<h3 style="display:none;">Saldo: $' . number_format($rowR['saldo'], 2, '.', ' ') . '</h3><br>';

              }
          ?>
        </div>
      </div>
      <div class="panel panel-home panel-default">
        <div class="panel-body paquetes-nuevos">
          <h4>Reporte de Puentes</h4>
          <iframe src="https://maspost.herokuapp.com/w/puentes" width="80%" height="220" style="border:none;"></iframe>
      </div>
    </div>
  </div>
</div>

<?php
  include './templates/_footer.php';
?>
