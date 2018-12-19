<?php
session_start();
include '../connection.php';
$pmb=$_SESSION['pmbU'];


$consultaautorizados = "SELECT nombre,email,id,app,apm FROM c_entregar WHERE pmb = ".$pmb.";";
$autorizados = mysqli_query($enlace,$consultaautorizados);
$rows = array();
while($r = mysqli_fetch_assoc($autorizados)) {
    $rows[] = $r;
}


$resultado = array(
    "autorizados" => $rows
);
print json_encode($resultado);

?>
