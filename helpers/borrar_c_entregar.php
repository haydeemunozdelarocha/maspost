<?php
session_start();
include "../connection.php";
include "checar_sesion_usuario.php";

require "../PHPMailer/PHPMailerAutoload.php";

$pmb=$_SESSION['pmbU'];

$id =$_POST['id'];

if(!empty($_POST['id'])){
  $nombre=mysqli_real_escape_string($enlace,$_POST["id"]);

  $query = "DELETE FROM c_entregar WHERE id = ".$id.";";


  $resultado = mysqli_multi_query($enlace,$query) or die("Error 1 $query <Br>".  mysqli_error($enlace) );

    if ($resultado) {
     echo  'done';
    exit();

      } else{
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
      }
    }

?>
