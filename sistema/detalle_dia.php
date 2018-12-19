<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Movimientos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/style-admin.css">
        <script src="assets/js/modernizr-2.6.2.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="colorbox.css" />
        <style type="text/css">
		@media print {
  a[href]:after {
    content: none !important;
  }
}
<!--
.style11 {color: #FFFFFF}
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
-->
        </style>
<script type="text/javascript">
	$(document).ready(function(){
		$(".iframe1").colorbox({iframe:true,width:"560", height:"500",transition:"fade", scrolling:true, opacity:0.7});
		$(".iframe2").colorbox({iframe:true,width:"600", height:"510",transition:"fade", scrolling:false, opacity:0.7});
		$(".iframe3").colorbox({iframe:true,width:"900", height:"630",transition:"fade", scrolling:true, opacity:0.7});
		$("#click").click(function(){
		$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
$(function() {
		$( "#fecha" ).datepicker({ dateFormat: 'mm/dd/yy' });
		$( "#fecha_hasta" ).datepicker({ dateFormat: 'mm/dd/yy' });


	});
	function cerrarV(){
		$.fn.colorbox.close();
	}
function abrir()
{
	if(document.form1.id_usuario.value>0){
$.colorbox({iframe2:true,href:"abonar.php?id="+document.form1.pmb.value,width:"675", height:"400",transition:"fade", scrolling:true, opacity:0.7});
	}
}
</script>
<script>
function buscar()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
   }
  }
xmlhttp.open("GET","buscarpmb.php?id="+document.form1.pmb.value,true);
xmlhttp.send();
}
function validar(){
	if(document.form1.pmb.value=="")
	{
		alert("No escribio PMB");
		document.form1.pmb.focus();
		return false;
	}
	else
	{
		if(document.form1.credito.value=="0")
		{
			alert("Seleccione tipo de pago");
			document.form1.credito.focus();
			return false;
		}
		else
		{

		}
	}
}

function totales(){
	var extra=0;
	var costo=0;
	var contador=0;
	if( document.form1.ch.length==undefined)
	{
		if(document.form1.ch.checked)
		{
			extra=(extra*1)+eval("document.form1.conta"+document.form1.ch.value+".value")*1;
			contador=(contador*1)+1;
		}
	}
	else
	{
		for(i=0 ; i<document.form1.ch.length ; i++)
		{
			if(document.form1.ch[i].checked)
			{
				extra=(extra*1)+document.form1.extra[i].value*1;
				costo=(costo*1)+document.form1.costo[i].value*1;
				contador=(contador*1)+1;
			}
		}
	}


	/*if(extra>0)
		document.getElementById('debe').style.display = "block";
	else
		document.getElementById('debe').style.display = "none";*/
	document.form1.contador.value=contador;
	document.form1.total.value=costo*1+extra*1;
	document.form1.total_f.value=document.form1.total.value*1-document.form1.descuento.value*1+document.form1.total_s.value*1;
	if(document.form1.tc.checked)
	{
		document.form1.total_f.value=document.form1.total_f.value*1.02;
		document.form1.tc_monto.value=document.form1.total_f.value*.02;

	}
}
function maskKeyPress22(objEvent) {
				var strUserAgent = navigator.userAgent.toLowerCase();
				var isIE = strUserAgent.indexOf("msie") > -1;
			    var reValidChars = "34";
				var iKeyCode, strKey;
				if (isIE) {
				    iKeyCode = objEvent.keyCode;
				} else {
				    iKeyCode = objEvent.which;
				}
				strKey = String.fromCharCode(iKeyCode);
				if (iKeyCode==13) {
					//var x=document.getElementByName("ch");
					var y=document.getElementById("tracking");
					var i=0;

					for(i=0 ; i<document.form1.ch.length ; i++)
					{
						if(y.value==document.form1.idP[i].value)
						{
							document.form1.ch[i].checked=true;
							//extra=(extra*1)+document.form1.extra[i].value;
							y.value="";
						}


					}
					totales();
					y.value="";
					y.focus();
					return false;
				}
			}

function insRow(cadena)
{
if(cadena!="0" && cadena!="")
{
elementos= cadena.split("|");
if(parseInt(elementos[0])!=0)
{
var x=document.getElementById('myTable').insertRow(0);
var y=x.insertCell(0);
var z=x.insertCell(1);
var z1=x.insertCell(2);
var z2=x.insertCell(3);
var z3=x.insertCell(4);


var m=document.getElementById('monto')
//var monto=m.innerHTML;
var monto=document.form1.total_s.value;


var cantidad=document.form1.cantidad.value;
var sub=0;
var precio=0;

precio=elementos[1];

sub=cantidad*1*precio*1;

 sub=sub*100;
 sub=Math.round(sub);
 sub=sub/100;

//monto=monto*1+subt*1;
monto=monto*1+sub*1;



 monto=monto*100;
 monto=Math.round(monto);
 monto=monto/100;
//m.innerHTML=monto;

document.form1.total_s.value=monto;

x.id="p"+elementos[0];
y.innerHTML="<center>"+document.form1.cantidad.value+"</center>";
y.className="style5";
z.innerHTML=elementos[2];
z.className="style5";
z1.innerHTML="$"+precio;
z1.className="style5";
z2.innerHTML="$"+sub;
z2.className="style5";
z3.innerHTML="<input name=\"precio[]\"  type=\"hidden\" value=\""+precio+"\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\""+elementos[0]+"\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\""+document.form1.cantidad.value+"\" /><input name=\"monto[]\"  type=\"hidden\" value=\""+sub+"\" /><img src=\"images/close.gif\" alt=\"Eliminar Servicio\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this,"+sub+", 0,"+sub+")\"/>";
document.form1.cantidad.value="1";
totales();
}

}
}
function deleteRow(r,quita, quitatax, quitasub)
{
var i=r.parentNode.parentNode.rowIndex;
document.getElementById('myTable').deleteRow(i);
var m=document.getElementById('monto')
var monto=document.form1.total_s.value;

monto=monto*1-quita*1;
 monto=monto*100;
 monto=Math.floor(monto);
 monto=monto/100;
document.form1.total_s.value=monto;
totales();
}
</script>
</head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
date_default_timezone_set("America/Chihuahua");
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

$fecha = date("m/d/Y");
$fecha_hasta = date("m/d/Y");
$pmb= $_POST["pmb"];

if($_POST["fecha"]!="")
{
	$fecha= $_POST["fecha"];
	$fecha_temp=explode("/", $fecha);
	//$fecha="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
	$fecha2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}else
{
	$fecha_temp=explode("/", $fecha);
	$fecha2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}
if($_POST["fecha_hasta"]!="")
{
	$fecha_hasta= $_POST["fecha_hasta"];
	$fecha_temp=explode("/", $fecha_hasta);
	//$fecha_hasta="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
	$fecha_hasta2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}else
{
	$fecha_temp=explode("/", $fecha_hasta);
	$fecha_hasta2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}
if($_POST["pmb"]!="")
{
	$pmb= $_POST["pmb"];
	$and =" and salidas.pmb=$pmb";
}
else
$and="";
//salidas
$total_salidas=0;
$total_salidas_credito=0;
$total_salidas_efectivo=0;
$total_salidas_tc=0;
$total_salidas_cheque=0;
$total_salidas_trans=0;
$total_salidas_fee=0;
$count=1;

//salidas de servicios
$total_servicios=0;
$consulta  = "select   ROUND(sum(total_s),2) as suma, credito, ROUND(sum(tc),2) from salidas   where date(salidas.fecha)>='$fecha2' and date(salidas.fecha)<='$fecha_hasta2' $and group by salidas.credito  order by salidas.credito";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);
	$total_servicios=$total_servicios+$res2[0];
	if($res2[1]=="1"){
		$total_servicios_credito=$total_servicios_credito+$res2[0];
		//echo"total_servicios_credito=$total_servicios_credito";	
	}else if($res2[1]=="2")
		$total_servicios_efectivo=$total_servicios_efectivo+$res2[0];
	else if($res2[1]=="3")
		$total_servicios_tc=$total_servicios_tc+$res2[0];
	else if($res2[1]=="4")
		$total_servicios_cheque=$total_servicios_cheque+$res2[0];
	else if($res2[1]=="5")
		$total_servicios_trans=$total_servicios_trans+$res2[0];

	$total_salidas_fee=$total_salidas_fee+$res2[2];
$count++;
}
$count=1;
$consulta  = "select ROUND(sum(costo)+ sum(extra),2) as suma, credito, tc, descuento,ROUND(sum(total_p),2) from salidas left outer join  recepcion on salidas.id=recepcion.id_salida  where date(salidas.fecha)>='$fecha2' and date(salidas.fecha)<='$fecha_hasta2' $and group by salidas.credito  order by salidas.credito";

