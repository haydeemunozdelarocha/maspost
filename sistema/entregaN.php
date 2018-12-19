<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Salidas</title>
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
		<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="colorbox.css" />

<script type="text/javascript">
	$(document).ready(function(){
		$(".iframe1").colorbox({iframe:true,width:"560", height:"500",transition:"fade", scrolling:true, opacity:0.7});
		$(".iframe2").colorbox({iframe:true,width:"600", height:"510",transition:"fade", scrolling:true, opacity:0.7});
		$(".iframe3").colorbox({iframe:true,width:"900", height:"630",transition:"fade", scrolling:true, opacity:0.7});
		$("#click").click(function(){
		$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
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
			if((document.form1.contador.value=="0" || document.form1.contador.value=="") && document.form1.total_f.value=="0")
			{
				alert("Seleccione algun paquete o Servicio");

				return false;
			}
			else
			{
				return true;
			}
		}
	}
}
function seleccionaTodo()
{
	for(g=0 ; g<document.form1.ch.length ; g++)
	{
		if(document.form1.selectall.checked)
			document.form1.ch[g].checked=true;
		else
			document.form1.ch[g].checked=false;
		totales2(document.form1.ch[g]);
	}
}
function totales2(valor){
	if(valor.checked)
	{
	var renglon=document.getElementById("ren"+valor.value);
	renglon.bgColor="#FFFF66";
	}else
	{
	var renglon=document.getElementById("ren"+valor.value);
	renglon.bgColor="#CCCCCC";
	}
	totales();
}
function totales(){
	var extra=0;
	var costo=0;
	var cod=0;
	var contador=0;
	if(document.form1.cuantos.value!="0")
	{
	if( document.form1.ch.value!="")
	{
		if(document.form1.ch.checked)
		{
			if(document.form1.solocod.checked==false)
			{
			extra=(extra*1)+eval("document.form1.conta"+document.form1.ch.value+".value")*1;
			costo=(costo*1)+eval("document.form1.costo"+document.form1.ch.value+".value")*1;
			}
			cod=(cod*1)+eval("document.form1.cod"+document.form1.ch.value+".value")*1;
			contador=(contador*1)+1;
		}
	}
	else
	{
		for(i=0 ; i<document.form1.ch.length ; i++)
		{
			if(document.form1.ch[i].checked)
			{
				if(eval("document.form1.tip"+document.form1.ch[i].value+".value")==7 && eval("document.form1.pal"+document.form1.ch[i].value+".value")!="" && eval("document.form1.pal"+document.form1.ch[i].value+".value")!="0")
				{
					extra=0;
					costo=0;
					contador=(contador*1)+1;
				}else
				{
				if(document.form1.solocod.checked==false)
				{
				extra=(extra*1)+document.form1.extra[i].value*1;
				costo=(costo*1)+document.form1.costo[i].value*1;
				}
				cod=(cod*1)+document.form1.cod[i].value*1;
				contador=(contador*1)+1;
				}
			}
		}
	}
	}

	/*if(extra>0)
		document.getElementById('debe').style.display = "block";
	else
		document.getElementById('debe').style.display = "none";*/
	document.form1.contador.value=contador;
	var calcu=parseFloat(costo*1+extra*1+cod*1).toFixed(2);
	document.form1.total.value=calcu;
	document.form1.total_f.value=document.form1.total.value*1-document.form1.descuento.value*1+document.form1.total_s.value*1;
	if(document.form1.tc.checked)
	{
		document.form1.total_f.value=document.form1.total_f.value*1.02;
		document.form1.tc_monto.value=document.form1.total_f.value*.02;

	}
	//var calcu=document.form1.total.value;
	//calcu=parseFloat(calcu).toFixed(2);
	//document.form1.total.value=calcu;
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
							var renglon=document.getElementById("ren"+document.form1.ch[i].value);
							renglon.bgColor="#FFFF66";
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

include "coneccion.php";
include "checar_sesion_admin.php";
date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'spanish');
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

$pmb= $_POST["pmb"];
if($pmb=="")
$pmb= $_GET["pmb"];
$salida= $_POST["salida"];
if($salida!="")
{

	// echo"entra 1";
	$pmb= $_POST["pmb"];
	$comentarios= $_POST["comentarios"];
	$comentarios_i= $_POST["comentarios_i"];
	$tipo= $_POST["tipo"];

	$tc_monto= $_POST["tc_monto"];


	//paquetes
	$total= $_POST["total"];//total entradas
	$total_f= $_POST["total_f"]; //total final
	$ch= $_POST["ch"];
	$servicios= $_POST["idproducto"];


	$descuento= $_POST["descuento"];
	$credito= $_POST["credito"];

	$recibe= $_POST["recibe"];//id de qiue recibe
	$autorizado= $_POST["autorizado"];//texto de quien recibe

	if($autorizado=="0")
		$autorizado=$recibe;



	//servicios
	$pin= $_POST["precio"];
	$pin= $_POST["idproducto"];
	$pin= $_POST["cantidad_d"];
	$pin= $_POST["monto"];
	$total_s= $_POST["total_s"]; //total servicios
	$solocod= $_POST["solocod"];
	//guarda la entrega
	$consulta3  = "SELECT  credito from clientes  where pmb = $pmb";
	$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
	if(@mysql_num_rows($resultado3)>=1)
	{
		// echo"entra 2";
		$res3=mysql_fetch_row($resultado3);
		$credito_anterior=$res3[0];
		if($credito=="1")
			$saldonuevo=$credito_anterior+$total_f;
		else
			$saldonuevo=$credito_anterior;
	}
	$consulta  = "insert into salidas (pmb, fecha, id_usuario, entrego, comentario, total_s, total_p, descuento, credito, total,tc, tipo, name, nuevo_saldo) values ('$pmb',now(), $idU, UPPER('$autorizado'), '$comentarios_i', $total_s, '$total', '$descuento', '$credito', '$total_f', $tc_monto, 0,'".$_POST['factura']."',$saldonuevo)";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$id_salida=  mysql_insert_id();

	$consulta  = "update clientes set comentarios='$comentarios'  where pmb=$pmb ";
		$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
	//guarda cada paquete entregado y actualiza el estatus
	if(sizeof($ch)>0)
	foreach($ch as $na)
	{
		// echo"entra 3";
		$ex=$_POST['conta'.$na];
		$costo1=$_POST['costo'.$na];
		$tip=$_POST['tip'.$na];
		$pal=$_POST['pal'.$na];
		$pal_r=$_POST['pal_r'.$na];
		//echo"$ex $na";
		if($solocod=="1")
		{
			$consulta  = "insert into recepcion(pmb,id_cliente_recibe,nombre,tipo,fletera,peso,ubicacion,traking,costo,extra,descripcion_extra,id_empleado_recibe, id_empleado_entrego, fecha_recepcion,fecha_entrega,pagado,foto,no_paquetes,id_remesa,cod,fromm,entrada,id_salida,no_paquetes_resto)  select pmb,id_cliente_recibe,nombre,tipo,fletera,peso,ubicacion,traking,costo,extra,descripcion_extra,id_empleado_recibe, 0, fecha_recepcion,null,pagado,foto,no_paquetes,id_remesa,0,fromm,entrada,0,no_paquetes_resto from recepcion where id=$na";
			//echo"$consulta";
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$id_nueva=  mysql_insert_id();
			$consulta  = "update recepcion set fecha_entrega=now(), id_salida=$id_salida, costo=0, extra=0 where id=$na ";
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update recepcion set fecha_entrega=now(), id_salida=$id_salida, extra=extra+$ex, id_empleado_entrego=$idU  where id=$id_nueva ";
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
		}else
		{
			if($tip=="7" && $pal<$pal_r && $pal!="0" && $pal!="")//si es palet y saca un paquete y aun quedan, hace una copia con el resto
			{
				$consulta  = "insert into recepcion(pmb,id_cliente_recibe,nombre,tipo,fletera,peso,ubicacion,traking,costo,extra,descripcion_extra,id_empleado_recibe, id_empleado_entrego, fecha_recepcion,fecha_entrega,pagado,foto,no_paquetes,id_remesa,cod,fromm,entrada,id_salida,no_paquetes_resto)  select pmb,id_cliente_recibe,nombre,tipo,fletera,peso,ubicacion,traking,costo,extra,descripcion_extra,id_empleado_recibe, id_empleado_entrego, fecha_recepcion,fecha_entrega,pagado,foto,no_paquetes,id_remesa,cod,fromm,entrada,id_salida,no_paquetes_resto from recepcion where id=$na";
				//echo"$consulta";
				$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
				$id_nueva=  mysql_insert_id();
				$consulta  = "update recepcion set no_paquetes_resto=no_paquetes_resto-$pal  where id=$id_nueva ";
				$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
				$consulta  = "update recepcion set fecha_entrega=now(), id_salida=$id_salida , no_paquetes_resto=$pal where id=$na ";
				$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			}else
			{
			if($tip=="7")
			$consulta  = "update recepcion set fecha_entrega=now(), id_salida=$id_salida, extra=extra+$ex, id_empleado_entrego=$idU, costo=$costo1  where id=$na ";
			else
			$consulta  = "update recepcion set fecha_entrega=now(), id_salida=$id_salida, extra=extra+$ex, id_empleado_entrego=$idU  where id=$na ";
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			}
		}



		//echo"$consulta";
	}
	//si fue a credito actualiza el saldo
	if($credito=="1")
	{
		$consulta  = "update clientes set credito=credito+$total_f  where pmb=$pmb ";
		$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());

	}
	//guarda detalle de servicios
	$count=0;
	$idproducto= $_POST["idproducto"];
	$precio= $_POST["precio"];
	$cantidad= $_POST["cantidad_d"];
	if(sizeof($servicios)>0)
	foreach($servicios as $na)
	{


		$consulta  = "insert into detalle_servicios(id_salida, id_servicio, precio, cantidad, pmb) values($id_salida, $na , $precio[$count], $cantidad[$count], $pmb) ";
		$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
		$count++;
		//echo"$consulta";
	}
	echo"<script>alert(\"Paquete guardado\");</script>";
	echo"<script>window.open=window.open(\"imprimir_entrega2.php?id=$id_salida\",\"mywindow\");</script>";

	/*
	$EmailFrom = "noreplay@maspostwarehouseusers.com";

	$Subject = "Notificacion de Paquete - Maspost Warehouse - ";
	$Body = "";
	$Body .= "<html>";
	$Body .= "<head><style type=\"text/css\">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #1419EF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style5 {font-size: 14px; }
-->
</style>";
				$Body .= "<title>maspostwarehouseusers.com</title>";
				$Body .= "</head>";
	$Body .= "
<body>
<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"90\"><img src=\"http://www.maspostwarehouseusers.com/images/header.jpg\" width=\"63\" height=\"55\"></td>
    <td width=\"510\"><span class=\"style1\"></span> </td>
  </tr>
  <tr>
    <td colspan=\"2\"><p>Estimado $nombre</p>
    <p>Hemos recibido un envio con los siguientes datos:</p>
    <table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">

	  <tr>
        <td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Nombre:</div></td>
        <td width=\"78%\">$nombre</td>
      </tr>
      <tr>
        <td bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Mensajeria:</div></td>
        <td>$mensajeria</td>
      </tr>
      <tr>
        <td bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Peso:</div></td>
        <td>$peso libras</td>
      </tr>
      <tr>
        <td bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Numero de guia:</div></td>
        <td>".$_POST['traking']." </td>
      </tr>
	   <tr>
        <td bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Almacenado en:</div></td>
        <td>$nombre_ubicacion </td>
      </tr>";
	 if($cobrar_extra>0)
	 {
	  $Body .= "<tr>
        <td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Cargo extra:</div></td>
        <td width=\"78%\">$cobrar_extra excedido en numero paquetes mensuales permitidos.</td>
      </tr>";
	 }
	 if($sinpmb=="1")
	 {
	  $Body .= "<tr>
        <td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">Cargo extra:</div></td>
        <td width=\"78%\">3 dolares paquete sin numero de PMB en la etiqueta.</td>
      </tr>";
	 }
   $Body .= " </table>
    <p>Para mayores detalles sobre su paquete accesar http://www.maspostwarehouseusers.com en apartado de postales con tu usuario y password.</p>

    <p>Esta es una notificacion automatica por favor no contestar.</p>
    <p>Para dudas o comentarios escribir a info@maspostwarehouseusers.com<br>
      <br>
    </p></td>
  </tr>
</table>";

				$Body .= "</body>";
				$Body .= "</html>";
				if($email!="")
				$success = mail($email, $Subject, $Body, "From: maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");

				$pmb="";
				//$success = mail("mgarciavarela@gmail.com", $Subject, $Body, "From: Melekcorp.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
	*/
	///////if()
	////como insertar los siguientes de remesa y cobrar por el primero y subsecuentes

}

