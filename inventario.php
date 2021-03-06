<?php
$login_required_page = true;
session_start();
include 'connection.php';
include './helpers/is_logged_in.php';

if ($logged_in) {
  include './helpers/get_user_info.php';
}

$query='select (concat(DATE_FORMAT(recepcion.fecha_recepcion,"%d"),"-",ELT(DATE_FORMAT(recepcion.fecha_recepcion,"%m"),"Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),"-",DATE_FORMAT(recepcion.fecha_recepcion,"%y"))) AS fecha_recepcion,recepcion.entrada,recepcion.id,recepcion.peso,tipo_entradas.nombre AS tipo,recepcion.fromm,recepcion.nombre,fleteras.nombre AS fletera,recepcion.traking,recepcion.cod  from recepcion join tipo_entradas on recepcion.tipo = tipo_entradas.id join fleteras on recepcion.fletera = fleteras.id where fecha_entrega IS NULL AND id_salida =0 AND pmb = ' . $pmbU . ' ORDER BY recepcion.fecha_recepcion DESC; select c_entregar.nombre,c_entregar.app,c_entregar.apm from c_entregar where pmb = ' . $pmbU .';';
$count = 0;

if (mysqli_multi_query($db, $query)) {
 do {
   $count++;
    if ($result=mysqli_store_result($db)) {
      $countR=0;
      $countA=0;
      $countS=0;
      while($row=mysqli_fetch_assoc($result)) {
        if ($count == 1) {
          $array['recepcion'][$countR]=$row;
          $countR++;
        } else if ($count == 2) {
          $array['autorizados'][$countA]=$row;
          $countA++;
        }
      }
    }
    mysqli_free_result($result);
  } while(mysqli_more_results($db) && mysqli_next_result($db));
}

