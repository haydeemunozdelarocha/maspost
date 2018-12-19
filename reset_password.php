<?php
require_once('connection.php');
require "./vendor/password_compat-master/lib/password.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  date_default_timezone_set('America/Denver');
  $email =$_GET['email'];
  $pmb =$_GET['pmb'];
  $token =$_GET['token'];
  $revisarEmail = 'SELECT password FROM clientes WHERE pmb = '.$pmb.' AND email = "'.$email.'"';
  $resultado = mysqli_query($db, $revisarEmail) or die(mysqli_error($db));

if ($resultado) {
 $res = mysqli_fetch_array($resultado,MYSQLI_BOTH);
 if ($res['password'] === $token) {
  echo '
  <div class="content-container">
    <div class="login-form">
      <h2>NUEVA CONTRASEÑA</h2>
      <form id="form1" name="form1" method="POST" action="">
        <input  class="form-control" name="email" type="text" id="email" value="'.$email.'" required />
        <input type="password" class="form-control" style="margin-top: 15px;" name="password" type="password" id="password" placeholder="Contraseña" required />
        <input type="password" class="form-control" style="margin-top: 15px;" name="confirmar-password" type="confirmar-password" id="confirmar-password" placeholder="Confirmar Contraseña" required />
        <input class="form-control" style="margin-top: 15px;" name="pmb" type="pmb" id="pmb" value="'.$pmb.'" required />
        <div id="login-button-container">
          <input name="button" type="submit" id="button" value="Cambiar" class="btn white-button" />
        </div>
      </form>
    </div>
  </div>';
 } else {
  echo"<script>alert(\"El enlace ha expirado por favor intentelo de nuevo.\");</script>";
 }
} else {
  $email = $_POST['email'];
  $pmb = $_POST['pmb'];
  $password = $_POST["password"];
  $confirm_password = $_POST['confirmar-password'];
  include './helpers/change_password.php';
}
?>
