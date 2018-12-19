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
.style12 {font-size: 24px}
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

$fecha = $_POST["desde"];
$fecha_hasta = $_POST["hasta"];


$fecha= $_GET["desde"];
	$fecha_temp=explode("/", $fecha);
	//$fecha="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
	$fecha2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";

	$fecha_hasta= $_GET["hasta"];
	$fecha_temp=explode("/", $fecha_hasta);
	//$fecha_hasta="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
	$fecha_hasta2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";

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


        </nav>
    </header> <!-- /. main-header -->
    <!-- /. barra-menu -->
<section class="tipos-textos">
      <h2 class="style12"> Detalle de Salidas </h2>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form name="form1" method="post" action="">

          <table width="1001" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th width="993" bgcolor="#313630" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr class="">
                <td bgcolor="#CCCCCC"  ><br>
                  <table width="895" class="tablesorter" id="myTable">
                  <thead>
                    <tr>
                      <th width="8%" bgcolor="#313630" class="h5"><div align="center" class="style11">Factura</div></th>
                      <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center"> PMB                          </div>
                      </div></th>
                      <th width="7%" bgcolor="#313630" class="h5 style11"><div align="center">Costo</div></th>
                      <th width="5%" bgcolor="#313630" class="h5 style11"><div align="center">COD</div></th>
                      <th width="8%" bgcolor="#313630" class="h5 style11"><div align="center">Servicio</div></th>
                      <th width="8%" bgcolor="#313630" class="h5 style11"><div align="center">Descuento</div></th>
                      <th width="8%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center"> Monto                          </div>
                      </div></th>
                      <th width="8%" bgcolor="#313630" class="style11"><div align="center">TC Fee </div></th>
                      <th width="28%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                        <div align="center"> Tipo Pago                         </div>
                      </div></th>
                      <th width="13%" bgcolor="#313630"><div align="center"><span class="style11">Fecha</span></div></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?




	$monto=0;
	$consulta="select  salidas.id,   salidas.pmb, ROUND(total,2) as total, credito, date_format(salidas.fecha, '%m/%d/%Y'), ROUND(sum(costo)+ sum(extra),2), ROUND(sum(cod),2), ROUND(descuento,2), ROUND(total_s,2), ROUND(tc,2), ROUND(total_p,2) from salidas  left outer join recepcion on salidas.id=recepcion.id_salida where date(salidas.fecha)>='$fecha2' and date(salidas.fecha)<='$fecha_hasta2' $and  group by salidas.id, salidas.pmb order by id";

	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	$total_entradas=0;
	$color="CCCCCC";
	while(@mysql_num_rows($resultado)>=$count)
	{


		$res=mysql_fetch_row($resultado);

		$total_entradas=$total_entradas+($res[5]+$res[6]-$res[7]+$res[8]+$res[9]);
		if($res[3]=="1")
			$credito="Cargo a cuenta";
		else if($res[3]=="2")
			$credito="Efectivo";
		else if($res[3]=="3")
			$credito="TC";
		else if($res[3]=="4")
			$credito="Cheque";
		else if($res[3]=="5")
			$credito="Transferencia";


			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";

		?>
                    <tr bgcolor="#<? echo"$color";?>">
                      <td><div align="center"><? echo"$res[0]";?></div></td>
                      <td><div align="center"><? echo"$res[1]";?></div></td>
                      <td><div align="center">$<? echo number_format((round($res[5],2)),2);//+round($res[10],2)?></div></td>
                      <td><div align="center">$<? echo number_format(round($res[6],2),2);?></div></td>
                      <td><div align="center">$<? echo number_format(round($res[8],2),2);?></div></td>
                      <td><div align="center">$<? echo number_format(round($res[7],2),2);?></div></td>
                      <td><div align="center">$<? echo number_format(round($res[2],2),2);?></div></td>
                      <td><div align="center">$<? echo number_format(round($res[9],2),2);?></div></td>
                      <td><div align="center"><? echo"$credito";?></div></td>
                      <td>
                        <div align="center"><a href="imprimir_entrega2.php?id=<? echo"$res[0]"?>" target="_blank" class="btn-primary"><? echo"$res[4]";?></a></div></td>
                      </tr>

                    <?
				$col1=$col1+$res[5];
				$col2=$col2+$res[6];
				$col3=$col3+$res[7];
				$col4=$col4+$res[8];
				$col5=$col5+$res[9];
			   $count=$count+1;
			   $conta++;

			   $monto=$monto+$res[2];
echo"<script>console.log(\"$res[0]: $res[2] : $monto\");</script>";

	}



?>
                   <tr bgcolor="#<? echo"$color";?>">
                      <td>&nbsp;</td>
                      <td><div align="center"></div></td>
                      <td><div align="center"><strong>$<? echo number_format(round($col1,2),2);?></strong></div></td>
                      <td><div align="center"><strong>$<? echo number_format(round($col2,2),2);?></strong></div></td>
                      <td><div align="center"><strong>$<? echo number_format(round($col4,2),2);?></strong></div></td>
                      <td><div align="center"><strong>$<? echo number_format(round($col3,2),2);?></strong></div></td>
                      <td><div align="center"><strong>$<? echo number_format(round($monto,2),2);?></strong></div></td>
                      <td><div align="center"><strong>$<? echo number_format(round($col5,2),2);?></strong></div></td>
                      <td><div align="center"></div></td>
                      <td>&nbsp;</td>
                    </tr>
				  </tbody>
                </table>                    </td>
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
