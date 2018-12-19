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
		<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="colorbox.css" />
        <style type="text/css">
<!--
.style11 {color: #FFFFFF}
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
			costo=(costo*1)+eval("document.form1.costo"+document.form1.ch.value+".value")*1;
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
setlocale(LC_TIME, 'spanish'); 
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];


$pmb= $_GET["id"];



?>

  <body><!-- /. main-header -->
    <!-- /. barra-menu -->
    <section class="tabla">
      <div >
        <div >
          <div >
            <form name="form1" method="post" action="">
              <p><strong>PMB: <? echo"$pmb";?></strong></p>
              <table width="559" class="tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th width="16%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Entry </div></th>
                    <th width="20%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Kind </div></th>
                    <th width="23%" bgcolor="#313630" class="style11">Location</th>
                    <th width="41%" bgcolor="#313630" class="h5"><div align="center" class="style11"> From</div></th>
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
	
	
	
	$consulta="select recepcion.nombre, recepcion.fromm, date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), tipo_entradas.nombre, fleteras.nombre, recepcion.peso, recepcion.traking, ubicacion.nombre, recepcion.costo, usuarios.nombre, recepcion.id, TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) as meses, TIMESTAMPDIFF(DAY,DATE_ADD(fecha_recepcion,INTERVAL TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) MONTH), now()) as dias, recepcion.tipo, recepcion.cod, planes.tabla_pallets, entrada from recepcion inner join tipo_entradas on recepcion.tipo=tipo_entradas.id inner join fleteras on fleteras.id=recepcion.fletera inner join ubicacion on ubicacion.id=recepcion.ubicacion inner join usuarios on usuarios.id=recepcion.id_empleado_recibe inner join clientes on clientes.pmb=recepcion.pmb inner join planes on clientes.id_plan=planes.id where recepcion.pmb=$pmb and fecha_entrega is null order by recepcion.entrada";
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
		$peso=$res[5];
		$dias=$res[12];
		$meses=$res[11];
		$tipo=$res[13];
		$cod=$res[14];
		$costo=$res[8];
		$tabla_pallets=$res[15];
		
		
		
		
		 if($res[16]!=$entrada_anterior && ""!=$entrada_anterior)
			{
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
			}	
		?>
                  <tr bgcolor="#<? echo"$color";?>">
                    <td><div align="center"><? echo"$res[16]";?></div></td>
                    <td><div align="center"><? echo"$res[3]";?></div></td>
                    <td><div align="center"><? echo"$res[7]";?></div></td>
                    <td><div align="center"><? echo"$res[1]";?></div></td>
                  </tr>
                  <?
					
					
			   $count=$count+1;
			   $conta++;
			
			$entrada_anterior=$res[16];
	}
	
	
	}
?>
                </tbody>
              </table>
            </form>
		  </div>
        </div>
      </div>
  </section><!-- main-footer -->

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
   

    <!-- Bootsrap javascript file -->
   
	 <script>
window.print();
      </script>

  </body>
</html>
