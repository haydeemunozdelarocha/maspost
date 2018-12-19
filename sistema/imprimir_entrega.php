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

$id=$_GET["id"];


	$totalextra=0;
	$consulta  = "SELECT salidas.pmb, date_format(salidas.fecha, '%m/%d/%Y %H:%i'), salidas.entrego, salidas.comentario,  salidas.total_s, salidas.total_p, salidas.descuento, salidas.credito, salidas.total, salidas.tipo, salidas.tc  from salidas where id=$id ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$fecha=$res[1];
		//$tempfecha=explode("-",$fecha);
		//$fecha="$tempfecha[1]-$tempfecha[2]-$tempfecha[0]";
		$suite=$res[0];
		$entrego=$res[2];
		$comentarios=$res[3];
		$servicios=$res[4];
		$paquetes=$res[5];
		$descuento=$res[6];
		$credito=$res[7];
		if($credito=="1")
			$credito="Cargo a cuenta";
		else if($credito=="2")
			$credito="Efectivo";
		else if($credito=="3")
			$credito="TC";
		else if($credito=="4")
			$credito="Cheque";
		else if($credito=="5")
			$credito="Transferencia";
		$total=$res[8];
		
		$tc=$res[10];
		
	}
	$consulta  = "SELECT nombre, app, apm from c_recibir where pmb=$suite and tipo=1 and activo=1  ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";
		
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

<table width="922" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="31%" ><div align="center"><img src="images/maspost-sm.png" width="139" height="78" /></div></td>
    <td width="69%">2220 Bassett<br />
      El Paso, TX 79901<br />
      Phone:(915) 351-8160 </td>
  </tr>
  <tr>
    <td colspan="2" scope="row"><div align="left">
      <table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr>
          <td width="33%" bgcolor="#CCCCCC">APARTADO:</td>
          <td width="23%" bgcolor="#CCCCCC">RECOGE</td>
          <td width="10%" bgcolor="#CCCCCC">PAGO:</td>
          <td width="21%" bgcolor="#CCCCCC">FECHA:</td>
          <td width="13%" rowspan="2" bgcolor="#CCCCCC"><div align="center">RECEIPT/<br />
            INVOICE</div></td>
        </tr>
        <tr>
          <td><? echo"$suite";?> <? echo"$nombre";?></td>
          <td><? echo"$entrego";?> </td>
          <td><? echo"$credito";?> </td>
          <td><? echo"$fecha";?></td>
          </tr>
        <tr>
          <td bgcolor="#666666"><span class="style1">Salidas: $<? echo"$paquetes";?></span></td>
          <td bgcolor="#666666"><span class="style1">Servicios: $<? echo"$servicios";?> </span></td>
          <td bgcolor="#666666"><span class="style1">TC: $<? echo"$descuento";?> </span></td>
          <td bgcolor="#666666"><span class="style1">Total: $<? echo"$total";?> </span></td>
          <td><div align="center"><strong>No. <? echo"$id";?> </strong></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" scope="row"><hr></td>
  </tr>
</table>
<table width="922" align="left">
 
  <tr>
    <td width="10%" bgcolor="#999999"><div align="center">Date</div></td>
    <td width="7%" bgcolor="#999999"><div align="center">#entry</div></td>
    <td width="10%" bgcolor="#999999"><div align="center">Kind</div></td>
    <td width="4%" bgcolor="#999999"><div align="center">Qty</div></td>
    <td width="17%" bgcolor="#999999"><div align="center">From</div></td>
    <td width="19%" bgcolor="#999999"><div align="center">To</div></td>
    <td width="8%" bgcolor="#999999"><div align="center">carrier</div></td>
    <td width="8%" bgcolor="#999999"><div align="center">Trucking</div></td>
    <td width="9%" bgcolor="#999999"><div align="center">Weigth</div></td>
    <td width="8%" bgcolor="#999999"><div align="center">Total</div></td>
  </tr>
   <?	  

	$consulta  = "select date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), entrada, tipo_entradas.nombre, fromm, recepcion.nombre, fleteras.nombre, traking, peso, costo, extra from recepcion inner join fleteras on recepcion.fletera=fleteras.id inner join tipo_entradas on recepcion.tipo=tipo_entradas.id where recepcion.id_salida=$id  order by recepcion.fecha_recepcion";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		
		$length = strlen($res[3]);
		$length = $length-4;
		$track = substr($res[3] , $length ,4);
		$total=$res[8]+$res[9];
		?>
  <tr>
    <td><div align="center"><? echo"$res[0]";?></div></td>
    <td><div align="center"><? echo"$res[1]";?></div></td>
    <td><div align="center"><? echo"$res[2]";?></div></td>
    <td><div align="center">1</div></td>
    <td><div align="center"><? echo"$res[3]";?></div></td>
    <td><div align="center"><? echo"$res[4]";?> </div></td>
    <td><div align="center"><? echo"$res[5]";?></div></td>
    <td><div align="center"><? echo"$res[6]";?></div></td>
    <td><div align="center"><? echo"$res[7]";?></div></td>
    <td><div align="center">$<? echo"$total";?></div></td>
  </tr>
  
  <?
		
			   $count=$count+1;
	}
	$count--;
?>
</table>
<script>
window.print();
</script>
<p>&nbsp;</p>
<table width="922" border="0">
  <tr>
    <td width="42">&nbsp;</td>
    <td width="42">&nbsp;</td>
    <td width="42">&nbsp;</td>
    <td width="42">&nbsp;</td>
    <td width="455">&nbsp;</td>
    <td width="221">Total de Articulos:<? echo"$count";?> </td>
    <td width="48">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><hr></td>
  </tr>
  <tr>
    <td colspan="7"><div align="center" class="style2">RECIBÍ LA MERCANCIA AQUI DESCRITA A MI ENTERA SATISFACCIÓN </div></td>
  </tr>
  <tr>
    <td height="35" colspan="7"><div align="center">____________________________________________</div></td>
  </tr>
  <tr>
    <td colspan="7"><div align="center" class="style3">FIRMA</div></td>
  </tr>
</table>
<table width="922" align="left">
  <tr>
    <td width="10%" bgcolor="#999999"><div align="center">ATENDIDO POR </div></td>
  </tr>
  <tr>
    <td><div align="center"><? echo"$empleado";?></div></td>
  </tr>
</table>
<script>
window.print();
    </script>
<p></p>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