//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);

	$total_salidas=$total_salidas+$res2[0];//-$res2[3]
	  echo"<script>console.log(\"Res 2: $res2[0]\");</script>";
	if($res2[1]=="1")
		$total_salidas_credito=$total_salidas_credito+$res2[0];
	else if($res2[1]=="2")
		$total_salidas_efectivo=$total_salidas_efectivo+$res2[0];
	else if($res2[1]=="3")
		$total_salidas_tc=$total_salidas_tc+$res2[0];
	else if($res2[1]=="4")
		$total_salidas_cheque=$total_salidas_cheque+$res2[0];
	else if($res2[1]=="5")
		$total_salidas_trans=$total_salidas_trans+$res2[0];



$count++;
}
$count=1;
$consulta  = "select   ROUND(sum(cod),2), credito from salidas inner join  recepcion on salidas.id=recepcion.id_salida  where date(salidas.fecha)>='$fecha2' and date(salidas.fecha)<='$fecha_hasta2' $and group by salidas.credito  order by salidas.credito";
//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);
	$total_salidas_cod=$total_salidas_cod+$res2[0];
	if($res2[1]=="1")
		$total_cod_credito=$total_cod_credito+$res2[0];
	else if($res2[1]=="2")
		$total_cod_efectivo=$total_cod_efectivo+$res2[0];
	else if($res2[1]=="3")
		$total_cod_tc=$total_cod_tc+$res2[0];
	else if($res2[1]=="4")
		$total_cod_cheque=$total_cod_cheque+$res2[0];
	else if($res2[1]=="5")
		$total_cod_trans=$total_cod_trans+$res2[0];
