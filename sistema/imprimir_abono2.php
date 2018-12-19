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
	$consulta  = "SELECT date_format(fecha, '%m/%d/%Y'), monto, pmb, descuento, name, tipo  from abonos where id=$id ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$fecha=$res[0];
		$suite=$res[2];
		$total=$res[1];
		$descuento=$res[3];
		$nombre=$res[4];
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
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: $consulta" . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";
		
	}
	}
	$consulta  = "SELECT credito from clientes where pmb=$suite ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$saldo="$res[0]";
		
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

<table width="859" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="31%" ><div align="center"><img src="images/maspost-sm.png" width="139" height="78" /></div></td>
    <td width="50%">2220 Bassett Ave. <br />
      El Paso, TX 79901<br />
      Phone:(915) 351-8160 </td>
    <td width="19%"><div align="center">RECEIPT/INVOICE<br />
      <strong>No. <? echo"$id";?> </strong></div></td>
  </tr>
  <tr>
    <td colspan="3" scope="row"><div align="left">
      <table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td width="14%" bgcolor="#CCCCCC">DATE:</td>
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
 
  <tr>
    <td width="83%" bgcolor="#999999"><div align="right">PAYMENT </div></td>
    <td width="17%"><div align="left">-----$<? echo  number_format($total,2);?>
      
    </div></td>
  </tr>
   
 <? if($descuento>0){?> 
 <tr>
    <td><div align="right">DISCOUNT</div></td>
    <td><div align="left">-----$<? echo number_format($descuento,2); ?></div></td>
  </tr>
  <tr>
    <td><div align="right">TOTAL</div></td>
    <td><div align="left">-----$<? echo number_format($total+$descuento,2); ?></div></td>
  </tr>
 <? }?>
  
  <tr>
    <td bgcolor="#999999"><div align="right">BALANCE AFTER PAYMENT </div></td>
    <td><div align="left">-----$<? echo  number_format(round($saldo),2);?></div></td>
  </tr>
</table>



  <script>
window.print();
    </script>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
