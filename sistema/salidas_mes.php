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
.style13 {color: #FFFFFF; font-weight: bold; }
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


$pmb= $_GET["id"];
$id_mes= $_GET["mes"];
$id_year= $_GET["anio"];


?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="navbar-top">
              <div class="container">
                  <div class="row">
                    <div class="col-sm-6 col-xs-12">
                      <ul class="list-unstyled list-inline header-contact">
                        <li> <i class="fa fa-phone"></i> <a href="tel:(915) 351-8160">(915) 351-8160 </a> </li>
                        <li> <i class="fa fa-envelope"></i> <a href="mailto:info@mas-post.com">info@mas-post.com </a> </li>
                      </ul> <!-- /.header-contact  -->
                    </div>
                    <div class="col-sm-6 col-xs-12 text-right">
                      <ul class="list-unstyled list-inline header-social">
                        <li> <a href="https://www.facebook.com/maspostwarehouse" target="_blank"> <i class="fa fa-facebook"></i> </a> </li>
                      </ul> <!-- /.header-social  -->
                    </div>
                  </div>
              </div>
            </div>

           <? include "menu_f.php"?>
        </nav>
    </header> <!-- /. main-header -->

    <article class="barra-menu">

    </article><!-- /. barra-menu -->

  <section class="tipos-textos">
      <h2> Salidas Del Mes </h2>
  </section>
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
                <td bgcolor="#CCCCCC"  >&nbsp;</td>
              </tr>
              <tr class="">
                <td bgcolor="#CCCCCC"  ><table width="1056" class="tablesorter" id="myTable">
                  <thead>
                    <tr>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        Fecha</div></th>
                      <th width="5%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Salida                        </div></th>
                      <th width="4%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        Tipo</div></th>
					  <th width="7%" bgcolor="#313630" class="style11"><div align="center" class="style11">PMB</div></th>
                      <th width="11%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        From</div></th>
                      <th width="13%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Recibe</div>
                      </div></th>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Fletera</div>
                      </div></th>
                      <th width="10%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Tracking No. </div>
                      </div></th>
                      <th width="5%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Costo</div>
                      </div></th>
                      <th width="6%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center">                          Extra</div>
                      </div></th>
                      <th width="5%" bgcolor="#313630" class="h5"><div align="center" class="style11">                        COD</div></th>

                      <th width="9%" bgcolor="#313630"><div align="center" class="style11"><span class="style11">Fecha</span></div></th>
                      <th width="11%" bgcolor="#313630"><div align="center" class="style11"><span class="style11">SE ENTREGO  </span></div></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?




	$consulta="select recepcion.nombre, recepcion.fromm, date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), tipo_entradas.nombre, fleteras.nombre, recepcion.peso, recepcion.traking, recepcion.pmb, recepcion.costo, usuarios.nombre, recepcion.id, TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) as meses, TIMESTAMPDIFF(DAY,DATE_ADD(fecha_recepcion,INTERVAL TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) MONTH), now()) as dias, recepcion.tipo, recepcion.cod, planes.tabla_pallets, id_salida, extra, date_format(recepcion.fecha_entrega, '%m/%d/%Y'), entrego, recepcion.id_salida from recepcion inner join tipo_entradas on recepcion.tipo=tipo_entradas.id inner join fleteras on fleteras.id=recepcion.fletera inner join ubicacion on ubicacion.id=recepcion.ubicacion inner join usuarios on usuarios.id=recepcion.id_empleado_recibe inner join clientes on clientes.pmb=recepcion.pmb inner join planes on clientes.id_plan=planes.id inner join salidas on recepcion.id_salida=salidas.id where month(fecha_entrega)='$id_mes' and year(fecha_entrega)='$id_year' and recepcion.pmb=$pmb   order by recepcion.id_salida";
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

		/*if($tipo=="7")//si es pallet calcula el costo segun los dias transcurridos
		{
			$consulta3  = "select sobres, paquetes from tablas  where tipo=$tabla_pallets and c1<=$peso and c2>$peso ";
			//echo"$consulta3";
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
			}

		}else // si no es pallet calcula los meses trascurridos y si es mas de 1 se cobra extra.
		{
			if($meses >0)
				$extra=$meses*$res[8];
		}*/

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
		?>
                    <tr bgcolor="#<? echo"$color";?>">
                      <td><div align="center"><a href="editar_entrada_lectura.php?id=<? echo"$res[10]";?>&origen=3"  class="iframe2"><? echo"$res[2]";?></a></div></td>
                      <td><div align="center"><? echo"$res[16]";?></div></td>
                      <td><div align="center"><? echo"$res[3]";?></div></td>
					  <td><div align="center"><? echo"$res[7]";?></div></td>
                      <td><div align="center"><? echo"$res[1]";?></div></td>
                      <td><div align="center"><? echo"$res[0]";?></div></td>
                      <td><div align="center">
                          <? echo"$res[4]";?></div></td>
                      <td><div align="center"><? echo"$track2 ..$track";?></div></td>
                      <td><div align="center">$<? echo"$costo";?>
					  	 <input name="costo" type="hidden" id="costo" value="<? echo"$costo";?>" />
						 <input name="costo<? echo"$res[10]";?>" type="hidden" id="costo<? echo"$res[10]";?>" value="<? echo"$costo";?>" />
                          <input name="extra" type="hidden" id="extra" value="<? echo"$extra";?>" />
                          <input name="conta<? echo"$res[10]";?>" type="hidden" id="conta<? echo"$res[10]";?>" value="<? echo"$extra";?>" />
                      </div></td>
                      <td><div align="center">$<? echo"$extra";?></div></td>
                      <td><div align="center">$<? echo"$cod";?></div></td>

                      <td>
                        <div align="center"><a href="imprimir_entrega2.php?id=<? echo"$id_salida"?>" target="_blank" class="btn-primary"><? echo"$fecha_entrega";?></a></div></td>
                      <td><? echo"$entrego";?></td>
                    </tr>

                    <?
					$total=$total+$costo+$extra+$cod;

			   $count=$count+1;
			   $conta++;

			$entrada_anterior=$res[16];
	}