$count++;
}
$count=1;
$consulta  = "select   ROUND(sum(descuento),2), credito from salidas   where date(salidas.fecha)>='$fecha2' and date(salidas.fecha)<='$fecha_hasta2' $and group by salidas.credito  ";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
//echo"$consulta";
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);
	$total_salidas_des=$total_salidas_des+$res2[0];
	if($res2[1]=="1")
		$total_cod_credito_des=$total_cod_credito_des+$res2[0];
	else if($res2[1]=="2")
		$total_cod_efectivo_des=$total_cod_efectivo_des+$res2[0];
	else if($res2[1]=="3")
		$total_cod_tc_des=$total_cod_tc_des+$res2[0];
	else if($res2[1]=="4")
		$total_cod_cheque_des=$total_cod_cheque_des+$res2[0];
	else if($res2[1]=="5")
		$total_cod_trans_des=$total_cod_trans_des+$res2[0];
$count++;
}

//abonos
if($_POST["pmb"]!="")
{
	$pmb= $_POST["pmb"];
	$and =" and pmb=$pmb";
}
$count=1;
$total_abonos=0;
$total_abonos_credito=0;
$total_abonos_efectivo=0;
$total_abonos_tc=0;
$total_abonos_cheque=0;
$total_abonos_trans=0;
$consulta  = "select ROUND(sum(monto),2),  tipo, tc_cargo from abonos  where date(fecha)>='$fecha2' and date(fecha)<='$fecha_hasta2' $and group by tipo  order by tipo";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);
	$total_abonos=$total_abonos+$res2[0];


		if($res2[1]=="1")
			$total_abonos_credito=$total_abonos_credito+$res2[0];
		else if($res2[1]=="2")
			$total_abonos_efectivo=$total_abonos_efectivo+$res2[0];
		else if($res2[1]=="3")
			$total_abonos_tc=$total_abonos_tc+$res2[0];
		else if($res2[1]=="4")
			$total_abonos_cheque_1=$total_abonos_cheque+$res2[0];
		else if($res2[1]=="5")
			$total_abonos_trans=$total_abonos_trans+$res2[0];

			$total_abonos_fee=$total_abonos_fee+$res2[2];

