<?
session_start();
include "checar_sesion_admin.php";
include "coneccion.php";

$idEmp=$_SESSION['idU'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PMB office Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
td img {display: block;}

</style>
<!--Fireworks 8 Dreamweaver 8 target.  Created Wed Dec 14 11:47:01 GMT-0700 2011-->
<script type="text/JavaScript">
<!--



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<link rel="stylesheet" href="thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery-1[1].3.2.js"></script> 
<script type="text/javascript" src="thickbox.js"></script>

 <script type="text/javascript" src="jquery.tablesorter.min.js"></script>
<link href="images/texto.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@import "style.css";.style1 {color: #FFFFFF}
.style2 {
	font-size: 12px;
	font-weight: bold;
}
.style3 {font-size: 12px}
</style>

</head>
<?php

$id=$_GET["id1"];
$id2=$_GET["id2"];
$id3=$_GET["id3"];
$id4=$_GET["id4"];
$id5=$_GET["id5"];
$id6=$_GET["id6"];
$id7=$_GET["id7"];
$id8=$_GET["id8"];


	$totalextra=0;
	$consulta  = "SELECT date_format(fecha, '%m/%d/%Y'), monto, pmb, name,fecha, tipo  from pagos where id=$id ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$fecha=$res[0];
		$suite=$res[2];
		$total=$res[1];
		$nombre=$res[3];
		$fecha2=$res[4];
		if($res[5]=="1")
			$credito="Cargo a cuenta";
		else if($res[5]=="2")
			$credito="Efectivo";
		else if($res[5]=="3")
			$credito="TC";
		else if($res[5]=="4")
			$credito="Cheque";
		else if($res[5]=="5")
			$credito="Transferencia";
		
	}
	if($nombre=="")
	{
	$consulta  = "SELECT nombre, app, apm from c_recibir where pmb=$suite and tipo=1 and activo=1  ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";
		
	}
	}
	
	$consulta  = "SELECT nombre from usuarios where id=$idEmp ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$empleado=$res[0];
		
		
	}
	
	
?>
<body bgcolor="#ffffff">

<table width="858" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="31%" ><div align="center"><img src="images/maspost-sm.png" width="139" height="78" /></div></td>
    <td width="42%">2220 Bassett Ave. <br />
      El Paso, TX 79901<br />
      Phone:(915) 351-8160 </td>
    <td width="27%"><div align="center">RECEIPT/INVOICE<br />
      <strong>No. <? echo"$id";?> </strong></div></td>
  </tr>
  <tr>
    <td colspan="3" scope="row"><div align="left">
      <table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr>
          <td width="66%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="16%" bgcolor="#CCCCCC">DATE:</td>
          </tr>
        <tr>
          <td><? echo"$suite";?> <? echo"$nombre";?></td>
          <td><? echo"$fecha";?></td>
          </tr>
        <tr>
          <td><? echo"$credito";?></td>
          <td>&nbsp;</td>
          </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" scope="row"><hr></td>
  </tr>
</table>
<br />
<table width="858" align="left">
<?
if($id!="")
{
$fecha1=explode(" ",$fecha2);
$suma=0;
$consulta  = "SELECT date_format(pagos.fecha, '%d/%m/%Y'), pagos.monto, pagos.pmb, pagos.tipo, pagos.mes, pagos.anio, date_format(clientes.vigencia, '%d/%M/%Y')  from pagos inner join clientes on clientes.pmb=pagos.pmb where pagos.id=$id ";

	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	$count=1;
	$array=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio", "Julio","Agosto","Septiembre", "Octubre", "Noviembre", "Diciembre");
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		$fecha=$res[0];
		if($res[3]=="2")
			$concepto="Contrato/Renovación de PMB $res[5] <br>DUE DATE $res[6]";
		else if($res[3]=="1")
			$concepto="Renta espacio bodega de ".$array[$res[4]]."/$res[5]";
		else if($res[3]=="3")
			$concepto="Anualidad Secundarios $res[5] hasta";
		else if($res[3]=="4")
			$concepto="Renta Oficina de ".$array[$res[4]]."/$res[5]";
		else if($res[3]=="5")
			$concepto="Contrato/Renovación semestral de PMB $res[5] <br>DUE DATE $res[6]";
		 
		
		$total=$res[1];
		
	$suma=$suma+$total;
?>   
  <tr>
    <td width="10%"><div align="left"><? echo"$concepto";?></div></td>
    <td width="7%"><div align="center">$<? echo number_format($total,2);?></div></td>
  </tr>
 <?
 $count++;
 }
 ?>
 <tr>
    <td><div align="right">Total</div></td>
    <td bgcolor="#CCCCCC"><div align="center">$<? echo number_format($suma,2);?></div></td>
  </tr>
 <?
 }
 ?> 
</table>



  <script>
window.print();
    </script>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="790" align="left">
  <tr>
    <td width="10%" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
window.print();
    </script>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
