<?php
session_start();
require_once('connection.php');
include './helpers/is_logged_in.php';

if ($logged_in) {
  include './helpers/get_user_info.php';
}

$consulta='SELECT * from clientes WHERE pmb = '.$pmb.';SELECT nombre,email FROM c_recibir WHERE pmb = '.$pmb.' AND tipo = 1;SELECT nombre,id,email FROM c_recibir WHERE pmb = '.$pmb.' AND tipo = 2;SELECT nombre,id,app,apm,email FROM c_entregar WHERE pmb = '.$pmb.';';
$count = 0;
if (mysqli_multi_query($enlace, $consulta)) {
 do {
    $count++;
    if ($result=mysqli_store_result($enlace)) {
      $countR=0;
      while($row=mysqli_fetch_assoc($result)) {
        if ($count == 1) {
          $array['clientes'][$countR]=$row;
          $countR++;
        } else if($count == 2) {
          $array['titular'][$countR]=$row;
          $countR++;
        } else if($count == 3) {
          $array['adicionales'][$countR]=$row;
          $countR++;
        } else if($count == 4) {
          $array['entrega'][$countR]=$row;
          $countR++;
        }
      }
  }
  mysqli_free_result($result);
} while(mysqli_more_results($enlace) && mysqli_next_result($enlace));
  $informacion = $array;
} else {
  echo 'Error en la consulta.';
}

