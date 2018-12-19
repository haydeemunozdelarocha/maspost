<?php
session_start();
include '../connection.php';
$pmb=$_SESSION['pmbU'];

$mes = $_POST['mes'];
$date1= $mes.'-1';
$date2=$mes.'-31';
$entregadosmes = "select (concat(DATE_FORMAT(recepcion.fecha_entrega,'%d'),'-',ELT(DATE_FORMAT(recepcion.fecha_entrega,'%m'),'Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'),'-',DATE_FORMAT(recepcion.fecha_entrega,'%y'))) as fecha_entrega,recepcion.entrada,salidas.id as salida,tipo_entradas.nombre AS tipo,recepcion.fromm,recepcion.nombre,fleteras.nombre AS fletera,recepcion.traking,recepcion.peso,recepcion.cod,salidas.entrego from recepcion join tipo_entradas on recepcion.tipo = tipo_entradas.id join fleteras on recepcion.fletera = fleteras.id JOIN salidas on recepcion.id_salida = salidas.id WHERE fecha_entrega IS NOT NULL AND recepcion.pmb = ".$pmb." AND fecha BETWEEN '".$date1."' AND '".$date2."' ORDER BY recepcion.fecha_entrega DESC;";

$entregados = mysqli_query($enlace,$entregadosmes);
$rows = array();
while($r = mysqli_fetch_assoc($entregados)) {
    $rows[] = $r;
}


print json_encode($rows);

?>