?>
                  <tr bgcolor="#<? echo"$color";?>">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td bgcolor="#FF0000"><span class="style11">Total</span></td>
                      <td colspan="3" bgcolor="#FF0000"><span class="style13"><div align="center">$<? echo"$total";?>

                        </div></span></td>
                      <td bgcolor="#FF0000"><div align="center"><span class="style11"><? echo"$conta";?></span></div></td>
                      <td>&nbsp;</td>
                    </tr>
				  </tbody>
                </table>
                  <table width="793" align="left">
                    <tr>
                      <td width="16%" bgcolor="#999999">Date</td>
                      <td width="16%" bgcolor="#999999"><div align="center">Salida</div></td>
                      <td width="16%" bgcolor="#999999">PMB</td>
                      <td width="16%" bgcolor="#999999"><div align="center">Qty</div></td>
                      <td width="52%" bgcolor="#999999"><div align="center">Service</div></td>
                      <td width="18%" bgcolor="#999999"><div align="center">Amount</div></td>
                      <td width="14%" bgcolor="#999999"><div align="center">Subtotal</div></td>
                    </tr>
                    <?
if($pmb!="")
		$and=" and salidas.pmb=$pmb ";
	else
		$and="";
$total_servicios=0;
	$consulta  = "select cantidad, nombre, precio, cantidad*precio, id_salida, salidas.pmb, date_format(salidas.fecha, '%m/%d/%Y') from detalle_servicios inner join servicios on detalle_servicios.id_servicio=servicios.id inner join salidas on detalle_servicios.id_salida=salidas.id where date(fecha)>='$fecha2' and date(fecha)<='$fecha_hasta2' $and ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);


		?>
                    <tr>
                      <td><div align="center"><? echo"$res[6]";?></div></td>
                      <td><div align="center"><? echo"$res[4]";?></div></td>
                      <td><div align="center"><? echo"$res[5]";?></div></td>
                      <td><div align="center"><? echo"$res[0]";?></div></td>
                      <td><div align="center"><? echo"$res[1]";?></div></td>
                      <td><div align="center"><? echo number_format($res[2],2);?></div></td>
                      <td><div align="center"><? echo number_format($res[3],2);?> </div></td>
                    </tr>
                    <?
		$total_servicios=$total_servicios+$res[3];
			   $count=$count+1;
	}
	$count--;
?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><div align="right">Total</div></td>
                      <td bgcolor="#FF0000"><div align="center">$<? echo number_format($total_servicios,2);?></div></td>
                    </tr>
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
