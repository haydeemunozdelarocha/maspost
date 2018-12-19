<?php
session_start();
include "../connection.php";
include "checar_sesion_usuario.php";

require "../PHPMailer/PHPMailerAutoload.php";

$pmb=$_SESSION['pmbU'];

$nombre =$_POST['nombre'];
$apellidopaterno =$_POST['apellidopaterno'];
$apellidomaterno =$_POST['apellidomaterno'];

if(!empty($_POST['nombre']) && !empty($_POST['apellidopaterno']) && !empty($_POST['apellidomaterno'])){
      $nombre=mysqli_real_escape_string($enlace,$_POST["nombre"]);

      $apellidopaterno=mysqli_real_escape_string($enlace,$_POST["apellidopaterno"]);
      $apellidomaterno=mysqli_real_escape_string($enlace,$_POST["apellidomaterno"]);


      $query = "INSERT INTO c_entregar(pmb,app,apm,nombre,activo) VALUES(".$pmb.",'".$apellidopaterno."','".$apellidomaterno."','".$nombre."',1);";


      $resultado = mysqli_multi_query($enlace,$query) or die("Error 1 $query <Br>".  mysqli_error($enlace) );

    if ($resultado) {
     echo 'done';
    exit();

      } else{
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
      }
    }

?>