$count++;
}
//renovaciones
$count=1;
$total_pagos=0;
$total_pagos_credito=0;
$total_pagos_efectivo=0;
$total_pagos_tc=0;
$total_pagos_cheque=0;
$total_pagos_trans=0;
$consulta  = "select  ROUND(sum(pagos.monto),2), credito, pagos.tipo,tc_cargo from pagos  where date(pagos.fecha)>='$fecha2' and date(pagos.fecha)<='$fecha_hasta2' $and  group by tipo,credito  order by tipo";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);
	$total_pagos=$total_pagos+$res2[0];
	if($res2[2]=="1")//Renta espacio bodega
	{
		//echo"entra";
		if($res2[1]=="1")
			$total_pagos_credito_1=$total_pagos_credito_1+$res2[0];
		else if($res2[1]=="2")
			$total_pagos_efectivo_1=$total_pagos_efectivo_1+$res2[0];
		else if($res2[1]=="3")
			$total_pagos_tc_1=$total_pagos_tc_1+$res2[0];
		else if($res2[1]=="4")
			$total_pagos_cheque_1=$total_pagos_cheque_1+$res2[0];
		else if($res2[1]=="5")
			$total_pagos_trans_1=$total_pagos_trans_1+$res2[0];

			$total_pagos_fee_1=$total_pagos_fee_1+$res2[3];

			//echo" $total_pagos_cheque_1";
	}
	if($res2[2]=="2" || $res2[2]=="3" || $res2[2]=="5"|| $res2[2]=="6")//Renovacion PMB
	{

		if($res2[1]=="1")
			$total_pagos_credito_2=$total_pagos_credito_2+$res2[0];
		else if($res2[1]=="2")
			$total_pagos_efectivo_2=$total_pagos_efectivo_2+$res2[0];
		else if($res2[1]=="3")
			$total_pagos_tc_2=$total_pagos_tc_2+$res2[0];
		else if($res2[1]=="4")
			$total_pagos_cheque_2=$total_pagos_cheque_2+$res2[0];
		else if($res2[1]=="5")
			$total_pagos_trans_2=$total_pagos_trans_2+$res2[0];

			$total_pagos_fee_2=$total_pagos_fee_2+$res2[3];
	}
	/*if($res2[2]=="3")//Renta espacio bodega
	{
		if($res2[1]=="1")
			$total_pagos_credito_3=$total_pagos_credito_3+$res2[0];
		else if($res2[1]=="2")
			$total_pagos_efectiv_3=$total_pagos_efectivo_3+$res2[0];
		else if($res2[1]=="3")
			$total_pagos_tc_3=$total_pagos_tc_3+$res2[0];
		else if($res2[1]=="4")
			$total_pagos_cheque_3=$total_pagos_cheque_3+$res2[0];
		else if($res2[1]=="5")
			$total_pagos_trans_3=$total_pagos_trans_3+$res2[0];
	}*/
	if($res2[2]=="4")
	{
		if($res2[1]=="1")
			$total_pagos_credito_4=$total_pagos_credito_4+$res2[0];
		else if($res2[1]=="2")
			$total_pagos_efectivo_4=$total_pagos_efectivo_4+$res2[0];
		else if($res2[1]=="3")
			$total_pagos_tc_4=$total_pagos_tc_4+$res2[0];
		else if($res2[1]=="4")
			$total_pagos_cheque_4=$total_pagos_cheque_4+$res2[0];
		else if($res2[1]=="5")
			$total_pagos_trans_4=$total_pagos_trans_4+$res2[0];

		$total_pagos_fee_1=$total_pagos_fee_4+$res2[3];
	}
	/*if($res2[2]=="5")//Renta espacio bodega
	{
		if($res2[1]=="1")
			$total_pagos_credito_5=$total_pagos_credito_5+$res2[0];
		else if($res2[1]=="2")
			$total_pagos_efectivo_5=$total_pagos_efectivo_5+$res2[0];
		else if($res2[1]=="3")
			$total_pagos_tc_5=$total_pagos_tc_5+$res2[0];
		else if($res2[1]=="4")
			$total_pagos_cheque_5=$total_pagos_cheque_5+$res2[0];
		else if($res2[1]=="5")
			$total_pagos_trans_5=$total_pagos_trans_5+$res2[0];
	}*/
