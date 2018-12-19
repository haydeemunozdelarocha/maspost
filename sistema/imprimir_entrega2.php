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
@import "style.css";.style2 {
	font-size: 12px;
	font-weight: bold;
}
.style3 {font-size: 12px}
</style>

</head>
<?php

$id=$_GET["id"];


	$totalextra=0;
	$consulta  = "SELECT salidas.pmb, date_format(fecha, '%m/%d/%Y %h:%i %p'), salidas.entrego, salidas.comentario,  salidas.total_s, salidas.total_p, salidas.descuento, salidas.credito, salidas.total, salidas.tipo, salidas.tc , name from salidas where id=$id ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());	
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
		$nombre=$res[11];
	}
	if($nombre=="")
	{
	$consulta  = "SELECT nombre, app, apm from c_recibir where pmb=$suite and tipo=1 and activo=1  ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";
		
	}
	}
	
	$consulta  = "SELECT nombre from usuarios where id=$idEmp ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$empleado=$res[0];
		
		
	}
	//CANTIDAD DE PAQUETES
	$consulta  = "select date_format(recepcion.fecha_recepcion, '%d/%m/%Y'), entrada, tipo_entradas.nombre, fromm, recepcion.nombre, fleteras.nombre, traking, peso, costo, extra from recepcion inner join fleteras on recepcion.fletera=fleteras.id inner join tipo_entradas on recepcion.tipo=tipo_entradas.id where recepcion.id_salida=$id  order by recepcion.fecha_recepcion";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());	
	$cuantos_salidas=@mysql_num_rows($resultado);
	//CANTIDAD DE SERVICIOS
	$consulta  = "select cantidad, nombre, precio, cantidad*precio from detalle_servicios inner join servicios on detalle_servicios.id_servicio=servicios.id  where id_salida=$id";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: $consulta" . mysql_error());	
	$cuantos_servicios=@mysql_num_rows($resultado);
	
	//suma de COD
	$consulta2  = "select sum(cod) from recepcion  where recepcion.id_salida=$id group by id_salida";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
	
	if(@mysql_num_rows($resultado2)>=1)
	{
		$res=mysql_fetch_row($resultado2);
		$sumacod=$res[0];
		
		
	}
	$paquetes=$paquetes-$sumacod;
?>
<body bgcolor="#ffffff">

