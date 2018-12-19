<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Maspost & Warehouse</title>
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
<!--
.style11 {color: #FFFFFF}
.style4 {	color: #000099;
	font-weight: bold;
}
.style12 {color: #000000}
@media print {
  a[href]:after {
    content: none !important;
  }
  }
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

	function cerrarV(){
		$.fn.colorbox.close();
	}

	$(function() {
		$( "#fecha" ).datepicker({ dateFormat: 'mm/dd/yy' });
		$( "#fecha_hasta" ).datepicker({ dateFormat: 'mm/dd/yy' });


	});

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


$pmb= $_GET["pmb"];
$id_mes= $_GET["id_mes"];
$id_year= $_GET["id_year"];


?>

  <body><!-- /. main-header -->
  <!-- /. barra-menu -->
  <section >
      <div >
        <div >
          <div align="center">
            <form name="form1" method="post" action="">

          <table width="1031" align="center" cellspacing="2" >
            <thead>
              <tr class="">
                <th scope="row">&nbsp;</th>
              </tr>
              <tr class="">
                <td width="1150" bgcolor="#313630" scope="row">&nbsp;</td>
              </tr>
            </thead>
			<?
			$query = "select credito as saldo2 from clientes where pmb=$pmb";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){

		 $saldo_total=$res_marca['saldo2'];
	}
	$query = "SELECT format(saldo,2) as saldo,fecha FROM `pagos` where pmb=$pmb and month(fecha)=$id_mes and year(fecha)=$id_year union SELECT nuevo_saldo, fecha FROM `salidas` where pmb=$pmb and month(fecha)=$id_mes and year(fecha)=$id_year union SELECT saldo,fecha FROM `abonos` where pmb=$pmb and month(fecha)=$id_mes and year(fecha)=$id_year order by fecha desc limit 0,1 ";
	//echo"$query ";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){

		 $saldo_del_mes=$res_marca['saldo'];
		  $saldo_del_mes=number_format(round($saldo_del_mes,2),2);

	}
	$id_mes_anterior=$id_mes-1;
	$id_year_anterior=$id_year;
	if($id_mes_anterior==0)
	{
		$id_mes_anterior=12;
		$id_year_anterior=$id_year_anterior-1;
	}
	$query = "SELECT saldo,fecha FROM `pagos` where pmb=$pmb and month(fecha)=$id_mes_anterior and year(fecha)=$id_year_anterior union SELECT nuevo_saldo, fecha FROM `salidas` where pmb=$pmb and month(fecha)=$id_mes_anterior and year(fecha)=$id_year_anterior union SELECT saldo,fecha FROM `abonos` where pmb=$pmb and month(fecha)=$id_mes_anterior and year(fecha)=$id_year_anterior order by fecha desc limit 0,1 ";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){

		 $saldo_del_mes_anterior=$res_marca['saldo'];

		 $saldo_del_mes_anterior=number_format(round($saldo_del_mes_anterior,2),2);
	}
	$consulta3  = "SELECT format(sum(recepcion.cod),2) as totcod FROM recepcion inner join salidas on recepcion.id_salida=salidas.id where salidas.pmb=$pmb and MONTH(salidas.fecha)= $id_mes and YEAR(salidas.fecha)=$id_year and salidas.credito=1";
	$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
	if(@mysql_num_rows($resultado3)>=1)
	{
		$res3=mysql_fetch_row($resultado3);
		$total_cod=$res3[0];
	}
	$query = "select format(sum(total),2) as saldomes, format(sum(total_s),2) as serviciost, format(sum(total_p),2) as salidast, format(sum(descuento),2) as descut from salidas where pmb=$pmb and month(fecha)=$id_mes and year(fecha)=$id_year AND credito='1'";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){

		 $saldo_mes=$res_marca['saldomes'];
		 $saldo_servicios=$res_marca['serviciost'];
		 $saldo_salidas=$res_marca['salidast']-$total_cod;
		 $saldo_descuento=$res_marca['descut'];
		 $saldo_cod=$total_cod;//$saldo_mes-$saldo_servicios-$saldo_salidas;
		 $saldo_cod=number_format(round($saldo_cod,2),2);
	}

	$consulta3  = "SELECT format(sum(monto),2) FROM pagos where pmb=$pmb and MONTH(fecha)= $id_mes and YEAR(fecha)=$id_year and credito=1";
	$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
	if(@mysql_num_rows($resultado3)>=1)
	{
		$res3=mysql_fetch_row($resultado3);
		$saldo_mes=$saldo_mes+$res3[0];
	}
	$query = "select format(sum(monto),2) as saldomes from pagos where pmb=$pmb and month(fecha)=$id_mes and year(fecha)=$id_year AND credito='1'";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){

		 $saldo_renovaciones=$res_marca['saldomes'];

	}
	$query = "select format(sum(monto),2) as saldomes, format(sum(descuento),2) as descuentos from abonos where pmb=$pmb and month(fecha)=$id_mes  and year(fecha)=$id_year";
	$abonos_mes=0;
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){

		 $abonos_mes=$res_marca['saldomes'];
		 $descuentos_mes=$res_marca['descuentos'];
	}
	if($abonos_mes=="")
		$abonos_mes=0;
	$consulta  = "SELECT date_format(vigencia, '%m/%d/%Y') , c_recibir.nombre, c_recibir.app, c_recibir.apm, clientes.razon_social, clientes.razon_social2 FROM `clientes` inner join c_recibir on clientes.pmb=c_recibir.pmb  where c_recibir.tipo=1 and c_recibir.activo=1 and clientes.pmb=$pmb";