if($pmb!="")
{
$consulta  = "SELECT date_format(vigencia, '%m/%d/%Y') , c_recibir.nombre, c_recibir.app, c_recibir.apm, clientes.credito, planes.nombre, clientes.comentarios, planes.costo_mensual, cajas_incluidos, planes.pallets_incluidos FROM `clientes` inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and c_recibir.activo=1 and clientes.pmb=$pmb";
//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
if(@mysql_num_rows($resultado)>=1)
{
	$res2=mysql_fetch_row($resultado);
	//$costo_almacen=$res2[1];
	$titular="$res2[1] $res2[2] $res2[3]";
	$vigencia=$res2[0];
	$saldo=$res2[4];
	$comentario=$res2[6];
	$plan=$res2[5];
	$costo_mensual=$res2[7];
	$cajas_incluidos=$res2[8];
	$pallets_incluidos=$res2[9];

}
$consulta  = "SELECT 1 FROM `clientes` where vigencia<now() and clientes.pmb=$pmb";
//echo"$consulta";
$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
if(@mysql_num_rows($resultado)>=1)
{
	$res2=mysql_fetch_row($resultado);
	//$costo_almacen=$res2[1];
	$vigente=$res2[0];


}

if($cajas_incluidos>0)
{
//consulta numero de paquetes recibidos
$consulta2  = "SELECT count(id), sum(peso) FROM recepcion where pmb=$pmb and MONTH(fecha_recepcion)= MONTH(CURRENT_TIMESTAMP) and tipo<>7";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
	if(@mysql_num_rows($resultado2)>=1)
	{
		$res2=mysql_fetch_row($resultado2);
		$numero_recepciones=$res2[0];
	}else
	{
		$numero_recepciones=0;

	}
}
//if($costo_mensual>0)
//{
		$consulta2  = "select mes, anio from facturas_renovacion join pagos where facturas_renovacion.pmb=$pmb and tipo=1 order by anio, mes desc";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
		if(@mysql_num_rows($resultado2)>0)
		{
			$res2=mysql_fetch_row($resultado2);
			$ultimo_mes=$res2[0];
			$ultimo_anio_mensual=$res2[1];
		}
//}
}
 if($vigente==1)
	echo"<script>alert(\"PMB Vencido\");</script>";

