<?php
session_start();
require_once('../connection.php');
require '../vendor/password_compat-master/lib/password.php';

if (array_key_exists("email", $_POST) && array_key_exists("password", $_POST)) {
      $email = mysqli_real_escape_string($db, $_POST["email"]);
      $password = $_POST["password"];
      $query  = "SELECT * FROM clientes where email = '".$email."';";
      $result = mysqli_query($db, $query) or die("Error 1 $consulta <Br>".  mysqli_error($db) );

      if ($result) {
        $res = mysqli_fetch_array($result, MYSQLI_BOTH);
          if (password_verify($password, $res['password'])) {
            $_SESSION['cliente'] = $res;
            $_SESSION['idU'] = $_SESSION['cliente']['id'];
            $_SESSION['emailU'] = $_SESSION['cliente']['email'];
            $_SESSION['tipoU'] = $_SESSION['cliente']['tipo'];
            $_SESSION['pmbU'] = $_SESSION['cliente']['pmb'];

            if ($_SESSION['cliente']['perfil_status']==1) {
              header("Location: /perfil.php");
            } else if ($_SESSION['cliente']['perfil_status']==2) {
              header("Location: /terms.php");
            } else {
              header("Location: /home.php");
            }
          } else {
            echo"<script>window.location=\"index.php\"; alert(\"Usuario o contraseña incorrecta.\");</script>";
            return;
          }
        }
} else if (array_key_exists('email', $_POST) || array_key_exists('password', $_POST)) {
   echo"<script>alert(\"Por favor ingrese su email y password.\");</script>";
   return;
}
?>
