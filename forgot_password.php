<?php
session_start();
include 'connection.php';
include './helpers/is_logged_in.php';

if ($logged_in) {
  include './helpers/get_user_info.php';
}
require './vendor/PHPMailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
date_default_timezone_set('America/Denver');
$email =$_POST['email'];
$pmb =$_POST['pmb'];
$revisarEmail = 'SELECT email FROM clientes WHERE pmb = '.$pmb.' AND email ="'.$email.'"';
$resultado = mysqli_query($db, $revisarEmail) or die(mysqli_error($db));

  if ($resultado) {
    $res = mysqli_fetch_array($resultado, MYSQLI_BOTH);
    if ($res['email'] === $_POST['email']) {
      $token = uniqid(true);
      $insertToken = 'UPDATE clientes SET password = "'.$token.'" WHERE pmb = '.$pmb.' AND email = "'.$email.'"';
      $resultado2 = mysqli_query($db,$insertToken) or die(mysqli_error($db));

      if ($resultado2) {
        $email = $res['email'];
        include './emails/templates/forgot_password.php';
      }

    } else {
      echo"<script>alert(\"El email ingresado no corresponde al email registrado en el sistema.\");</script>";
      echo"<script> window.location=\"forgot_password.php\"</script>";
    }
  }
} else {
  include './templates/_head.php';
  include './templates/_header.php';
  echo '
  <div class="content-container">
    <div class="login-form">
      <h2>REESTABLECER CONTRASEÑA</h2>
      <form id="form1" name="form1" method="post" action="">
        <input class="form-control" name="email" type="text" id="email" placeholder="Email Registrado" required /></td>
        <input class="form-control" style="margin-top: 15px;" name="pmb" type="pmb" id="pmb" placeholder="# de PMB" required /></td>
        <div id="login-button-container">
          <input name="button" type="submit" id="button" value="Enviar" class="btn white-button" />
        </div>
      </form>
    </div>
  </div>
';

  include './templates/_footer.php';
  }
?>


