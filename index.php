<?php
  session_start();
  include 'connection.php';
  include './helpers/is_logged_in.php';

  include './templates/_head.php';
  include './templates/_header.php';
?>
<div class="content-container">
  <div class="login-form">
    <h2>PORTAL DE USUARIOS</h2>
    <form id="form1" name="form1" method="post" action="./helpers/login.php">
        <input class="form-control" name="email" type="text" id="email" placeholder="Usuario" required />
        <input class="form-control" style="margin-top: 15px;" name="password" type="password" id="pass" placeholder="Password" required /></td>
        <a style="color:white;margin-top: 15px;" href="/forgot_password.php">Olvidó su contraseña?</a>
        <div id="login-button-container">
          <input name="button" type="submit" id="button" value="Entrar" class="btn white-button" />
        </div>
    </form>
  </div>
</div>
<?php
  include './templates/_footer.php';
?>
