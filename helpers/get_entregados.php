<?php
session_start();
include '../connection.php';
$pmb=$_SESSION['pmbU'];
// $pmb = 467;

date_default_timezone_set('America/Denver');
$year = date('Y', time());
$date1 = $year .'-01-01 00:00:00';
$date2= $year . '-12-31 11:59:59';

$consultaentregados = "select (concat(DATE_FORMAT(recepcion.fecha_entrega,'%d'),'-',ELT(DATE_FORMAT(recepcion.fecha_entrega,'%m'),'Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'),'-',DATE_FORMAT(recepcion.fecha_entrega,'%y'))) as fecha_entrega,recepcion.entrada,salidas.id as salida,tipo_entradas.nombre AS tipo,recepcion.fromm,recepcion.nombre,fleteras.nombre AS fletera,recepcion.traking,recepcion.peso,recepcion.cod,salidas.entrego from recepcion join tipo_entradas on recepcion.tipo = tipo_entradas.id join fleteras on recepcion.fletera = fleteras.id JOIN salidas on recepcion.id_salida = salidas.id WHERE fecha_entrega IS NOT NULL AND recepcion.pmb = ".$pmb." AND fecha_entrega BETWEEN '".$date1."' AND '".$date2."' ORDER BY recepcion.fecha_entrega DESC;";
$entregados = mysqli_query($enlace,$consultaentregados);
$rows = array();
while($r = mysqli_fetch_assoc($entregados)) {
    $rows[] = $r;
}

$consultameses="SELECT ELT(DATE_FORMAT(fecha_entrega, '%m'),'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre') as mes,DATE_FORMAT(fecha_entrega, '%m') as mes_numero,DATE_FORMAT(fecha_entrega, '%Y') as year FROM recepcion WHERE fecha_entrega IS NOT NULL AND pmb = ".$pmb." AND fecha_entrega BETWEEN '".$date1."' AND '".$date2."' GROUP BY mes ORDER BY fecha_entrega ASC;";
$meses = mysqli_query($enlace,$consultameses);
$rows2 = array();
while($k = mysqli_fetch_assoc($meses)) {
    $rows2[] = $k;
}

$resultado = array(
    "entregados" => $rows,
    "meses" => $rows2,
);
print json_encode($resultado);

?>