include "./templates/_head.php";
include "./templates/_header.php";
?>
  <div class="content-container">
    <div id="go-top"><a id='arrow-button' href="#toppage"><span class="glyphicon glyphicon-circle-arrow-up"></span></a></div>
    <div class="popup" id="popup-express">
      <div class="popup-header">
        <div class="popup-close" onclick="cerrarPopup()">X</div>
        </div>
        <div class="popup-container">
          <h3>Programa tu entrega: </h3>
          <div id="error-express">
          </div>
          <div id="dia-container">
          <label for="fecha_express">Día</label>
            <input type="date" id="fecha_express" class="form-control" onChange="clearError();checkWeekend();" min="<?php date_default_timezone_set('America/Denver'); echo date("Y-m-d"); ?>" />
          </div>
          <div id="hora-container">
          <label for="hora">Hora</label>
          <select name="hora" id="hora_express"  class="form-control" onChange="clearError()">
            <option value="09:30">9:30 AM</option>
            <option value="10:00">10:00 AM</option>
            <option value="10:30">10:30 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="11:30">11:30 AM</option>
            <option value="12:00">12:00 PM</option>
            <option value="12:30">12:30 PM</option>
            <option value="13:00">1:00 PM</option>
            <option value="13:30">1:30 PM</option>
            <option value="14:00">2:00 PM</option>
            <option value="14:30">2:30 PM</option>
            <option value="15:00">3:00 PM</option>
            <option value="15:30">3:30 PM</option>
            <option value="16:00">4:00 PM</option>
            <option value="16:30">4:30 PM</option>
          </select>
          </div>
            <div id="nombres-express">
               <label>Quién va a recojer?:</label>
               <select class="form-control" name="nombre" id="express-nombre-recojer" onChange="abrirCampoOtro()">
                  <option value="">---</option>
                  <?php
                     foreach ($array['autorizados'] as $rowA) {
                       echo '<option value="' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm']. '">' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm'].'</option>';
                     }
                  ?>
                  <option value="otro">Otro</option>
               </select>
            </div>
            <div id="otro-recojer" style="display:none;">
              <label>Otro:</label>
              <input class="form-control"  type="text" id="express-nombre-nuevo" placeholder="Nombre">
              <br>
              <input class="form-control"  type="text" id="express-apellido-nuevo" placeholder="Apellido">
            </div>
            <input style="margin-top:24px;" name="button" type="submit" id="button" value="Programar" onclick="sortExpress()" class="btn green-button button-popup" />
            <div id='express-loading' style="display:inline"></div>
        </div>
      </div>
      </div>
      <div class="popup" id="popup-autorizacion">
        <div class="popup-header">
          <div class="popup-close" onclick="cerrarPopup()">X</div>
        </div>
          <div class="popup-container">
            <h3>Autorización para entrega: </h3>
            <div id="error-autorizacion"></div>
            <div id="autorizacion-container">
              <label>Selecciona un nombre de la lista:
              <select class="form-control" name="autorizado" id="nombres-autorizados">
              <option value="">---</option>
                <?php
                  foreach ($array['autorizados'] as $rowA) {
                        echo '<option value="' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm']. '">' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm'].'</option>';

                    }
                ?>
              </select>
              </label>
              <label>Agrega uno nuevo:
              <input class="form-control" type="text" id="nombre-nuevo" placeholder="Nombre">
              <br>
              <input class="form-control"  type="text" id="apellido-nuevo" placeholder="Apellido">
              </label>
              <input name="button" type="submit" id="button" value="Autorizar" onclick="guardarAutorizado()" class="btn green-button button-popup" />
              <div id='autorizacion-loading' style="display:inline"></div>
            </div>
          </div>
        </div>
        <div id="button-container">
          <input name="button" type="submit" id="button" onclick="showExpressPopup()" value="Entrega Express" class="btn green-button" />
          <input name="button" type="submit" id="button" onclick="showAutorizacionPopup()" value="Autorización" class="btn green-button" />
        </div>
        <div class="panel panel-default" id="inventario-panel">
        <div class="panel-body" style="height: 81%">
           <h2>Inventario</h2>
        <div id="inventario-filtros">
          <select name="tipo" class="form-control" id="tipo" onchange="getTipo()">
            <option value="0">En Bodega</option>
            <option value="1">Entregado</option>
          </select>
          <select name="mes" class="form-control" id="mes" onchange="getEntregasMes()"disabled>
            <option value="">Todo el año</option>
          </select>
        </div>
            <?php
            echo '
            <div id="recepcion-tabla-container">
            <table id="tabla-inventario" class="table table-striped" width="100%"> <col width="73"><thead id="recepcion-table-head">
              <th style="width:10%" id="fecha">Fecha Recibido</th>
              <th style="width:9%" id="id-heading">ID</th>
              <th style="width:9%">Tipo</th>
              <th style="width:13%">Remitente</th>
              <th style="width:10%">Destinatario</th>
              <th style="width:10%">Fletera</th>
              <th style="width:11%">Tracking</th>
              <th style="width:10%">Peso(lbs)</th>
              <th style="width:8%">COD</th>
              <th style="width:10%" id="recibio"><a class="selectall" onclick="selectAll()">Select All</a></th>
          </thead>';
      if (empty($array['recepcion'])) {
        echo '<tbody><tr><td >Su inventario en bodega está vacío.</tr></tbody></table></div>';
        echo '<div id="inventario-mobile">Su inventario en bodega está vacío.</div>';
      } else {
        foreach ($array['recepcion'] as $rowR) {
            echo '<tr>';
            echo '<td style="width:10%">' . $rowR['fecha_recepcion'] . '</td>';
            echo '<td style="width:9%">' . $rowR['entrada'] . '</td>';
            echo '<td style="width:9%"><a href="#" data-toggle="popover" title="Descripción" data-content="';
            switch ($rowR['tipo']) {
            case "SP-CH":
              echo "Sobre/Paquete Chico";
            break;
            case "SP-M":
              echo "Sobre/Paquete Mediano";
              break;
             case "SP-G":
              echo "Sobre/Paquete Grande";
            break;
            case "SP-XG":
              echo "Sobre/Paquete Extra-Grande";
            break;
            case "C-XCH":
              echo "Caja Extra-Chica";
            break;
            case "C-CH":
              echo "Caja Chica";
            break;
            case "C-M":
              echo "Caja Mediana";
            break;
            case "C-G":
              echo "Caja Grande";
            break;
            case "C-XG":
              echo "Caja Extra-Grande";
            break;
            }
            echo '">'.$rowR['tipo'] . '</a></td>';
            echo '<td style="width:13%">' . $rowR['fromm'] . '</td>';
            echo '<td style="width:10%">' . $rowR['nombre'] . '</td>';
            echo '<td style="width:10%">' . $rowR['fletera'] . '</td>';
            echo '<td style="width:11%">' . substr($rowR['traking'], 0, 4).'...'. substr($rowR['traking'],strlen($rowR['traking'])-4,strlen($rowR['traking'])). '</td>';
            echo '<td style="width:10%">' . $rowR['peso'] . '</td>';
            echo '<td style="width:10%">$' . $rowR['cod'] . '</td>';
            echo '<td style="width:10%"><input class="form-check-input entrega-checkbox" onclick="seleccionarPaquete(' . $rowR['id'] . ')" type="checkbox" value="' . $rowR['id'] . '"></td>';
            echo '</tr>';
      }
      echo ' </tbody>
        </table>
        </div>';
          echo '<div style="width:100%;height:10%"><p style="float:right;padding-top:9px;"><a class="selectall" onclick="selectAll()" style="font-size:17px;cursor:pointer;">Select All</a></p></div><div id="inventario-mobile">';
      foreach ($array['recepcion'] as $rowR) {
          echo '<div class="tarjeta">';
          echo '<div class="tarjeta-top"><input class="form-check-input entrega-checkbox" onclick="seleccionarPaquete(' . $rowR['id'] . ')" type="checkbox" value="' . $rowR['id'] . '"></div>';
          echo '<p><strong style="text-decoration:underline;">Recibido:</strong> ' . $rowR['fecha_recepcion'] . '</p>';
          echo '<p><strong style="text-decoration:underline;">ID:</strong> ' . $rowR['entrada'] . '</p>';
          echo '<p><strong style="text-decoration:underline;">Tipo:</strong> ';
          echo '<a href="#" data-toggle="popover" title="Descripción" data-content="';
          switch ($rowR['tipo']) {
            case "SP-CH":
              echo "Sobre/Paquete Chico";
            break;
            case "SP-M":
              echo "Sobre/Paquete Mediano";
              break;
             case "SP-G":
              echo "Sobre/Paquete Grande";
            break;
            case "SP-XG":
              echo "Sobre/Paquete Extra-Grande";
            break;
            case "C-XCH":
              echo "Caja Extra-Chica";
            break;
            case "C-CH":
              echo "Caja Chica";
            break;
            case "C-M":
              echo "Caja Mediana";
            break;
            case "C-G":
              echo "Caja Grande";
            break;
            case "C-XG":
              echo "Caja Extra-Grande";
            break;
            default:
            echo '';
            break;
          }
          echo '">'.$rowR['tipo'] . '</a></p>';
          echo '<p><strong style="text-decoration:underline;">Remitente:</strong> ' . $rowR['fromm'] . '</p>';
          echo '<p><strong style="text-decoration:underline;">Destinatario:</strong> ' . $rowR['nombre'] . '</p>';
          echo '<p><strong style="text-decoration:underline;">Fletera:</strong> ' . $rowR['fletera'] . '</p>';
          echo '<p><strong style="text-decoration:underline;">Tracking:</strong> ' . substr($rowR['traking'], 0, 4).'...'. substr($rowR['traking'],strlen($rowR['traking'])-4,strlen($rowR['traking'])) . '</p>';
           echo '<p><strong style="text-decoration:underline;">Peso(lbs):</strong> ' . $rowR['peso'] . '</p>';
          echo '<p><strong style="text-decoration:underline;">COD:</strong> ' . $rowR['cod'] . '</p>';
          echo '</div>';
        }
        echo '    </div>';
        echo '</div>';
        }
      ?>
    </div>
  </div>
</div>
<?php
  include './templates/_footer.php';
?>