$count++;
}
///ventas
$count=1;
$consulta  = "select   ROUND(sum(total),2) as suma, tipo from ventas   where date(fecha)>='$fecha2' and date(fecha)<='$fecha_hasta2' $and group by tipo  order by tipo";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
while(@mysql_num_rows($resultado)>=$count)
{
	$res2=mysql_fetch_row($resultado);
	$total_ventas=$total_ventas+$res2[0];
	if($res2[1]=="1"){
		$total_ventas_credito=$res2[0];//$total_servicios_credito+
		//echo"total_ventas_credito=$total_ventas_credito  total_servicios_credito=$total_servicios_credito";
	}else if($res2[1]=="2"){
		$total_ventas_efectivo=$res2[0];//$total_servicios_efectivo+
		//echo"total_ventas_efectivo=$total_ventas_efectivo  total_servicios_efectivo=$total_servicios_efectivo";
	}else if($res2[1]=="3")
		$total_ventas_tc=$res2[0];//$total_servicios_tc+
	else if($res2[1]=="4")
		$total_ventas_cheque=$res2[0];//$total_servicios_cheque+
	else if($res2[1]=="5")
		$total_ventas_trans=$res2[0];//$total_servicios_trans+

	
$count++;
}
?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">


           <? include "menu_f.php"?>
        </nav>
    </header> <!-- /. main-header -->

    <article class="barra-menu">

    </article><!-- /. barra-menu -->


 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form name="form1" method="post" action="">

          <table width="1031" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th width="1150" bgcolor="#313630" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr class="">
                <td bgcolor="#CCCCCC"  >Fecha desde: <span class="style5">
                <input name="fecha" type="text" class="texto_verde" id="fecha" value="<?echo"$fecha";?>" size="20" maxlength="10"  />
                hasta
                <input name="fecha_hasta" type="text" class="texto_verde" id="fecha_hasta" value="<?echo"$fecha_hasta";?>" size="20" maxlength="10"  />
                PMB
                <input name="pmb" type="text" class="texto_verde" id="pmb" value="<?echo"$pmb";?>" size="20" maxlength="10"  />
                </span><span class="style5">
                <input name="Buscar" type="submit" class="barra-menu" id="Buscar"  value="buscar">
