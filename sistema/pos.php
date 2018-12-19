<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Punto De Venta</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/style-admin.css">
        <script src="assets/js/modernizr-2.6.2.min.js"></script>
        <style type="text/css">
<!--
.style10 {color: #FF0000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style11 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
}
.style13 {color: #FFFFFF; font-weight: bold; font-size: 12px;}
.style2 {font-size: 36px}
.style6 {color: #FFFFFF}
.style8 {color: #FF0000}
-->
        </style>

<script>
$(document).ready(function()     {         $("#myTable").tablesorter();     } );

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

					for(i=0 ; i<document.form2.ch.length ; i++)
					{
						if(y.value==document.form2.idP[i].value)
						{
							document.form2.ch[i].checked=true;
							//extra=(extra*1)+document.form1.extra[i].value;
						}


					}
					totales();
					y.value="";
					y.focus();
				}
			}
function totales(){
	var extra=0;
	var contador=0;
	for(i=0 ; i<document.form2.ch.length ; i++)
	{
		if(document.form2.ch[i].checked)
		{
			extra=(extra*1)+document.form2.extra[i].value*1;
			contador=(contador*1)+1;
		}
	}
	if(document.form2.llave.checked==true)
		extra=extra*1+1;
	document.form2.total.value=extra;
	document.form2.contador.value=contador;
}
function valida()
{
	if(document.form1.total.value=="0")
	{
		alert("No agrego producto");
		document.form1.prod.focus();
		return false;
	}else
	{
		if(document.form1.efectivo.value=="" || document.form1.efectivo.value=="0")
		{
			alert("No escribio efectivo recibido");
			document.form1.efectivo.focus();
			return false;
		}
	}
}
function showDes(cadena)
{
	if(cadena!="0")
	{
		elementos= cadena.split("|");



		var m=document.getElementById('descripcion')
		//var n=document.getElementById('precio')



		m.innerHTML=elementos[3];
		document.form1.preciop.value=elementos[2];
		//n.innerHTML=elementos[2];


	}
}
function deleteRow(r,quita, quitatax, quitasub)
{
var i=r.parentNode.parentNode.rowIndex;
document.getElementById('myTable').deleteRow(i);
var m=document.getElementById('monto')
var monto=document.form1.total.value;
var tax=document.form1.taxt.value;
var subtotal=document.form1.subtotal.value;

monto=monto*1-quita*1;
tax=tax*1-quitatax*1;
subtotal=subtotal-quitasub*1;
tax=tax*100;
 tax=Math.floor(tax);
 tax=tax/100;

 subtotal=subtotal*100;
 subtotal=Math.floor(subtotal);
 subtotal=subtotal/100;
 monto=monto*100;
 monto=Math.floor(monto);
 monto=monto/100;
document.form1.total.value=monto;
document.form1.subtotal.value=subtotal;
document.form1.taxt.value=tax;
}

function insRow(cadena)
{
if(cadena!="0")
{
elementos= cadena.split("|");

var x=document.getElementById('myTable').insertRow(0);
var y=x.insertCell(0);
var z=x.insertCell(1);
var z1=x.insertCell(2);
var z2=x.insertCell(3);
var z3=x.insertCell(4);
var z4=x.insertCell(5);

var m=document.getElementById('monto')
//var monto=m.innerHTML;
var monto=document.form1.total.value;
var sumatax=document.form1.taxt.value;
var sumasubtotal=document.form1.subtotal.value;
var cantidad=document.form1.cantidad.value;
var sub=0;
var precio=0;
var tax=0;
precio=document.form1.preciop.value;
if(elementos[1]=="1")
{
	sub=(cantidad*1*precio*1);

	//precio=elementos[2];
	tax=(cantidad*1*precio*1)*.08;
	subt=(cantidad*1*precio*1)+tax*1;
}
else
{
	sub=cantidad*1*precio*1;
	subt=cantidad*1*precio*1;
	//precio=elementos[2];
	tax=0;
}
 tax=tax*100;
 tax=Math.round(tax);
 tax=tax/100;

 subt=subt*100;
 subt=Math.round(subt);
 subt=subt/100;
 sub=sub*100;
 sub=Math.round(sub);
 sub=sub/100;
sumatax=sumatax*1+tax*1;
monto=monto*1+subt*1;
sumasubtotal=sumasubtotal*1+sub*1;
 sumatax=sumatax*100;
 sumatax=Math.round(sumatax);
 sumatax=sumatax/100;

 sumasubtotal=sumasubtotal*100;
 sumasubtotal=Math.round(sumasubtotal);
 sumasubtotal=sumasubtotal/100;
 monto=monto*100;
 monto=Math.round(monto);
 monto=monto/100;
//m.innerHTML=monto;
document.form1.subtotal.value=sumasubtotal;
document.form1.total.value=monto;
document.form1.taxt.value=sumatax;
x.id="p"+elementos[0];
y.innerHTML="<center>"+document.form1.cantidad.value+"</center>";
y.className="style5";
z.innerHTML=elementos[3];
z.className="style5";
z1.innerHTML="$"+precio;
z1.className="style5";
z2.innerHTML="$"+tax;
z2.className="style5";
z3.innerHTML="$"+subt;
z3.className="style5";
z4.innerHTML="<input name=\"precio[]\"  type=\"hidden\" value=\""+precio+"\" /><input name=\"tax[]\"  type=\"hidden\" value=\""+tax+"\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\""+elementos[0]+"\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\""+document.form1.cantidad.value+"\" /><input name=\"monto[]\"  type=\"hidden\" value=\""+subt+"\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this,"+subt+", "+tax+","+sub+")\"/>";
document.form1.cantidad.value="1";
document.form1.cantidad.focus();
}
}

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
  var tipo=0;
  if(document.form1.tipo[1].checked)
  	tipo=1;
xmlhttp.open("GET","calculavigencia2.php?id="+document.form1.plan.value+"&tipo="+tipo,true);
xmlhttp.send();
}
function pagos(){
	var str=document.form1.plan.value;
	var s=str.split("|");
	if(s[4]==0){
		document.form1.tipo[0].checked=true;
		document.form1.tipo[1].checked=false;
		document.form1.tipo[1].disabled=true;
	}
	else{
		document.form1.tipo[1].disabled=false;
	}
	buscar();
}
function calculacambio()
{
	if(document.form1.efectivo.value>0 && document.form1.total.value>0)
	{
		var tot=document.form1.efectivo.value-document.form1.total.value
		tot=tot*100;
		tot=Math.ceil(tot);
 		tot=tot/100;
		document.form1.cambio.value=tot;
	}
}
</script>

