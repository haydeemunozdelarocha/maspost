<?php
session_start();
require_once('connection.php');
require "./vendor/password_compat-master/lib/password.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['password'] === $_POST['confirmar-password']) {
    if (isset($_POST['pmb']) && !empty($_POST['pmb']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
      $pmb= mysqli_real_escape_string($enlace,$_POST["pmb"]);
      if ($pmb!="") {
        $email= mysqli_real_escape_string($enlace,$_POST["email"]);
        $pass=mysqli_real_escape_string($enlace,$_POST["password"]);
        $options = [
          'cost' => 11
        ];

        $mensaje = '';
        $password = password_hash($pass, PASSWORD_BCRYPT, $options);

        $consulta  = "SELECT @id:=id AS id FROM clientes WHERE pmb = $pmb; UPDATE clientes set email='$email', password='$password',perfil_status=1 where id = @id;SELECT id,email,tipo,pmb,perfil_status FROM clientes WHERE pmb = $pmb";//md5()

        $resultado = mysqli_multi_query($db, $consulta) or die("Error 1 $consulta <Br>".  mysqli_error($db) );
        if ($resultado) {
          $result = mysqli_last_result($db);
          $res=mysqli_fetch_array($result,MYSQLI_BOTH);
        } else {
          echo"<script>alert(\"PMB inválido\");</script>";
        }

        $_SESSION['tipoU']=$_SESSION['cliente']['tipo'];

        if ($_SESSION['tipoU']=="0" | $_SESSION['tipoU']=="1" | $_SESSION['tipoU']=="2") {
          echo"<script> window.location=\"terms.php\"</script>";
        } else {
          echo"<script>alert(\"No tienes acceso\");</script>";
        }
      }
    }
  } else {
    echo"<script>alert(\"El password y la confirmación no concuerdan. Favor de ingresarlos de nuevo.\");</script>";
  }
}

function mysqli_last_result($db) {
  while (mysqli_more_results($db)) {
      mysqli_use_result($db);
      mysqli_next_result($db);
  }
  return mysqli_store_result($db);
}
?>
<div class="content-container">
  <div class="register-form">
    <div class="panel panel-default">
       <div class="panel-body">
          <h2 style="color: #1c51c6;">Nuevo Usuario</h2>
          <h4>Paso 1 / 2</h4>
          <form action="" method="post" enctype="multipart/form-data" name="form1">
            <div class="form-group">
              <h3 style="color: #1c51c6;">Información de Acceso</h3>
                <label for="pmb" style="margin-top: 10px;">Número de PMB: <span style="color:red;">*</span></label>
                <input type="pmb" style="width:100px;" class="form-control" name="pmb" id="pmb" required>
                <label for="email">Email: <span style="color:red;">*</span></label>
                <input type="email" name="email" class="form-control" id="email" required>
                <label for="password">Password: <span style="color:red;">*</span></label>
                <input type="password" name="password" class="form-control" id="password" required>
                <label for="password">Confirmar Password: <span style="color:red;">*</span></label>
                <input type="password" name="confirmar-password" class="form-control" id="confirmar-password" required>
            </div>
            <input name="button" type="submit" name="submit" value="Siguiente" class="btn green-button" style="float:right;"/>
          </form>
      </div>
    </div>
  </div>
</div>