//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
if(@mysql_num_rows($resultado)>=1)
{
	$res2=mysql_fetch_row($resultado);
	//$costo_almacen=$res2[1];
	$titular="$res2[1] $res2[2] $res2[3]";
	$empresa1=$res2[4];
	$empresa2=$res2[5];


}
$mes_letra=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			?>
            <tbody>
              <tr class="">
                <td bgcolor="#FFFFFF"  ><table width="972" border="0" cellpadding="2" cellspacing="3">
                  <tr>
                    <td width="235"><div align="center"><? echo"$mes_letra[$id_mes]";?></div></td>
                    <td colspan="2"><div align="left"><? echo"$pmb $titular $empresa1 $empresa2";?></div></td>
                    </tr>
                  <tr>
                    <td><div align="right">Balance Previo  </div></td>
                    <td width="156"><div align="right">$<? echo"$saldo_del_mes_anterior";?></div></td>
                    <td width="557" rowspan="8" valign="top"><div align="right"><img src="images/header_email.jpg" width="245" height="115"></div></td>
                  </tr>
                  <tr>
                    <td><div align="right">Entradas de Bodega   </div></td>
                    <td><div align="right">$<? echo"$saldo_salidas";?></div></td>
                    </tr>
				  <tr>
                    <td><div align="right">Descuentos</div></td>
                    <td><div align="right">$<? echo"$saldo_descuento";?></div></td>
                    </tr>
				  <tr>
                    <td><div align="right">COD</div></td>
                    <td><div align="right">$<? echo"$saldo_cod";?></div></td>
                    </tr>
                  <tr>
                    <td><div align="right">Servicios</div></td>
                    <td><div align="right">$<? echo"$saldo_servicios";?></div></td>
                    </tr>
				  <tr>
                    <td><div align="right">Renovaciones</div></td>
                    <td><div align="right">$<? echo"$saldo_renovaciones";?></div></td>
                    </tr>
                  <tr>
                    <td><div align="right">Pagos</div></td>
                    <td><div align="right">$<? echo number_format(round($abonos_mes,2),2); if($descuentos_mes>0) echo"($ ".number_format(round($descuentos_mes,2),2).")";?></div></td>
                    </tr>
                  <tr>
                    <td><div align="right"><strong>Balance Nuevo </strong>:</div></td>
                    <td><div align="right">$<? echo"$saldo_del_mes";?></div></td>
                    </tr>
                </table>                </td>
              </tr>
              <tr class="">
                <td bgcolor="#CCCCCC"  ><table width="1056" border="1" class="tablesorter" id="myTable">
                  <thead>
                    <tr>
                      <th colspan="2" class="h5">Salidas</th>
                      <th class="h5">&nbsp;</th>
                      <th class="style11">&nbsp;</th>
                      <th class="h5">&nbsp;</th>
                      <th class="h5">&nbsp;</th>
                      <th class="h5">&nbsp;</th>
                      <th class="h5">&nbsp;</th>
                      <th>&nbsp;</th>
                      <th class="style11">&nbsp;</th>
                      <th class="style11">&nbsp;</th>
                      <th class="style11">&nbsp;</th>
                      <th class="style11">&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                    <tr>
                      <th width="4%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Salida                        </div></th>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Fecha                        </div></th>
                      <th width="3%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        Tipo</div></th>
					  <th width="6%" bgcolor="#313630" class="style11"><div align="center">PMB</div></th>
                      <th width="22%" bgcolor="#313630" class="h5"><div align="center" class="style11"> De                        </div></th>
                      <th width="15%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Recibe</div>
                      </div></th>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Fletera</div>
                      </div></th>
                      <th width="10%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          No. Rastreo </div>
                      </div></th>
                      <th width="4%" bgcolor="#313630"><div align="center"><span class="style11">Peso</span></div></th>
                      <th width="4%" bgcolor="#313630" class="style11"> <div align="center">Paq </div></th>
                      <th width="4%" bgcolor="#313630" class="style11"><div align="center">Serv</div></th>
                      <th width="4%" bgcolor="#313630" class="style11"><div align="center">Desc</div></th>
                      <th width="3%" bgcolor="#313630" class="style11"><div align="center">COD</div></th>
                      <th width="7%" bgcolor="#313630"><div align="center"><span class="style11">Total  </span></div></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?



	$entrada_anterior=1;
	$consulta="select recepcion.nombre, recepcion.fromm, date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), tipo_entradas.nombre, fleteras.nombre, recepcion.peso, recepcion.traking, recepcion.pmb, format(recepcion.costo,2) as costo, usuarios.nombre, recepcion.id, TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) as meses, TIMESTAMPDIFF(DAY,DATE_ADD(fecha_recepcion,INTERVAL TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) MONTH), now()) as dias, recepcion.tipo, format(recepcion.cod,2) as cod, planes.tabla_pallets, id_salida, format(extra,2) as extra, date_format(recepcion.fecha_entrega, '%m/%d/%Y'), entrego, recepcion.id_salida, format(salidas.total,2) as total, format(salidas.descuento,2) as descu, format(salidas.total_p,2) as paq, format(salidas.total_s,2) as serv from recepcion inner join tipo_entradas on recepcion.tipo=tipo_entradas.id inner join fleteras on fleteras.id=recepcion.fletera  inner join usuarios on usuarios.id=recepcion.id_empleado_recibe inner join clientes on clientes.pmb=recepcion.pmb inner join planes on clientes.id_plan=planes.id inner join salidas on recepcion.id_salida=salidas.id where month(fecha_entrega)=$id_mes and year(fecha_entrega)=$id_year AND salidas.credito='1' and recepcion.pmb=$pmb  order by recepcion.id_salida";