?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">

     <?php  if($_SESSION['tipoU']=="0"){
include "menu_fu.php";
}else if($_SESSION['tipoU']=="1"){
include "menu_f.php";    }?>
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
                <th colspan="2" bgcolor="#313630" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>

              <tr class="">
                <td width="655" bgcolor="#CCCCCC"  ><p class="style5">
                  <span class="verde">PMB</span>
                  <input name="pmb" type="text" class="texto_verde" id="pmb"  value="<?echo"$pmb";?>" size="10" maxlength="10" />
                  <input name="Buscar" type="submit" id="Buscar"  value="buscar">
                  <input name="nombrec" type="text" id="nombrec" size="42" maxlength="100" />
                  <input name="buscarNombre" type="button" id="buscarNombre" value="Buscar por Nombre" onClick="javascript:window.location='buscarNombreE.php?nombre='+document.form1.nombrec.value" />
                </p></td>
                <td width="495" bgcolor="#CCCCCC"  ><table width="88%" border="0">
                  <tr>
                    <td width="53%" bgcolor="#313630"><div align="center"><span class="style11">Autorizados</span></div></td>
                  </tr>
                  <tr>
                    <td valign="top" bgcolor="#DFDFDF"><select name="autorizado" id="autorizado" style="width:250px">
                      <option value="0">--Seleccione--</option>
                        <?
						if($pmb!=""){
					  $consulta  = "SELECT c_entregar.nombre, c_entregar.app, c_entregar.apm, c_entregar.id from  c_entregar  where c_entregar.pmb = $pmb and activo=1 order by c_entregar.nombre";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());

	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";

		//$plan=$res[5];


		//$cadena=" $cadena    <li>-$nombre</li>";
		echo"<option value=\"$nombre\">$nombre</option>";
		$count++;

	}
	 $consulta  = "SELECT c_recibir.nombre, c_recibir.app, c_recibir.apm, c_recibir.id  from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.pmb = $pmb order by c_recibir.nombre";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());

	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";

		//$plan=$res[5];


		//$cadena=" $cadena    <li>-$nombre</li>";
		echo"<option value=\"$nombre\">$nombre (Receptor)</option>";
		$count++;

	}
	//$cadena= "$cadena </ul>";
	//echo"$cadena";
	}
		?>
                    </select></td>
                  </tr>
                  <tr>
                    <td valign="top" bgcolor="#DFDFDF"><span class="style10">
                      <input name="recibe" type="text" id="recibe" size="40" maxlength="100" onKeyPress="return maskKeyPress22(event)"/>
                    </span></td>
                  </tr>
                </table></td>
              </tr>
              <tr class="">
                <td colspan="2" bgcolor="#CCCCCC"  ><table width="100%" border="0" >
                  <tr>
                    <td width="52%"><table width="100%" border="0" style="margin:auto">
                      <tr>
                        <td height="60" colspan="4" bgcolor="#313630"><div align="center"><span class="style11">Titular: <strong><? echo"$titular";?></strong> </span>s</div></td>
                        </tr>
                      <tr>
                        <td width="30%"><div align="center">Plan</div></td>
                        <td width="27%"><div align="center">Vencimiento</div></td>
                        <td width="18%"><div align="center">Saldo</div></td>
                        <td width="25%"><div align="center">Comentario</div></td>
                        </tr>
                      <tr>
                        <td valign="top" bgcolor="#FFFFFF"><div align="center"><? echo"$plan";?><br>
                        <? if($cajas_incluidos>0)echo"($numero_recepciones de $cajas_incluidos)";?></div></td>
                        <td valign="top" bgcolor="#FFFFFF"><div align="center"><? echo"$vigencia";?> (<? echo"$ultimo_mes";?>/<? echo"$ultimo_anio_mensual";?>)<br> <? echo" <a href=\"renovar.php?pmb=$pmb\" class=\"iframe3\">(Renovar) </a>";?></div></td>
                        <td valign="top" bgcolor="#FFFFFF"><div align="center">$<? echo number_format(round($saldo,2),2) ."<br><a href=\"abono.php?id=$pmb\" class=\"iframe2\">(Abonar) </a>";?></div></td>
                        <td valign="top" bgcolor="#FFFFFF"><? echo"$comentario";?></td>
                      </tr>
                    </table></td>
                    <td width="48%" valign="top"><table width="76%" border="0" align="center" style="margin:auto">
                      <tr>
                        <td width="47%" bgcolor="#313630"><div align="center"><span class="style11">Servicios</span></div></td>
                      </tr>
                      <tr>
                        <td valign="top" bgcolor="#DFDFDF"><span class="style10">
                          <input name="cantidad" type="text" id="cantidad" value="1" size="10" maxlength="5" placeholder="Cant."/>
                          </span>
                            <select name="servicio" id="servicio">
                              <option value="0">-Seleccione Servicio-</option>
                              <?

					  $consulta  = "SELECT id, nombre, costo from  servicios   order by nombre";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());

	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$res=mysql_fetch_row($resultado);

		echo"<option value=\"$res[0]|$res[2]|$res[1]\">$res[1]</option>";
		$count++;

	}
	//$cadena= "$cadena </ul>";
	//echo"$cadena";

		?>
                            </select>

                            <input name="agregar" type="button" id="agregar" onClick="insRow(servicio.value)" value="Agregar" />                          </td>
                      </tr>
                      <tr>
                        <td valign="top" bgcolor="#DFDFDF"><table width="100%" border="0" cellpadding="0" id="myTable" style="margin:auto">
                            <tr>
                              <td width="9%" class="style5"><div align="center"></div></td>
                              <td width="48%">&nbsp;</td>
                              <td width="14%" class="style5">&nbsp;</td>
                              <td width="24%" class="style5">&nbsp;</td>
                              <td width="5%"><div align="center"></div></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>

                </table></td>
              </tr>
              <tr class="">
                <td colspan="2" bgcolor="#CCCCCC"  ><div align="right"><a href="imprimir_entradas.php?id=<?echo"$pmb";?>" target="_blank" class="btn-primary">Imprimir listado</a>
                </div>
                  <table width="1056" class="tablesorter" id="myTable">
                  <thead>
                    <tr>
                      <th height="30" colspan="13" bgcolor="#313630"><div align="right"><span class="style11">Tracking</span><span class="style10">
                        <input name="tracking" type="text" id="tracking" size="45" maxlength="100" onKeyPress="return maskKeyPress22(event)"/>
                        <span class="style11">Select all                        </span>
                        <input name="selectall" type="checkbox" class="style11"  id="selectall" onClick="seleccionaTodo();"/> 
                      </span></div></th>
                      </tr>
                    <tr>
                      <th width="8%" bgcolor="#313630" class="h5"><div align="center">                        Fecha</div></th>
                      <th width="5%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        Entrada</div></th>
                      <th width="15%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        Tipo</div></th>
					  <th width="7%" bgcolor="#313630" class="style11">Ubicacion</th>
                      <th width="16%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        From</div></th>
                      <th width="19%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Recibe</div>
                      </div></th>
                      <th width="7%" bgcolor="#313630" class="style11"><div align="center">Peso</div></th>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Fletera</div>
                      </div></th>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Tracking No. </div>
                      </div></th>
                      <th width="5%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Costo</div>
                      </div></th>
                      <th width="4%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Extra</div>
                      </div></th>
                      <th width="4%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        COD
                        <input name="solocod" type="checkbox"  id="solocod" onClick="totales2(this);" value="1"/>
                      </div></th>

                      <th width="3%" bgcolor="#313630"><div align="center">
                        <input name="contador" type="text" class="tablesorter " id="contador" size="3" maxlength="10" />
                      </div></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?


	if($pmb!=""){
	//muestra listados paquetes sin entregar del pmb
	/*
	$consulta  = "select tiempo_bodega, sobre_chico, sobre_grande, caja_chica, caja_mediana, caja_grande, extra_grande, llanta, bulto, tarima, bolsa_chica, bolsa_grande from planes inner join clientes on planes.id=clientes.plan where clientes.id=$id_cliente";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res2=mysql_fetch_row($resultado);
		//$costo_almacen=$res2[1];
		$dias_almacen=$res2[0];

	}*/

	//consulta el numero e paquetes recibidos ese mes para poder buscar el costo segun el numero
		$consulta2  = "SELECT count(id) FROM recepcion where pmb=$pmb and MONTH(fecha_recepcion)= MONTH(CURRENT_TIMESTAMP) and tipo=7 and largo_plazo=0";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
		if(@mysql_num_rows($resultado2)>=1)
		{
			$res2=mysql_fetch_row($resultado2);

			$numero_recepciones=$res2[0];

		}
		$numero_recepciones++;
	echo"<script>var y=document.getElementById(\"tracking\"); y.focus();</script>";// DATEDIFF( NOW() , fecha_recepcion )
	$consulta  = "select recepcion.nombre, recepcion.fecha_recepcion, mensajerias.nombre, recepcion.peso, recepcion.tracking, ubicaciones.nombre, recepcion.id, recepcion.comentario,recepcion.extra, DATEDIFF( NOW() , fecha_recepcion ),recepcion.estatus, usu.nombre, recepcion.tipo  from recepcion inner join mensajerias on recepcion.paqueteria=mensajerias.id inner join ubicaciones on recepcion.ubicacion=ubicaciones.id  left outer join usuarios as usu on recepcion.id_recibio=usu.id  where recepcion.id_sucursal=$sucursal and recepcion.suite=$pmb and (recepcion.estatus=0 or recepcion.estatus=2 or recepcion.estatus=3) and fecha_recepcion>='$fecha_alta' order by recepcion.fecha_recepcion";
	$consulta="select recepcion.nombre, recepcion.fromm, date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), tipo_entradas.nombre, fleteras.nombre, recepcion.peso, recepcion.traking, ubicacion.nombre, recepcion.costo, usuarios.nombre, recepcion.id, TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) as meses, TIMESTAMPDIFF(DAY,DATE_ADD(fecha_recepcion,INTERVAL TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) MONTH), now()) as dias, recepcion.tipo, recepcion.cod, planes.tabla_pallets, entrada, no_paquetes, no_paquetes_resto, extra, recepcion.mensaje, mensajes.mensaje, largo_plazo  from recepcion inner join tipo_entradas on recepcion.tipo=tipo_entradas.id inner join fleteras on fleteras.id=recepcion.fletera inner join ubicacion on ubicacion.id=recepcion.ubicacion inner join usuarios on usuarios.id=recepcion.id_empleado_recibe inner join clientes on clientes.pmb=recepcion.pmb inner join planes on clientes.id_plan=planes.id left outer join mensajes on recepcion.mensaje=mensajes.id where recepcion.pmb=$pmb and fecha_entrega is null order by recepcion.entrada";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	$conta=0;
	$color="CCCCCC";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$texto_extra="";
		$res=mysql_fetch_row($resultado);
		$extra=$res[19];
		$length = strlen($res[6]);
		$length = $length-4;
		$track = substr($res[6] , $length ,4);
		$peso=$res[5];
		$dias=$res[12];
		$meses=$res[11];
		$tipo=$res[13];
		$cod=$res[14];
		$costo=$res[8];
		$tabla_pallets=$res[15];
		$mensa=$res[20];
		$texto_mensa=$res[21];
		$lp=$res[22];

		if($tipo=="7" && $lp=="0")//si es pallet y no es de largo plazo calcula el costo segun los dias transcurridos
		{
			if($numero_recepciones>$pallets_incluidos )
			{
				$consulta3  = "select sobres, sobre_grande from tablas  where tipo=$tabla_pallets and c1<=$peso and c2>=$peso ";
				//echo"$consulta3 $meses";
				$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
				if(@mysql_num_rows($resultado3)>=1)
				{
					$res3=mysql_fetch_row($resultado3);
					$quince=$res3[0];
					$completo=$res3[1];
					$costo_pallet=$meses*$completo;
					if($dias>15)
						$costo_pallet2=$completo;
					else
						$costo_pallet2=$quince;
					$costo=$costo_pallet+$costo_pallet2;
					//echo"costo=$costo";
					$numero_recepciones++;
				}
			}else
			{
				if($numero_recepciones<=$pallets_incluidos && $meses>=1)
				{
				$consulta3  = "select sobres, sobre_grande from tablas  where tipo=$tabla_pallets and c1<=$peso and c2>=$peso ";
				//echo"$consulta3 $meses";
				$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
				if(@mysql_num_rows($resultado3)>=1)
				{
					$res3=mysql_fetch_row($resultado3);
					$quince=$res3[0];
					$completo=$res3[1];
					$costo_pallet=($meses-1)*$completo;
					if($dias>15)
						$costo_pallet2=$completo;
					else
						$costo_pallet2=$quince;
					$costo=$costo_pallet+$costo_pallet2;
					//echo"costo=$costo";
					$numero_recepciones++;
				}
				}
				else
					$numero_recepciones++;
			}

		}else // si no es pallet calcula los meses trascurridos y si es mas de 1 se cobra extra.
		{
			if($meses >0 && $lp=="0")
				$extra=$extra+$meses*$res[8];
			else
			{


			}
		}


		/*if($res[12]=="1" || $res[12]=="5")
			$costo_extra_vencido=$v_sobre;
		else if($res[12]=="2" )
			$costo_extra_vencido=$v_chico;
		else
			$costo_extra_vencido=$v_med;*/
		//echo"tiempobodega=$dias_almacen costo=$costo_almacen dias=$dias";


		/*if($res[8]>0)
			$texto_extra="$$res[8](NP)";
		else
			$texto_extra="";
		if(($res[12]=="9" && $dias>10) || ($res[12]!="9" && $dias>$dias_almacen)) //si es tarima da 10 dias falta ver el plan de externos para darles 15
		{
			$dias_extras=$dias-$dias_almacen;
			$costo_extra=$costo_almacen*$dias_extras;
			$texto_extra="$texto_extra $$costo_extra(TB)";
		}else
			$costo_extra=0;
		$extra=$res[8]+$costo_extra;
		if($planvencido=="1")
		{
			$extra=$extra+$costo_extra_vencido;
			$texto_extra="$texto_extra $$costo_extra_vencido(V)";
		}
		if($texto_extra=="")
			$texto_extra="$0 dlls";*/
		 if($res[16]!=$entrada_anterior && ""!=$entrada_anterior)
			{
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
			}
			if($lp>0)
				$color="0099FF";

		?>
                    <tr bgcolor="#<? echo"$color";?>" id="ren<? echo"$res[10]";?>">
                      <td><div align="center"><a href="editar_entrada.php?id=<? echo"$res[10]";?>&origen=1"  class="iframe2"><? echo"$res[2]";?></a></div></td>
                      <td><div align="center"><? echo"$res[16]";?></div></td>
                      <td><div align="center"><? echo"$res[3]";?> (
                          <? if($tipo=="7") echo"$res[18]/$res[17] <input name=\"pal_r".$res[10]."\" type=\"hidden\" class=\"texto_verde\" id=\"pal_r".$res[10]."\"  value=\"".$res[18]."\" size=\"5\" maxlength=\"5\" /><input name=\"pal".$res[10]."\" type=\"text\" class=\"texto_verde\" id=\"pal".$res[10]."\"  value=\"0\" size=\"5\" maxlength=\"5\" />";?>
                        ) <span class="style5">

                      </span></div></td>
					  <td><div align="center"><? echo"$res[7]";?></div></td>
                      <td ><div align="center"><? echo"$res[1]";?></div></td>
                      <td ><div align="center"><? echo"$res[0]";?></div></td>
                      <td ><div align="center"><? echo"$res[5]";?>lbs</div></td>
                      <td ><div align="center">
                        <? echo"$res[4]";?></div></td>
                      <td ><div align="center"><? echo"$track";?></div></td>
                      <td bgcolor="#<? echo"$color";?>"><div align="center">$<? echo"$costo";?>
					  	 <input name="costo" type="hidden" id="costo" value="<? echo"$costo";?>" />
					  	 <input name="tip<? echo"$res[10]";?>" type="hidden" id="tip<? echo"$res[10]";?>" value="<? echo"$tipo";?>" />
					  	 <input name="costo<? echo"$res[10]";?>" type="hidden" id="costo<? echo"$res[10]";?>" value="<? echo"$costo";?>" />
                          <input name="extra" type="hidden" id="extra" value="<? echo"$extra";?>" />
						  <input name="cod<? echo"$res[10]";?>" type="hidden" id="cod<? echo"$res[10]";?>" value="<? echo"$cod";?>" />
						  <input name="cod" type="hidden" id="cod" value="<? echo"$cod";?>" />
                          <input name="conta<? echo"$res[10]";?>" type="hidden" id="conta<? echo"$res[10]";?>" value="<? echo"$extra";?>" />
                      </div></td>
                      <td bgcolor="#<? echo"$color";?>"><div align="center">$<? echo"$extra";?></div></td>
                      <td bgcolor="#<? echo"$color";?>"><div align="center">$<? echo"$cod";?></div></td>

                      <td bgcolor="#<? echo"$color";?>">
                        <div align="center">
                          <input name="ch[]" type="checkbox"  id="ch" onClick="totales2(this);" value="<? echo"$res[10]";?>"/>
                          <? if($mensa!=""){?><img src="images/alert.png" title="<? echo"$texto_mensa";?>" width="19" height="19"><? }?>
                          <input name="idP[]" type="hidden" id="idP" value="<? echo"$res[6]";?>" />
                        </div></td>
                    </tr>
                    <?


			   $count=$count+1;
			   $conta++;

			$entrada_anterior=$res[16];
	}


	}