</head>
<?

include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

$venta=$_POST["venta"];


if($venta=="Venta")
{
	$fechaActual= $_POST["fechaActual"];
	$idproducto= $_POST["idproducto"];
	$precio= $_POST["precio"];
	$tax= $_POST["tax"];
	$cantidad= $_POST["cantidad_d"];
	$monto= $_POST["monto"];
	$subtotal= $_POST["subtotal"];
	$taxt= $_POST["taxt"];
	$total= $_POST["total"];
	$efectivo= $_POST["efectivo"];
	$cambio= $_POST["cambio"];
	$comentario= $_POST["comentario"];
	$guia= $_POST["guia"];
	$tipo= $_POST["tipo"];
	$pmb= $_POST["pmb"];
	if(sizeof($idproducto)>0)
	{
		$r=sizeof($idproducto);
		//echo"$r";
		$consulta  = "insert into ventas ( fecha, usuario, subtotal, tax, total,efectivo, cambio, tipo, pmb) values (now(), $idU,  $subtotal, $taxt, $total,$efectivo, $cambio,$tipo  , $pmb)";
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
		$consulta  = "SELECT max(id) from ventas where  usuario=$idU ";
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1 $consulta: " . mysql_error());
		if(@mysql_num_rows($resultado)>=1)
		{
			$res=mysql_fetch_row($resultado);
			$id_venta=$res[0];
		}
		$count=0;
		foreach($idproducto as $a)
		{
			$consulta  = "insert into ventas_detalle(id_venta, id_producto, precio, tax, cantidad,subtotal) values($id_venta, $a , $precio[$count], $tax[$count], $cantidad[$count], $monto[$count]) ";
			$resultado = mysql_query($consulta) or die("Error en operacion1:$consulta " . mysql_error());//
			$consulta  = "update productos set cantidad=cantidad-$cantidad[$count] where id=$a";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
			$count++;
		}
		$consulta  = "update ventas set  comentario='$comentario' where id=$id_venta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	echo"<script>window.open=window.open (\"imprimir_venta.php?id=$id_venta\",\"mywindow\");</script>";
	}
}
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
		  <form id="form1" name="form1" method="post" action="">
            <table width="941" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="79" bgcolor="#CCCCCC"><div align="center">
                  <input name="cantidad" type="text" id="cantidad" value="1" size="4" maxlength="3" />
              </div></td>
              <td width="419" bgcolor="#CCCCCC"><span class="style10">
                <select name="prod" id="prod"  onChange="showDes(prod.value)">
                  <option value="0" selected="selected">---Selecciona producto--</option>
                  <?



	$consulta  = "select id, taxable,precio,nombre from productos  order by nombre";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("Error en operacion3: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		 $res2=mysql_fetch_row($resultado);
		 $duracion=$res2[1];
		 $descripcion=$res2[5];
    	 echo " <option value=\"$res2[0]|$res2[1]|$res2[2]|$res2[3]\">$res2[3] </option>\n";

	 	 $count=$count+1;
	}
						?>
                </select>
                <span class="style6"><span class="style5">
                <input name="fechaActual" type="hidden" id="fechaActual" />
                <input name="soloFecha" type="hidden" id="soloFecha" />
              </span></span></span></td>
              <td width="221" bgcolor="#CCCCCC"><span class="style11">$</span>
                <input name="preciop" type="text" id="preciop" value="0" size="5" maxlength="5" />
              </td>
              <td width="222" bgcolor="#CCCCCC"><span class="style2">
                <input name="agregar" type="button" id="agregar" onClick="insRow(prod.value)" value="Agregar" />
              </span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td id="descripcion">&nbsp;</td>
              <td class="style11" id="precio">&nbsp;</td>
              <td class="style11" id="precio"><span class="form-group"></span>
                <select name="pmb"     id="pmb" >
                  <option value="999999">--Mostrador--</option>
                  <?
						  	$query = "SELECT * from pmbs where id in(select pmb from clientes) order by id";
                            $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                            while($io = mysql_fetch_assoc($result)){?>
                  <option value="<? echo $io['id']?>" <? echo $ob==$io['id']?"selected":""; ?> ><? echo $io['id']?></option>
                  <?
                            }
                          ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" >
                  <tr>
                    <td width="6%" bgcolor="#313630" class="style13"><div align="center">Cant</div></td>
                    <td width="48%" bgcolor="#313630" class="style13"><div align="center">Descripcion</div></td>
                    <td width="15%" bgcolor="#313630" class="style13"><div align="center">Precio</div></td>
                    <td width="15%" bgcolor="#313630" class="style13"><div align="center">tax</div></td>
                    <td width="8%" bgcolor="#313630" class="style13"><div align="center">Subtotal</div></td>
                    <td width="8%" bgcolor="#313630" class="style13"><div align="center"></div></td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellpadding="0" id="myTable">
                    <tr>
                      <td width="9%" class="style5"><div align="center"></div></td>
                      <td width="49%">&nbsp;</td>
                      <td width="16%" class="style5">&nbsp;</td>
                      <td width="10%" class="style5">&nbsp;</td>
                      <td width="11%" class="style5">&nbsp;</td>
                      <td width="5%"><div align="center"></div></td>
                    </tr>
                </table></td>
              <td valign="bottom"><table width="100%" border="0">
                  <tr>
                    <td width="40%"><div align="right">SubTotal</div></td>
                    <td width="60%"><input name="subtotal" type="text" id="subtotal" value="0" size="10" maxlength="10" readonly/></td>
                  </tr>
                  <tr>
                    <td width="40%"><div align="right">Tax</div></td>
                    <td width="60%"><input name="taxt" type="text" id="taxt" value="0" size="10" maxlength="10" readonly/></td>
                  </tr>
                  <tr>
                    <td width="40%"><div align="right">Total</div></td>
                    <td width="60%"><input name="total" type="text" id="total" value="0" size="10" maxlength="10" readonly/></td>
                  </tr>
                  <tr>
                    <td><div align="right">Efectivo</div></td>
                    <td><input name="efectivo" type="text" id="efectivo" value="0" size="10" maxlength="10" onChange="calculacambio();";/></td>
                  </tr>
                  <tr>
                    <td><div align="right">Cambio</div></td>
                    <td><input name="cambio" type="text" id="cambio" value="0" size="10" maxlength="10" readonly/></td>
                  </tr>
                  <tr>
                    <td colspan="2"><select name="tipo" id="tipo">
                      <option value="0">--Tipo de pago--</option>
                      <option value="1">Cargo a cuenta</option>
                      <option value="2">Efectivo</option>
                      <option value="3">TC</option>
                      <option value="4">Cheque</option>
                      <option value="5">Transferencia</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="center">
                        <p>
                          <input name="venta" type="submit" class="h2" id="venta" onClick="return valida();" value="Venta"/>
                      </p>
                        </div></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div align="center">
                        <input name="limpiar" type="button" id="limpiar" value="Limpiar " onClick="window.location='pos.php';" />
                    </div></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="3" valign="top">Guias
                <textarea name="comentario" cols="25" rows="2" id="comentario"></textarea>
                <span class="style8">(Solo en venta de envios)</span></td>
              <td valign="bottom">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" valign="top">              (Escanear número de guia antes de presionar boton Venta) </td>
              <td valign="bottom">&nbsp;</td>
            </tr>
          </table>
		  </form>
		  <p>&nbsp;</p>
          </div>
        </div>
      </div>
  </section>

  <?php include "footer.php" ?>

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.1.min.js"><\/script>')</script>

    <!-- Bootsrap javascript file -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- owl carouseljavascript file -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Template main javascript -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