</span></td>
              </tr>
              <tr class="">
                <td bgcolor="#CCCCCC"  ><table width="900" border="0">
                  <tr>
                    <td width="163" bgcolor="#313630"><span class="style11"></span></td>
                    <td width="62" bgcolor="#313630"><div align="center"><span class="style11">Credito</span></div></td>
                    <td width="83" bgcolor="#313630"><div align="center"><span class="style11">Efectivo</span></div></td>
                    <td width="66" bgcolor="#313630"><div align="center"><span class="style11">TC</span></div></td>
                    <td width="102" bgcolor="#313630"><div align="center"><span class="style11">Cheque</span></div></td>
                    <td width="101" bgcolor="#313630"><div align="center"><span class="style11">Transferencia</span></div></td>
                    <td width="95" bgcolor="#313630" class="style11"><div align="center">TC Fee </div></td>
                    <td width="95" bgcolor="#313630"><div align="center"><span class="style11">Total</span></div></td>
                    <td width="95" bgcolor="#313630">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><a href="detalle_salidas.php?desde=<?echo"$fecha";?>&hasta=<?echo"$fecha_hasta";?>" target="_blank" class="btn-primary">Warehouse invoices</a></td>
                    <td><div align="right">($<? echo number_format(round($total_salidas_credito,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_salidas_efectivo,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_salidas_tc,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_salidas_cheque,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_salidas_trans,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_salidas_fee,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_salidas+$total_salidas_fee,2),2);?></div></td>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Other Services</td>
                    <td><div align="right">($<? echo number_format(round($total_servicios_credito,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_servicios_efectivo,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_servicios_tc,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_servicios_cheque,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_servicios_trans,2),2);?></div></td>
                    <td><div align="right"></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_servicios,2),2);?></div></td>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
				  <tr>
                    <td>COD / Freight</td>
                    <td><div align="right">($<? echo number_format(round($total_cod_credito,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_cod_efectivo,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_cod_tc,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_cod_cheque,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_cod_trans,2),2);?></div></td>
                    <td><div align="right"></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_salidas_cod,2),2);?></div></td>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
				  <tr>
                    <td bgcolor="#E0E0E0">Discount</td>
                    <td bgcolor="#E0E0E0"><div align="right">($<? echo number_format(round($total_cod_credito_des,2),2);?>)</div></td>
                    <td bgcolor="#E0E0E0"><div align="right">$<? echo number_format(round($total_cod_efectivo_des,2),2);?></div></td>
                    <td bgcolor="#E0E0E0"><div align="right">$<? echo number_format(round($total_cod_tc_des,2),2);?></div></td>
                    <td bgcolor="#E0E0E0"><div align="right">$<? echo number_format(round($total_cod_cheque_des,2),2);?></div></td>
                    <td bgcolor="#E0E0E0"><div align="right">$<? echo number_format(round($total_cod_trans_des,2),2);?></div></td>
                    <td bgcolor="#E0E0E0"><div align="right"></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">($<? echo number_format(round($total_salidas_des,2),2);?>)</div></td>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
				  </tr>
                  <tr>
                    <td colspan="3"><div align="left"></div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><div align="right"><strong>Subtotal</strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_servicios+$total_salidas+$total_salidas_fee+$total_salidas_cod-$total_salidas_des,2),2);

                    echo"<script>console.log(\"TotalServ: $total_servicios\");</script>";
                   echo"<script>console.log(\"TotalSal: $total_salidas\");</script>";
                   echo"<script>console.log(\"TotalSalFee: $total_salidas_fee\");</script>";
                   echo"<script>console.log(\"TotalSalCOD: $total_salidas_cod\");</script>";
                   echo"<script>console.log(\"TotalSalDesc: $total_salidas_des\");</script>";
                   $a = round($total_servicios+$total_salidas+$total_salidas_fee+$total_salidas_cod-$total_salidas_des,2);
                   $b = number_format(round($total_servicios+$total_salidas+$total_salidas_fee+$total_salidas_cod-$total_salidas_des,2),2);
              echo"<script>console.log(\"Before number format: $a\");</script>";
                            echo"<script>console.log(\"After number format: $b\");</script>";

