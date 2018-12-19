<?php
session_start();
include "../connection.php";

  //  if (isset($_GET['controller']) && isset($_GET['action'])) {
  //   $controller = $_GET['controller'];
  //   $action     = $_GET['action'];
  // } else {
  //   $controller = 'inventario';
  //   $action     = 'home';
  // }

  // require_once('views/layout.php');

$pmb=$_SESSION['pmbU'];


if($_SERVER['REQUEST_METHOD'] == 'POST'){


if(!empty($_POST['accept'])){

date_default_timezone_set('America/Denver');
$currentDateTime = date('Y-m-d h:i A');


$consulta  = "SELECT @id:=id AS id FROM clientes WHERE pmb =".$pmb.";UPDATE clientes SET perfil_status=3,fecha_firma_terminos='".$currentDateTime."' where id = @id;";

      $resultado = mysqli_multi_query($enlace,$consulta) or die("Error 1 $consulta <Br>".  mysqli_error($enlace) );
    if ($resultado) {
     header("Location: ../home.php"); /* Redirect browser */
    exit();

      } else{
          echo"<script>alert(\"Error en la conexión. Por favor intente de nuevo.\");</script>";
      }
} else {
   echo"<script>alert(\"Por favor indique si ha leido y aceptado los terminos y condiciones.\");</script>";
     header("Location: ../terms.php");
}
}

?>