include "./templates/_head.php";
include "./templates/_header.php";
?>
<div class="content-container">
  <div class="perfil-form">
    <div class="panel panel-default">
      <div class="panel-body">
        <h2 style="color: #1c51c6;">Información de Perfil</h2>
        <h4>Paso 2 / 3</h4>
        <form  method="post" enctype="multipart/form-data" name="form1" action="/helpers/guardar_perfil.php">
          <div class="form-group">
            <h3 style="color: #1c51c6;">Datos Generales</h3>
            <label for="direccion" style="margin-top: 10px;">Dirección: <span style="color:red;">*</span></label>
            <input onchange="checkAddress()" type="text" class="form-control" id="direccion" name="direccion" required>

            <label for="pais" style="margin-top: 10px;">País: <span style="color:red;">*</span></label>
            <br>
            <select name="pais" id="pais" onchange="otroPais()" class="form-control" required>
             <option value="Estados Unidos">Estados Unidos</option>
             <option value="Mexico">México</option>
             <option value="Otro">Otro</option>
            </select>

            <div id="otro-pais-container" style="visibility: visible;display:none">
              <label for="pais-otro" style="margin-top: 10px;">Nombre País: <span style="color:red;">*</span></label>
              <input type="text" name="pais-otro" class="form-control" id="pais-otro">
            </div>

            <label for="estado" style="margin-top: 10px;">Estado: <span style="color:red;">*</span></label>
            <input type="text" name="estado" class="form-control" id="estado">

            <label for="ciudad" style="margin-top: 10px;">Ciudad: <span style="color:red;">*</span></label>
            <input type="text" class="form-control" name="ciudad" id="ciudad"required>

            <label for="codigopostal" style="margin-top: 10px;"required>Código Postal: <span style="color:red;">*</span></label>
            <input type="text" class="form-control" id="codigopostal" name="codigopostal">

            <label for="telefono" style="margin-top: 10px;">Teléfono:</label>
            <input type="phone" class="form-control" id="telefono" name="telefono">

            <label for="celular" style="margin-top: 10px;">Celular: <span style="color:red;">*</span></label>
            <input type="phone" class="form-control" id="celular" name="celular" required>
            <br>
            <label for="tipo">Razón Social:</label>
            <br>
            <?php
              if ($informacion['clientes'][0]['id_plan'] == 1) {
                echo '<input type="text" class="form-control" id="tipo" name="tipo" readonly="true" value = "Persona" required>';
              } else {
                 echo '<input type="text" class="form-control" id="tipo" name="tipo" readonly="true" value = "Empresa" required><label for="tipo">Nombre Empresa:</label><input type="text" class="form-control" id="empresa" readonly="true" value = "'.$informacion['clientes'][0]['razon_social'].'" required><label for="rfc" style="margin-top: 10px;">RFC: <span style="color:red;">*</span></label><input type="text" name="rfc" class="form-control" id="rfc"><label for="pais-empresa" style="margin-top: 10px;">País: <span style="color:red;">*</span></label><input type="text" name="pais-empresa" class="form-control" id="pais-empresa"></div></div>';
              }
            ?>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group">
          <h3 style="color: #1c51c6;">Información del Titular</h3>
            <label for="nombre" style="margin-top: 10px;">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $informacion['titular'][0]['nombre'] ?>" readonly="true" required>
            <label for="email-titular" style="margin-top: 10px;">Email: <span style="color:red;">*</span></label>
            <input type="text" class="form-control" name="email-titular" id="email-titular" value="<?php echo $informacion['clientes'][0]['email'] ?>" required>
            <label for="visa" style="margin-top: 10px;">Visa:</label>
            <input type="file" class="form-control" name="visa" id="visa">
            <label for="ife" style="margin-top: 10px;">IFE (o como último recurso Licencia de Conducir):</label>
            <input type="file" class="form-control" name="ife" id="ife">
        </div>
      </div>
     </div>
      <div class="panel panel-default">
      <div class="panel-body">
        <h3 style="color: #1c51c6;">Información de Usuarios Adicionales</h3>
        <p>Usuarios autorizados para recibir paquetería.</p>
        <?php
          $count =0;
          if (array_key_exists('adicionales', $informacion)) {
            foreach($informacion['adicionales'] as $usuario) {
              $count++;
              echo '
                <div class="form-group">
                  <label for="nombre" style="margin-top: 10px;">Nombre:</label>
                  <input type="text" class="form-control" name="nombreadicional[]" id="nombre" value="'.$usuario['nombre'].'" readonly="true">
                  <label for="email-adicional" style="margin-top: 10px;">Email:</label>
                  <input type="text" class="form-control" name="emailadicional[]" id="email-adicional" autocomplete="on" value="';if($usuario['email']){echo $usuario['email'];} else { echo '';} echo'"><input type="hidden" class="form-control" name="idadicional[]" id="id-adicional" value="'.$usuario['id'].'">
                  <br><button class="btn green-button" type="button" onclick="borrarClienteRecibir('.$usuario['id'].',\'' . $usuario['nombre'] . '\')">Borrar</button>
                  <div id="borrar-loading'.$usuario['id'].'"></div>
                </div>';
            }
          } else {
            echo '<p>No cuenta con usuarios adicionales por el momento.</p>';
          }
          ?>
            <button type="button" class="btn button" onclick="agregarAdicional()">Agregar Adicional</button>
            <div class="form-group" id="agregar-adicional" style="visibility:visible;display:none;margin-top: 46px;">
              <h3 style="color: #1c51c6;">Agregar Usuario:</h3>
              <p>Recuerda que cada usuario adicional tiene un costo extra de $20 dólares.</p>
              <label for="nombre" style="margin-top: 10px;">Nombre:</label>
              <input type="text" class="form-control" id="nombre-adicional">
              <label for="apellido" style="margin-top: 10px;">Apellido:</label>
              <input type="text" class="form-control" id="apellido-adicional">
              <label for="email-adicional" style="margin-top: 10px;">Email:</label>
              <input type="text" class="form-control" id="email-adicional-nuevo">
              <br><button class="btn green-button" type="button" onclick="agregarClienteRecibir()">Agregar</button>
              <div id="recibir-loading"></div>
          </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <h3 style="color: #1c51c6;">Autorizados Para Recoger</h3>
              <?php
                $count =0;
                if (array_key_exists('entrega', $informacion)) {
                  echo'<div class="form-group" id="autorizados"><input type="hidden" class="form-control"  id="autorizados-length" value="'.sizeof($informacion['entrega']).'">';
                  foreach($informacion['entrega'] as $usuario) {
                    $count++;
                    echo '
                      <div class="form-group" id="agregar-autorizado-form"><label for="nombre" style="margin-top: 10px;">Nombre:</label>
                        <input type="text" class="form-control" name="nombreautorizado[]" id="nombre" value="'.$usuario['nombre'].' '.$usuario['app'].' '.$usuario['apm'].'">
                        <label for="email-autorizado" style="margin-top: 10px;">Email:</label>
                        <input type="text" class="form-control" name="emailrecoger[]" id="email-autorizado">
                        <input type="hidden" class="form-control" name="autorizadosids[]" id="ids-autorizados" value="'.$usuario['id'].'">
                        <br>
                        <button class="btn green-button" type="button" onclick="borrarEntregar('.$usuario['id'].')">Borrar</button>
                      </div>';
                  }
                  if (sizeof($informacion['entrega'] == $count)) {
                    echo '</div>';
                  }
                } else {
                  echo '<div class="form-group" id="autorizados"><div class="form-group"id="agregar-autorizado-form"><p>No tiene usuarios autorizados para recoger en este momento.</p></div></div>';
                }
              ?>
              <?php
                if (array_key_exists('entrega', $informacion)){if(sizeof($informacion['entrega']) < 5) {
                  echo '
                    <br>
                      <button type="button" class="btn button" id="boton-agregar-autorizado" onclick="agregarAutorizado()">Agregar Autorizado</button>';
                } else {
                  echo '<br><button type="button" class="btn button" id="boton-agregar-autorizado" onclick="agregarAutorizado()">Agregar Autorizado</button>';
                }
              ?>
      </div>
      <div class="form-group" style="visibility:visible;display:none;margin-top: 46px;" id="agregar-autorizado">
        <label for="nombre" style="margin-top: 10px;">Nombre:</label>
        <input type="text" class="form-control" id="nombre-autorizado">
        <label for="apellido" style="margin-top: 10px;">Apellido Paterno:</label>
        <input type="text" class="form-control" id="apellido-paterno-autorizado">
        <label for="apellido" style="margin-top: 10px;">Apellido Materno:</label>
        <input type="text" class="form-control" id="apellido-materno-autorizado">
        <br>
        <button class="btn green-button" type="button" onclick="emailAutorizado()">Guardar</button><div id="autorizado-loading"></div>
      </div>
      <input name="button" type="submit" value="Siguiente" class="btn green-button" style="float:right;width:120px;margin-bottom: 15px;margin-right:15px"/>
    </div>
</form>
        </div>
      </div>
    </div>
  </div>
<?php
  include './templates/_footer.php';
?>
