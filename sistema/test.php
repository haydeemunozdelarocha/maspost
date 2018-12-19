test.php
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
date_default_timezone_set("America/Chihuahua");
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

$fecha = '2017-10-01';
$fecha2 = '2017-10-31';

$monto=0;
  $consulta="select  salidas.id,   salidas.pmb, total, credito, date_format(salidas.fecha, '%m/%d/%Y'),sum(costo)+ sum(extra),sum(cod),descuento,total_s, tc,total_p from salidas  left outer join recepcion on salidas.id=recepcion.id_salida where date(salidas.fecha)>='$fecha2' and date(salidas.fecha)<='$fecha_hasta2' $and  group by salidas.id, salidas.pmb order by id";
alert($consulta);
  $resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
  $count=1;
  $total_entradas=0;
  $color="CCCCCC";
  while(@mysql_num_rows($resultado)>=$count)
  {


    $res=mysql_fetch_row($resultado);
    echo $res;
    $total_entradas=$total_entradas+($res[5]+$res[6]-$res[7]+$res[8]+$res[9]);
    if($res[3]=="1")
      $credito="Cargo a cuenta";
    else if($res[3]=="2")
      $credito="Efectivo";
    else if($res[3]=="3")
      $credito="TC";
    else if($res[3]=="4")
      $credito="Cheque";
    else if($res[3]=="5")
      $credito="Transferencia";



?>