?></strong></div></td>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><a href="detalle_abonos.php?desde=<?echo"$fecha";?>&hasta=<?echo"$fecha_hasta";?>" target="_blank" class="btn-primary">Payments</a></td>
                    <td><div align="right">($<? echo number_format(round($total_abonos_credito,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_abonos_efectivo,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_abonos_tc,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_abonos_cheque_1,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_abonos_trans,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_abonos_fee,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_abonos,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"></div></td>
                  </tr>
                  <tr>
                    <td><a href="detalle_pagos.php?desde=<?echo"$fecha";?>&hasta=<?echo"$fecha_hasta";?>" target="_blank" class="btn-primary">Warehouse space </a></td>
                    <td><div align="right">($<? echo number_format(round($total_pagos_credito_1,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_efectivo_1,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_tc_1,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_cheque_1,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_trans_1,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_fee_1,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_pagos_credito_1+$total_pagos_efectivo_1+$total_pagos_tc_1+$total_pagos_cheque_1+$total_pagos_trans_1,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"></div></td>
                  </tr>
				  <tr>
                    <td><a href="detalle_pagos.php?desde=<?echo"$fecha";?>&hasta=<?echo"$fecha_hasta";?>" target="_blank" class="btn-primary">Rent po box </a></td>
                    <td><div align="right">($<? echo number_format(round($total_pagos_credito_2,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_efectivo_2,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_tc_2,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_cheque_2,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_trans_2,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_fee_2,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_pagos_credito_2+$total_pagos_efectivo_2+$total_pagos_tc_2+$total_pagos_cheque_2+$total_pagos_trans_2,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"></div></td>
				  </tr>
				  <tr>
                    <td><a href="detalle_pagos.php?desde=<?echo"$fecha";?>&hasta=<?echo"$fecha_hasta";?>" target="_blank" class="btn-primary">Office space </a></td>
                    <td><div align="right">($<? echo number_format(round($total_pagos_credito_4,2),2);?>)</div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_efectivo_4,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_tc_4,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_cheque_4,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_trans_4,2),2);?></div></td>
                    <td><div align="right">$<? echo number_format(round($total_pagos_fee_4,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_pagos_credito_4+$total_pagos_efectivo_4+$total_pagos_tc_4+$total_pagos_cheque_4+$total_pagos_trans_4,2),2);?></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"></div></td>
				  </tr>
				  <tr>
				    <td><a href="reporte_ventas.php?desde=<?echo"$fecha";?>&hasta=<?echo"$fecha_hasta";?>" target="_blank" class="btn-primary">Sales</a></td>
				    <td><div align="right">($<? echo number_format(round($total_ventas_credito,2),2);?>)</div></td>
				    <td><div align="right">$<? echo number_format(round($total_ventas_efectivo,2),2);?></div></td>
				    <td><div align="right">$<? echo number_format(round($total_ventas_tc,2),2);?></div></td>
				    <td><div align="right">$<? echo number_format(round($total_ventas_cheque,2),2);?></div></td>
				    <td><div align="right">$<? echo number_format(round($total_ventas_trans,2),2);?></div></td>
				    <td><div align="right"></div></td>
				    <td bgcolor="#FFFFFF"><div align="right">$<? echo number_format(round($total_ventas,2),2);?></div></td>
				    <td bgcolor="#FFFFFF">&nbsp;</td>
				    </tr>
                  <tr>
                    <td bgcolor="#FFFFFF"><strong>Total</strong></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>($<? echo number_format(round($total_servicios_credito+$total_salidas_credito+$total_abonos_credito+$total_pagos_credito_1+$total_pagos_credito_2+$total_pagos_credito_3+$total_pagos_credito_4+$total_pagos_credito_5+$total_cod_credito+$total_ventas_credito,2),2);?></strong>)</div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_salidas_efectivo+$total_abonos_efectivo+$total_pagos_efectivo_1+$total_pagos_efectivo_2+$total_pagos_efectivo_4+$total_servicios_efectivo+$total_cod_efectivo+$total_ventas_efectivo,2),2);?></strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_servicios_tc+$total_salidas_tc+$total_abonos_tc+$total_pagos_tc_1+$total_pagos_tc_2+$total_pagos_tc_3+$total_pagos_tc_4+$total_pagos_tc_5+$total_cod_tc+$total_ventas_tc,2),2);?></strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_servicios_cheque+$total_salidas_cheque+$total_abonos_cheque_1+$total_pagos_cheque_1+$total_pagos_cheque_2+$total_pagos_cheque_3+$total_pagos_cheque_4+$total_pagos_cheque_5+$total_cod_cheque+$total_ventas_cheque,2),2);?></strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_salidas_trans+$total_abonos_trans+$total_pagos_trans_1+$total_pagos_trans_2+$total_pagos_trans_3+$total_pagos_trans_4+$total_pagos_trans_5+$total_cod_trans+$total_ventas_trans,2),2);?></strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_salidas_fee+$total_abonos_fee+$total_pagos_fee_1+$total_pagos_fee_2+$total_pagos_fee_4,2),2);?></strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round($total_servicios+$total_salidas+$total_abonos+$total_pagos_credito_1+$total_pagos_efectivo_1+$total_pagos_tc_1+$total_pagos_cheque_1+$total_pagos_trans_1+$total_pagos_credito_2+$total_pagos_efectivo_2+$total_pagos_tc_2+$total_pagos_cheque_2+$total_pagos_trans_2+$total_pagos_credito_4+$total_pagos_efectivo_4+$total_pagos_tc_4+$total_pagos_cheque_4+$total_pagos_trans_4+$total_salidas_cod+$total_salidas_fee+$total_abonos_fee+$total_pagos_fee_1+$total_pagos_fee_2+$total_pagos_fee_4+$total_ventas-$total_salidas_des,2),2);?></strong></div></td>
                    <td bgcolor="#FFFFFF"><div align="right"><strong>$<? echo number_format(round(($total_ventas+$total_servicios+$total_salidas+$total_abonos+$total_pagos_credito_1+$total_pagos_efectivo_1+$total_pagos_tc_1+$total_pagos_cheque_1+$total_pagos_trans_1+$total_pagos_credito_2+$total_pagos_efectivo_2+$total_pagos_tc_2+$total_pagos_cheque_2+$total_pagos_trans_2+$total_pagos_credito_4+$total_pagos_efectivo_4+$total_pagos_tc_4+$total_pagos_cheque_4+$total_pagos_trans_4+$total_salidas_cod+$total_salidas_fee+$total_abonos_fee+$total_pagos_fee_1+$total_pagos_fee_2+$total_pagos_fee_4-$total_salidas_des)-($total_servicios_credito+$total_salidas_credito+$total_abonos_credito+$total_pagos_credito_1+$total_pagos_credito_2+$total_pagos_credito_3+$total_pagos_credito_4+$total_pagos_credito_5+$total_cod_credito),2),2);?></strong></div></td>
                  </tr>
                </table></td>
              </tr>
              <tr class="">
                <td bgcolor="#CCCCCC"  >&nbsp;</td>
              </tr>
            </tbody>
          </table>
		   </form>
		  </div>
        </div>
      </div>
  </section>

  <?php include "footer.php" ?>

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->


    <!-- Bootsrap javascript file -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- owl carouseljavascript file -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Template main javascript -->
    <script src="assets/js/main.js"></script>
	<script>
	<?
if($pmb!="")
echo" document.form1.pmb.value=$pmb; ";//buscar();
?>
</script>
<script>setTimeout(function() { document.form1.pmb.focus(); }, 10);</script>
  </body>
</html>