?>
                  </tbody>
                </table></td>
              </tr>
              <tr class="">
                <td colspan="2" bgcolor="#CCCCCC"  ><table width="94%" border="0">
                  <tr>
                    <td width="12%" bgcolor="#313630" class="style11"><div align="center">Total Servicios
                      <input name="cuantos" type="hidden" id="cuantos" value="<? echo"$conta";?>" />
</div></td>
                    <td width="18%" bgcolor="#313630" class="style11"><div align="center">Total Entradas </div></td>
                    <td width="11%" bgcolor="#313630" class="style11"><div align="center">Descuento</div></td>
                    <!--<td width="15%" bgcolor="#313630" class="style11"><div align="center">Cargo a cuenta </div></td>-->
                    <td width="13%" bgcolor="#313630" class="style11"><div align="center">Cargo TC </div></td>
                    <td width="14%" bgcolor="#313630" class="style11"><div align="center">Tipo de pago </div></td>
                    <td width="17%" bgcolor="#313630" class="style11"><div align="center">Total</div></td>
                  </tr>
                  <tr>
                    <td><div align="center">
                      <span class="h3">$</span>
                      <input name="total_s" type="text" class="h3" id="total_s" value="0" size="5" maxlength="10" readonly/>
                    </div></td>
                    <td><div align="center">
                      <span class="h3">$</span>
                      <input name="total" type="text" class="h3" id="total" value="0" size="5" maxlength="10" readonly/>
                    </div></td>
                    <td><div align="center">
                      <span class="h3">$</span>
                      <input name="descuento" type="text" class="h3" id="descuento" value="0" size="5" maxlength="10" onChange="totales();"/>
                    </div></td>
                    <!--<td><div align="center">
                      <input name="credito" type="checkbox" class="h3" id="credito" style="width:30px; height:30px;font-size:150%;border-width:4px;"  value="1"/>
                    </div></td>-->
                    <td><div align="center">
                      <p>
                        <input name="tc" type="checkbox" class="h3" id="tc" style="width:30px; height:30px;font-size:150%;border-width:4px;"  value="1"  onclick="totales();"/>
                        <input name="tc_monto" type="text" id="tc_monto" value="0" size="5" maxlength="10" onChange="totales();"/>
                      </p>
                      </div></td>
                    <td><select name="credito" id="credito">
                      <option value="0">--Tipo de pago--</option>
					  <option value="1">Cargo a cuenta</option>
					  <option value="2">Efectivo</option>
                      <option value="3">TC</option>
                      <option value="4">Cheque</option>
                      <option value="5">Transferencia</option>
                    </select></td>
                    <td><div align="center">
                      <span class="h3">$</span>
                      <input name="total_f" type="text" class="h3" id="total_f" value="0" size="5" maxlength="10" readonly/>
                    </div></td>
                  </tr>
                  <tr>
                    <td>Comentarios Internos </td>
                    <td><textarea name="comentarios" id="comentarios"></textarea></td>
                    <td colspan="5">
                      <div align="center"><span class="form-group">
                        Invoice to:
                        <select name="factura" id="factura" style="width:250px">
                          <?
						if($pmb!=""){
						$consulta  = "SELECT razon_social, razon_social2 from  clientes  where pmb = $pmb ";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());

	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$res=mysql_fetch_row($resultado);
		$razon="$res[0]";
		$razon2="$res[1]";

		if($razon!="")
		echo"<option value=\"$razon\">$razon</option>";
		if($razon2!="")
		echo"<option value=\"$razon\">$razon2</option>";
		$count++;

	}
					  $consulta  = "SELECT nombre, app, apm from  c_recibir  where pmb = $pmb order by tipo,nombre";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());

	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$res=mysql_fetch_row($resultado);
		$nombre="$res[0] $res[1] $res[2]";
		echo"<option value=\"$nombre\">$nombre</option>";
		$count++;

	}
	$consulta  = "SELECT razon_social, razon_social2 from  clientes  where pmb = $pmb ";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());

	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{

		$res=mysql_fetch_row($resultado);
		$razon="$res[0]";
		$razon2="$res[1]";

		if($razon!="")
		echo"<option value=\"$razon\">$razon</option>";
		if($razon2!="")
		echo"<option value=\"$razon\">$razon2</option>";
		$count++;

	}
	//$cadena= "$cadena </ul>";
	//echo"$cadena";
	}
		?>
                        </select>
                      </span></div></td>
                  </tr>
                  <tr>
                    <td>Comentario a imprimir </td>
                    <td><textarea name="comentarios_i" id="comentarios_i"></textarea></td>
                    <td colspan="5"><div align="center">
                      <input name="salida" type="submit" class="h2" id="salida" onClick="return validar();" value="Confirma Salida"/>
                    </div></td>
                  </tr>
                </table>
                <iframe src="sesionActiva.php" width="100" height="25" scrolling="no"></iframe></td>
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