//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	$conta=0;
	$color="CCCCCC";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$extra=0;
		$texto_extra="";
		$res=mysql_fetch_row($resultado);
		$length = strlen($res[6]);
		$length = $length-4;
		$track = substr($res[6] , $length ,4);
		$track2 = substr($res[6] , 0 ,4);
		$peso=$res[5];
		$dias=$res[12];
		$meses=$res[11];
		$tipo=$res[13];
		$cod=$res[14];
		$costo=$res[8];
		$extra=$res[17];
		$fecha_entrega=$res[18];
		$entrego=$res[19];
		$id_salida=$res[20];
		$tabla_pallets=$res[15];

				$salida=$res[16];
				$tot=$res[21];
				$entrega=$fecha_entrega;
		 if($res[16]!=$entrada_anterior && ""!=$entrada_anterior)
			{
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";

			}else
			{
				$salida="";
				$tot="0.00";
				$entrega="";
			}
		?>
                    <tr bgcolor="#<? echo"$color";?>">
                      <td><div align="center"><a href="imprimir_entrega2.php?id=<? echo $salida;?>" target="_blank"><? echo"$salida";?></a></div></td>
                      <td><div align="center"><? echo"$entrega";?></div></td>
                      <td><div align="center"><? echo"$res[3]";?></div></td>
					  <td><div align="center"><? echo"$res[7]";?></div></td>
                      <td><div align="center"><? echo"$res[1]";?></div></td>
                      <td><div align="center"><? echo"$res[0]";?></div></td>
                      <td><div align="center">
                          <? echo"$res[4]";?></div></td>
                      <td><div align="center"><? echo"$track2 ..$track";?></div></td>
                      <td><div align="center"><? echo"$res[5]";?></div></td>
                      <td><div align="center"><? echo"$res[23]";?></div></td>
                      <td><div align="center"><? echo"$res[24]";?></div></td>
                      <td><div align="center"><? echo"$res[22]";?></div></td>
                      <td><div align="right">$<? echo"$cod";?></div></td>
                      <td><div align="right">$<? echo"$tot";?></div></td>
                    </tr>

                    <?
					$total=$total+$costo+$extra+$cod;

			   $count=$count+1;
			   $conta++;

			$entrada_anterior=$res[16];
	}



?>
				  </tbody>
                </table>
                <p>&nbsp;</p>
                <table width="1056" border="1" class="tablesorter" id="myTable">
                  <thead>
                    <tr>
                      <th class="h5">Servicios</th>
                      <th class="h5">&nbsp;</th>
                      <th class="h5">&nbsp;</th>
                      <th class="style11">&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                    <tr>
                      <th width="6%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Salida </div></th>
                      <th width="10%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Fecha </div></th>
                      <th width="6%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Tipo Servicio </div></th>
                      <th width="5%" bgcolor="#313630" class="style11"><div align="center">PMB</div></th>
                      <th width="7%" bgcolor="#313630"><div align="center"><span class="style11">Total </span></div></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?



	$salida_anterior=1;
	$consulta="select entrego,  servicios.nombre,  salidas.pmb, format(detalle_servicios.precio,2) as costo, detalle_servicios.cantidad,    id_salida,  date_format(salidas.fecha, '%m/%d/%Y') from salidas inner join detalle_servicios on salidas.id=detalle_servicios.id_salida inner join servicios on detalle_servicios.id_servicio=servicios.id where month(salidas.fecha)=$id_mes and year(salidas.fecha)=$id_year AND salidas.credito='1' and salidas.pmb=$pmb  order by salidas.id";
