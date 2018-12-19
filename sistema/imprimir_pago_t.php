<?
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
	$consulta  = "SELECT date_format(facturas_renovacion.fecha, '%m/%d/%Y'), pagos.monto, facturas_renovacion.pmb, facturas_renovacion.name,facturas_renovacion.fecha,facturas_renovacion.void, facturas_renovacion.credito from facturas_renovacion left join pagos on pagos.factura_id = facturas_renovacion.id   where facturas_renovacion.id=$id ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$fecha=$res[0];
		$suite=$res[2];
		$total=$res[1];
		$nombre=$res[3];
		$fecha2=$res[4];
		$tipo=$res[6];
    $void =$res[5];
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
	$consulta  = "SELECT date_format(vigencia, '%m/%d/%Y') , c_recibir.nombre, c_recibir.app, c_recibir.apm, clientes.credito, planes.nombre, clientes.comentarios, planes.costo_mensual, cajas_incluidos FROM `clientes` inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and c_recibir.activo=1 and clientes.pmb=$suite";
//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
if(@mysql_num_rows($resultado)>=1)
{
	$res2=mysql_fetch_row($resultado);
	//$costo_almacen=$res2[1];

	$vigencia=$res2[0];


	$plan=$res2[5];
	$costo_mensual=$res2[7];
	$cajas_incluidos=$res2[8];

}


?>
<body bgcolor="#ffffff" width="100%" height="100%">
<div id="void" style="position:absolute;height:100%;width:100%;display:none;justify-content:center;align-items: center; opacity:.6;">
<h1 style="font-size:100px;color:red;">VOID</h1>
</div>
<?
    if($void ==1){
      echo"<script>document.getElementById('void').style.display ='flex';</script>";
    }
if($id!=""){
$fecha1=explode(" ",$fecha2);
$suma=0;
$cambiarEspañol  = "SET lc_time_names = 'es_MX';";

  $resultado = mysql_query($cambiarEspañol) or die("La consulta fall&oacute;P1: " . mysql_error());
$consulta  = "SELECT date_format(facturas_renovacion.fecha, '%m/%d/%Y'), pagos.monto, facturas_renovacion.pmb, pagos.tipo, pagos.mes, pagos.anio, date_format(clientes.vigencia, '%d/%M/%Y'), pagos.id  from pagos join facturas_renovacion on pagos.factura_id = facturas_renovacion.id inner join clientes on clientes.pmb=facturas_renovacion.pmb where facturas_renovacion.id=$id and facturas_renovacion.pmb=$suite and date(facturas_renovacion.fecha)='$fecha1[0]'";

	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	$array=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio", "Julio","Agosto","Septiembre", "Octubre", "Noviembre", "Diciembre");
  echo '<table width="859" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="31%" ><div align="center"><img src="images/maspost-sm.png" width="139" height="78" /></div></td>
    <td width="69%">2220 Bassett Ave. <br />
      El Paso, TX 79901<br />
      Phone:(915) 351-8160 </td>
  </tr>
  <tr>
    <td colspan="2" scope="row"><div align="left">
      <table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr>
          <td width="66%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="16%" bgcolor="#CCCCCC">DATE:</td>
          <td width="24%"  bgcolor="#CCCCCC"><div align="center">RECEIPT/<br />
            INVOICE</div></td>
        </tr>
        <tr>
          <td>'.$suite.' '.$nombre.'</td>
          <td>'.$fecha.'</td>
           <td>No. '.$id.'</td>
          </tr>
        <tr>            <tr>
              <td width="58%"><div align="right">PMB:</div></td>
              <td width="42%">'.$suite.'</td>
            </tr>
            <tr>
              <td><div align="right">Plan: </div></td>
              <td>'.$plan.'</td>
            </tr>
      <!--
            <tr>
              <td><div align="right">Vigencia:</div></td>
              <td>'.$vigencia.'</td>
            </tr>-->
            <tr>
              <td><div align="right">Numero de piezas incluidas: </div></td>
              <td>'.$cajas_incluidos.'</td>
            </tr>
			<tr>
              <td><div align="right">Tipo Pago: </div></td>
              <td>'.$credito.'</td>
            </tr>
          <td><table width="421" align="left">

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" scope="row"><hr></td>
  </tr>
</table>
<br />
<table width="860" align="left">';
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		$fecha=$res[0];
		if($res[3]=="2")
			$concepto="Contrato/Renovación Anual de PMB $res[5] <br>DUE DATE $res[6]";
		else if($res[3]=="1")
			$concepto="Renta espacio bodega de ".$array[$res[4]]."/$res[5]";
		else if($res[3]=="3")
			$concepto="Secundarios $res[5] hasta $res[6]";
		else if($res[3]=="4")
			$concepto="Renta Espacio de Oficina personal ".$array[$res[4]]."/$res[5]";
		else if($res[3]=="5")
			$concepto="Contrato/Renovación semestral de PMB $res[5] <br>DUE DATE $res[6]";
		else if($res[3]=="6")
			$concepto="Contrato/Renovación parcial de PMB $res[5] <br>DUE DATE $res[6]";
		 else if($res[3]=="9")
			$concepto="VOID";

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
    <td bgcolor="#CCCCCC"><div align="center">$<?
    if($void == 1){
        $suma = 0;
      } echo number_format($suma,2);?></div></td>
  </tr>
 <tr>
   <td colspan="2"><hr></td>
  </tr>
</table>
<p>&nbsp;</p>
 <?
 }
 ?>

  <script>
window.print();
    </script>


<br>
<table width="856" align="left">
  <tr>
    <td colspan="2" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td width="22%">&nbsp;</td>
    <td width="78%">&nbsp;</td>
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
