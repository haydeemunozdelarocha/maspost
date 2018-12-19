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
	$consulta  = "SELECT ventas.pmb, date_format(fecha, '%m/%d/%Y %h:%i %p'), ventas.usuario, ventas.comentario,  subtotal,tax, total, efectivo,cambio,tipo from ventas where id=$id ";
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
		$subtotal=$res[4];
		$tax=$res[5];
		$total=$res[6];
		$efectivo=$res[7];
		$cambio=$res[8];
		$tipo=$res[9];
		if($tipo=="1")
			$credito="Cargo a cuenta";
		else if($tipo=="2")
			$credito="Efectivo";
		else if($tipo=="3")
			$credito="TC";
		else if($tipo=="4")
			$credito="Cheque";
		else if($tipo=="5")
			$credito="Transferencia";
		
	}
	/*if($nombre=="")
	{
	$consulta  = "SELECT nombre, app, apm from c_recibir where pmb=$suite and tipo=1 and activo=1  ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";
		
	}
	}*/
	
	$consulta  = "SELECT nombre from usuarios where id=$idEmp ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$empleado=$res[0];
		
		
	}
	
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
          <td width="23%" bgcolor="#CCCCCC"><div align="right"><strong>SUBTOTAL:</strong></div></td>
          <td width="10%" bgcolor="#CCCCCC">$<? echo number_format($subtotal,2);?></td>
          </tr>
        <tr>
          <td bgcolor="#CCCCCC"><div align="right"><strong>DATE:</strong></div></td>
          <td bgcolor="#CCCCCC"><? echo"$fecha";?></td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>TAX:</strong></div></td>
          <td bgcolor="#CCCCCC">$<? echo number_format($tax,2);?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC"><div align="right"><strong>TIPO:</strong></div></td>
          <td bgcolor="#CCCCCC"><? echo"$credito";?></td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>TOTAL:</strong></div></td>
          <td bgcolor="#CCCCCC">$<? echo  number_format($total,2);?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>CACH TEND. </strong>:</div></td>
          <td bgcolor="#CCCCCC">$<? echo  number_format($efectivo,2);?></td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"><strong>CAHNGE DUE </strong>:</div></td>
          <td bgcolor="#CCCCCC">$<? echo  number_format($cambio,2);?></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" scope="row"><table width="707" border="0">

      <tr>
        <td width="892"><hr /></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="3" scope="row"><p>&nbsp;</p>
      <table width="666" align="left">
      <tr>
        <td width="16%" bgcolor="#999999"><div align="center">Qty</div></td>
        <td width="52%" bgcolor="#999999"><div align="center">Product</div></td>
        <td width="18%" bgcolor="#999999"><div align="center">Amount</div></td>
        <td width="14%" bgcolor="#999999"><div align="center">TAX</div></td>
        <td width="14%" bgcolor="#999999"><div align="center">Subtotal</div></td>
      </tr>
      <?	  

	$consulta  = "select ventas_detalle.cantidad, nombre, ventas_detalle.precio, tax, ventas_detalle.cantidad*(ventas_detalle.precio+tax) from ventas_detalle inner join productos on ventas_detalle.id_producto=productos.id  where id_venta=$id  ";
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
        <td><div align="center"><? echo number_format($res[3],2);?></div></td>
        <td><div align="center"><? echo number_format($res[4],2);?> </div></td>
      </tr>
      <?
		
			   $count=$count+1;
	}
	$count--;
?>
    </table>
    <p></p></td>
  </tr>
 
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