//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	$conta=0;
	$color="CCCCCC";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$extra=0;
		$texto_extra="";
		$res=mysql_fetch_row($resultado);


		$tipo=$res[1];

		$costo=$res[3];
		$cantidad=$res[4];
		$fecha=$res[6];
		$entrego=$res[0];
		$id_salida=$res[5];

				$tot=$cantidad*$costo;


		?>
                    <tr bgcolor="#<? echo"$color";?>">
                      <td><div align="center"><? echo"$id_salida";?></div></td>
                      <td><div align="center"><? echo"$fecha";?></div></td>
                      <td><div align="center"><? echo"$tipo";?></div></td>
                      <td><div align="center"><? echo"$pmb";?></div></td>
                      <td><div align="right">$<? echo number_format(round($tot,2),2);?></div></td>
                    </tr>
                    <?
					 if($res[5]!=$salida_anterior )
			{
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";

			}else
			{
				$salida="";
				$tot="";
				$entrega="";
			}
					$total_s=$total_s;

			   $count=$count+1;
			   $conta++;

			$salida_anterior=$id_salida;
	}



?>
                  </tbody>
                </table>
                <table width="637" border="1" class="tablesorter" id="myTable">
                  <thead>
                    <tr>
                      <th class="h5">Renovaciones</th>
                      <th class="h5">&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                    <tr>
                      <th width="6%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Fecha </div></th>
                      <th width="10%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Concepto </div></th>
                      <th width="7%" bgcolor="#313630"><div align="center"><span class="style11">Total </span></div></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?



	$consulta  = "select  tipo, monto, id,mes, anio, date_format(pagos.fecha, '%m/%d/%Y'),credito from pagos where month(fecha)=$id_mes and year(fecha)=$id_year and  pmb=$pmb and credito=1 order by pagos.fecha desc";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	$tipos=array("","Mensual", "Anual", "Anual Secundario");
	$tipos=array("","Renta Espacio Bodega", "Renovación Anual", "Secundario Anualidad", "Renta Espacio Oficina Personal", "Renovación Semestral", " Renovación Parcial","","","VOID");
	$meses=array("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$color="FFFFFF";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);

		?>
                    <tr bgcolor="#<? echo"$color";?>">
                      <td><div align="center"><? echo $res[5];?></div></td>
                      <td><div align="center"><? echo $tipos[$res[0]];?> <? echo $meses[$res[3]];?> <? echo $res[4];?></div></td>
                      <td><div align="right">$<? echo number_format(round($res[1],2),2);?></div></td>
                    </tr>
                    <?

			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";



			   $count=$count+1;


	}



?>
                  </tbody>
                </table>
                <p>&nbsp;</p>
                <table width="34%" border="1" cellpadding="0">
                  <tr>
                    <td colspan="4"  scope="row"><span class="style12">Pagos </span></td>
                  </tr>
                  <tr>
                    <td width="40%" bgcolor="#313630" class="style11"  scope="row"><div align="center"  class="sm">Fecha</div></td>
                    <td colspan="2" bgcolor="#313630" class="style11"  scope="row"><div align="center" class="sm">Monto</div></td>
                  </tr>
                  <?

	$query = "select date_format(fecha, '%m/%d/%Y') as fecha1,monto, descuento from abonos where pmb=$pmb and  month(fecha)=$id_mes  and year(fecha)=$id_year order by fecha desc";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	$color="CCCCCC";
	$fecha1="";
	$monto="";
	while($res_pago = mysql_fetch_assoc($result)){
		$fecha1=$res_pago["fecha1"];
		$monto=$res_pago["monto"];
		$descuento=$res_pago["descuento"];
		?>
                  <tr bgcolor="#<?  echo"$color";?> ">
                    <td  class="sm"><div align="center"><? echo"$fecha1";?></div></td>
                    <td width="33%"  class="sm"><div align="center" class="style4">
                      <div align="right">$
                        <?  echo number_format(round($monto,2),2); ?>
                        <? if($descuento>0) echo"($ $descuento)"; ?>
                        </div>
                    </div></td>
                    <td width="27%"  class="sm">&nbsp;</td>
                  </tr>
                  <?
			 if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
	}




?>
                </table>
                <p>&nbsp;</p></td>
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