<table width="707" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="31%" ><div align="center"><img src="images/maspost-sm.png" width="139" height="78" /></div></td>
    <td width="34%">2220 Bassett Ave. <br />
      El Paso, TX 79901<br />
      Phone:(915) 351-8160 </td>
    <td width="35%"><div align="center">RECEIPT/INVOICE<br />
        <strong>No. <? echo"$id";?> </strong><br />
    </div></td>
  </tr>
  <tr>
    <td colspan="3" scope="row"><div align="left">
      <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2">
        <tr>
          <td width="17%" bgcolor="#CCCCCC"><div align="right"><strong>PMB:</strong></div></td>
          <td width="50%" bgcolor="#CCCCCC"><? echo"$suite";?> <? echo"$nombre";?></td>
          <td width="23%" bgcolor="#CCCCCC"><div align="right"><strong>ENTRY (<? echo"$cuantos_salidas";?>):</strong></div></td>
          <td width="10%" bgcolor="#CCCCCC">$<? echo number_format($paquetes,2);?></td>
          </tr>
        <tr>
          <td bgcolor="#CCCCCC"><div align="right"><strong>CUSTOMER:</strong></div></td>
          <td bgcolor="#CCCCCC"><? echo"$entrego";?></td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>SERVICES (<? echo"$cuantos_servicios";?>):</strong></div></td>
          <td bgcolor="#CCCCCC">$<? echo number_format($servicios,2);?></td>
          </tr>
        <tr>
          <td bgcolor="#CCCCCC"><div align="right"><strong>PAYMENT:</strong></div></td>
          <td bgcolor="#CCCCCC"><? echo"$credito";?></td>
          <td bgcolor="#CCCCCC"><div align="right"><strong><? if($descuento!=0){?>DISCOUNT :<?}?> </strong></div></td>
          <td bgcolor="#CCCCCC"><? if($descuento!=0){?>$<? echo number_format($descuento,2);?><? }?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>COD:</strong></div></td>
          <td bgcolor="#CCCCCC">$<? echo number_format($sumacod,2);?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC"><div align="right"><strong>DATE:</strong></div></td>
          <td bgcolor="#CCCCCC"><? echo"$fecha";?></td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>TOTAL:</strong></div></td>
          <td bgcolor="#CCCCCC">$<? echo  number_format($total,2);?></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" scope="row"><table width="707" border="0">

      <tr>
        <td width="892"><hr /></td>
      </tr>
      <tr>
        <td><div align="center" class="style2">I RECEIVED THE MERCHANDISE HERE DESCRIBED TO MY ENTIRE SATISFACTION </div></td>
      </tr>
      <tr>
        <td height="35"><div align="center">____________________________________________</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style3"><? echo"$entrego";?></div></td>
      </tr>
    </table></td>
  </tr>
   <? if($cuantos_salidas>0){?>
  <tr>
    <td colspan="3" scope="row"><p>Entries</p>
      <table width="708" align="left">
      <tr>
        <td width="8%" bgcolor="#999999"><div align="center">Date</div></td>
        <td width="6%" bgcolor="#999999"><div align="center">#Entry</div></td>
        <td width="7%" bgcolor="#999999"><div align="center">Loc</div></td>
        <td width="13%" bgcolor="#999999">Kind</td>
        <td width="17%" bgcolor="#999999"><div align="center">From</div></td>
        <td width="26%" bgcolor="#999999"><div align="center">To</div></td>
        <td width="9%" bgcolor="#999999"><div align="center">Carrier</div></td>
        <td width="8%" bgcolor="#999999">Weigth</td>
        <td width="8%" bgcolor="#999999"><div align="center">Tracking</div></td>
        <td width="6%" bgcolor="#999999">COD</td>
        <td width="6%" bgcolor="#999999"><div align="center">Total</div></td>
      </tr>
      <?	  

	$consulta  = "select date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), entrada, tipo_entradas.nombre, fromm, recepcion.nombre, fleteras.nombre, traking, peso, costo, extra, ubicacion.nombre, recepcion.tipo, no_paquetes_resto, no_paquetes,cod from recepcion inner join fleteras on recepcion.fletera=fleteras.id inner join tipo_entradas on recepcion.tipo=tipo_entradas.id inner join ubicacion on ubicacion.id=recepcion.ubicacion where recepcion.id_salida=$id  order by entrada";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		
		$length = strlen($res[6]);
		$length = $length-4;
		$track = substr($res[6] , $length ,4);
		$total=$res[8]+$res[9]+$res[14];
		?>
      <tr>
        <td><div align="center"><? echo"$res[0]";?></div></td>
        <td><div align="center"><? echo"$res[1]";?></div></td>
        <td><div align="center"><? echo"$res[10]";?></div></td>
        <td><div align="center"><? if($res[11]=="7"){echo"Pallet -$res[12]/$res[13]";}else echo"$res[2]";?></div></td>
        <td><div align="center"><? echo"$res[3]";?></div></td>
        <td><div align="center"><? echo"$res[4]";?> </div></td>
        <td><div align="center"><? echo"$res[5]";?></div></td>
        <td><div align="center"><? echo"$res[7]";?>Lbs</div></td>
        <td><div align="center"><? echo"$track";?></div></td>
        <td><div align="center">$<? echo"$res[14]";?></div>          </td>
        <td><div align="center">$<? echo  number_format($total,2);?></div></td>
      </tr>
      <?
		
			   $count=$count+1;
	}
	$count--;
?>
    </table></td>
  </tr>
  <? }
   if($cuantos_servicios>0){?>
  <tr>
    <td colspan="3" scope="row"><p>Services</p>
      <table width="666" align="left">
      <tr>
        <td width="16%" bgcolor="#999999"><div align="center">Qty</div></td>
        <td width="52%" bgcolor="#999999"><div align="center">Service</div></td>
        <td width="18%" bgcolor="#999999"><div align="center">Amount</div></td>
        <td width="14%" bgcolor="#999999"><div align="center">Subtotal</div></td>
      </tr>
      <?	  

	$consulta  = "select cantidad, nombre, precio, cantidad*precio from detalle_servicios inner join servicios on detalle_servicios.id_servicio=servicios.id  where id_salida=$id  ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		
		
		?>
      <tr>
        <td><div align="center"><? echo"$res[0]";?></div></td>
        <td><div align="center"><? echo"$res[1]";?></div></td>
        <td><div align="center"><? echo number_format($res[2],2);?></div></td>
        <td><div align="center"><? echo number_format($res[3],2);?> </div></td>
      </tr>
      <?
		
			   $count=$count+1;
	}
	$count--;
?>
    </table>
    <p></p></td>
  </tr>
  <? }

  ?>
  <tr>
    <td colspan="3" scope="row"><table width="661" align="left">
      <tr>
        <td width="10%"><? echo"$comentarios";?></td>
      </tr>
    </table>
    <script>
window.print();
      </script></td>
  </tr>
</table>
<p></p>
<p>&nbsp;</p>
</body>
</html>
