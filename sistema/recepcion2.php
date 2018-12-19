<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Entrada </title>
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
.style11 {color: #313630}
input:focus{
 border: 2px solid #CC6600;
 background: #CC9933;
}
select:focus{
 border: 2px solid #CC6600;
 background: #CC9933;
}
.style13 {color: #1c51c6}
.style15 {font-size: 9px}
.style17 {font-size: 9px; color: #000000; }
-->
        </style>

<script>
function valorgrande()
{
	document.form1.otro.value=document.form1.costo_grande.value;
}
function maskKeyPress88(objEvent) {
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
					buscar();
					return false;
				}

			}

function maskKeyPress99(objEvent) {
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
					tb_show('', 'buscarNombreR.php?nombre='+document.form1.nombrec.value+'&TB_iframe=true&height=450&width=600', null);
					return false;
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
	document.form1.nombre.focus();
   }
  }
xmlhttp.open("GET","buscarpmb.php?id="+document.form1.pmb.value,true);
xmlhttp.send();

}
function precalculaCosto()
{
	if(document.form1.tipo[9].checked)
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
		document.form1.cobro.value=xmlhttp.responseText;
		//document.form1.cobro.value=document.form1.cobro.value*1;

	   }
	  }
	xmlhttp.open("GET","calculaCosto.php?tipo="+tipo.value+"&remesa=0&pmb="+document.form1.pmb.value+"&peso="+document.form1.peso.value,true);
	xmlhttp.send();
	}

}
function calculaCosto(tipo)
{
if(document.form1.pmb.value!="")
{
var remesa=0;
if(document.form1.remesa[0].checked)
	remesa=1;
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
    document.form1.cobro.value=xmlhttp.responseText;
   }
  }
xmlhttp.open("GET","calculaCosto.php?tipo="+tipo.value+"&remesa="+remesa+"&pmb="+document.form1.pmb.value+"&peso="+document.form1.peso.value+"&cuantos="+document.form1.cuantos.value,true);
xmlhttp.send();
}
else
{
	alert("Debe seleccionar PMB");
}
}

function valida(){
var flete=0;
var ubicacion=document.form1.ubicacion.value.split("|");
for (i=0;i<document.form1.fletera.length;i++) {
	if (document.form1.fletera[i].checked)
		flete=1;
}
var sele=99;
for (i=0;i<document.form1.tipo.length;i++) {
	if (document.form1.tipo[i].checked)
		sele=i;
}
if(sele=="99")
{
	alert("No selecciono tipo");
	document.form1.peso.focus();
	return false;
}else
{
	if(document.form1.pmb.value=="")
	{
		alert("No escribio PMB");
		document.form1.pmb.focus();
		return false;
	}
	else
	{
		if(document.form1.from.value=="" )
		{
			alert("No escribio from");
			document.form1.from.focus();
			return false;
		}
		else
		{
			if(flete=="0" && document.form1.fletera2.value=="0")
			{
				alert("No selecciono fletera");
				document.form1.fletera2.focus();
				return false;
			}
			else
			{
				if(document.form1.traking.value=="" && document.form1.cuantos.value=="0")
				{
					alert("No capturo tracking number ");
					document.form1.traking.focus();
					return false;
				}else
				{


						if(document.form1.nombre===undefined || document.form1.nombre.value=="0")
						{

									sele=0;
						}
						else
						{

									sele=1;

						}

					if(sele==0 )
					{
						alert("Debe seleccionar cliente ");
						document.form1.pmb.focus();
						return false;
					}else
					{
						if((document.form1.peso.value=="0" && document.form1.remesa[0].checked==false) || (document.form1.peso.value=="" && document.form1.remesa[0].checked==false))
						{
							alert("No capturo peso");
							document.form1.peso.focus();
							return false;
						}
						else
						{
							if(document.form1.ubicacion.value=="0" && document.form1.cuantos.value=="0")
							{
								alert("No selecciono ubicacion");
								document.form1.ubicacion.focus();
								return false;
							}
							else
							{
								if(document.form1.cod.value=="" && document.form1.cuantos.value=="0")
								{
									alert("C.O.D. no puede ir vacio");
									document.form1.cod.focus();
									return false;
								}
								else
								{
									if(1>2)//document.form1.traking.value=="" && document.form1.cuantos.value=="0"
									{
										alert("Traking no puede ir vacio");
										document.form1.traking.focus();
										return false;
									}
									else
									{
										if(document.form1.cobro.value=="" && document.form1.cuantos.value=="0")
										{
											alert("Cobro no puede ir vacio");
											document.form1.cobro.focus();
											return false;
										}
										else
										{
											if(confirm("Confirmar si la informacion es correcta?  \n Cobro="+document.form1.cobro.value+" \n Ubicacion="+ubicacion[1]+"\nTracking= "+document.form1.traking.value)) {
											return true;
											}else{
											return false;
											}
										}

									}
								}
							}

						}
					}
				}

			}
		}
	}
}
}
function showRemesa(){
    var row = document.getElementById("myRemesa");
	row.style.display = '';
	var row = document.getElementById("agregar");
	row.style.display = '';

}
function hideRemesa(){
    var row = document.getElementById("myRemesa");
	row.style.display = 'none';
	var row = document.getElementById("agregar");
	row.style.display = 'none';
}
function insRow(cadena)
{
var sele=99;
for (i=0;i<document.form1.tipo.length;i++) {
	if (document.form1.tipo[i].checked)
		sele=i;
}
if(sele=="99")
{
	alert("No selecciono tipo");
	document.form1.peso.focus();
	return false;
}
else
{
	if(document.form1.peso.value=="" || document.form1.peso.value=="0" || (document.form1.peso.value=="0" && document.form1.remesa[0].checked && sele=="10" ))
	{
		alert("No escribio peso");
		document.form1.peso.focus();
		return false;
	}
	else
	{
		if(document.form1.ubicacion.value=="0")
		{
			alert("No selecciono ubicacion");
			document.form1.ubicacion.focus();
			return false;
		}
		else
		{
			if(document.form1.traking.value=="")
			{
				alert("No capturo tracking number ");
				document.form1.traking.focus();
				return false;
			}else
			{
			if(document.form1.cobro.value=="")
			{
				alert("Cobro no puede ser vacio ");
				document.form1.cobro.focus();
				return false;
			}else
			{
				if( ( document.form1.palet.value=="" || document.form1.palet.value=="0")  && sele=="10" )
				{
					alert("No escribio numero de paquetes");
					document.form1.palet.focus();
					return false;
				}else
				{
			var x=document.getElementById('myTable').insertRow(0);
var y=x.insertCell(0);
var z=x.insertCell(1);
var z1=x.insertCell(2);
var z2=x.insertCell(3);
var z3=x.insertCell(4);
var z4=x.insertCell(5);
var z5=x.insertCell(6);

var m=document.getElementById('monto')
//var monto=m.innerHTML;

var peso=document.form1.peso.value;
var ubicacion=document.form1.ubicacion.value;
var cod=document.form1.cod.value;
var traking=document.form1.traking.value;
var costo=document.form1.cobro.value;
if(costo=="")
costo=0;
document.form1.cuantos.value=document.form1.cuantos.value*1+1;

var tipo=["SP-XCH","SP-C","SP-M", "SP-G", "SP-XG", "C-XCH","C-G", "C-CH","C-XG","C-M","PALLET","OTRO"];
 suma=costo*1+cod*1;
 suma=suma.toFixed(2);
x.id="p"+traking;
y.innerHTML="<center>"+document.form1.traking.value+"</center>";
z.innerHTML="<center>"+tipo[sele]+"</center>";
z.className="style5";
z1.innerHTML="<center>"+peso+"</center>";
z1.className="style5";
z2.innerHTML="<center>"+"$"+costo+"</center>";
z2.className="style5";
z3.innerHTML="<center>"+"$"+cod+"</center>";
z3.className="style5";
z4.innerHTML="<center>"+"$"+suma+"</center>";
z5.innerHTML="<input name=\"tipo_n[]\"  type=\"hidden\" value=\""+document.form1.tipo[sele].value+"\" /><input name=\"peso_n[]\"  type=\"hidden\" value=\""+peso+"\" /> <input name=\"ubicacion_n[]\"  type=\"hidden\" value=\""+ubicacion+"\" /><input name=\"cod_n[]\"  type=\"hidden\" value=\""+cod+"\" /><input name=\"costo_n[]\"  type=\"hidden\" value=\""+costo+"\" /><input name=\"traking_n[]\"  type=\"hidden\" value=\""+traking+"\" /><img src=\"images/close.gif\" alt=\"Eliminar \" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this)\"/>";
//document.form1.cantidad.value="1";
//document.form1.cantidad.focus();
document.form1.peso.value="0";
//document.form1.ubicacion.value="0";
document.form1.cod.value="0";
document.form1.traking.value="";
document.form1.cobro.value="0";


//for (i=0;i<document.form1.tipo.length;i++) {
//	document.form1.tipo[i].checked =false;

//}
calculaCosto(document.form1.tipo[sele]);
document.form1.traking.focus();
}
}
			}
		}
	}
}


}
function deleteRow(r)
{
var i=r.parentNode.parentNode.rowIndex;
document.getElementById('myTable').deleteRow(i);
document.form1.cuantos.value=document.form1.cuantos.value-1;
}
function ffletera()
{
	document.form1.fletera2.value="0";
}
function ffletera2()
{
	for(i=0 ; i<document.form1.fletera.length ; i++)
	{
		document.form1.fletera[i].checked=false

	}

}

function focus1(e){

	var key;
if(window.event) // IE
	{
	key = e.keyCode;
	}
else if(e.which) // Netscape/Firefox/Opera
	{
	key = e.which;
	}
	if(key == 13){

		document.form1.peso.focus();
		document.form1.peso.select();
	return false;
	}
}
function evita(e){

	var key;
if(window.event) // IE
	{
	key = e.keyCode;
	}
else if(e.which) // Netscape/Firefox/Opera
	{
	key = e.which;
	}
	if(key == 13){

		//document.form1.ubicacion.focus();
	return false;
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?

include "coneccion.php";
include "checar_sesion_admin.php";
date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'spanish');
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
$pmb= $_POST["pmb"];
$guardar= $_POST["guardar"];
if($guardar=="Guardar Entrada")
{

	$pmb= $_POST["pmb"];
	$plan= $_POST["plan"];
	$tabla1= $_POST["tabla1"];
	$tabla2= $_POST["tabla2"];
	$tabla3= $_POST["tabla3"];
	$tipo= $_POST["tipo"];
	$peso= $_POST["peso"];
	$remesa= $_POST["remesa"];
	$cod= $_POST["cod"];
	$from= $_POST["from"];
	$nombreT= $_POST["nombre"];
	$nombreA = explode('|', $nombreT);
	$nombre=$nombreA[0];
	$id_nombre=$nombreA[1];
	$email=$nombreA[2];
	$otro=$_POST['otro'];
	$costo=$_POST['cobro'];
	$palet=$_POST['palet'];
	$lp=$_POST['lp'];

	$tipo_n=$_POST['tipo_n'];
	$peso_n=$_POST['peso_n'];

	$ubicacion_n=$_POST['ubicacion'];

	$ubica = explode('|', $ubicacion_n);
	$ubicacion_n=$ubica[0];
	$nombre_ubicacion=$ubica[1];

	$cod_n=$_POST['cod_n'];
	$traking_n=$_POST['traking_n'];
	$duplicado=0;
	$costo_n=$_POST['costo_n'];
	if($palet=="")
		$palet=0;
	$next=$_POST['entrada'];
	if($tipo!=7)
	{
	if($pmb !=1){
		$consulta2  = "SELECT entrada FROM recepcion where pmb=$pmb and  id_cliente_recibe=$id_nombre  and  traking='".$_POST['traking']."' and fecha_recepcion=curdate()";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
		if(@mysql_num_rows($resultado2)>=1)
		{
			$res2=mysql_fetch_row($resultado2);
			$duplicado=1;
			echo"<script>alert(\"Tracking guardado anteriormente con entrada numero: $res2[0]\");</script>";
		}
	} else {
		$duplicado = 0;
	}
	}
	if($duplicado==0)
	{

		if($next=="")
		{


		///////////Obtiene el siguente numero de entrada y la incrementa
		if($pmb=="1")
		{
			$consulta2  = "SELECT next1 FROM entradas where id=1";
			$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
			if(@mysql_num_rows($resultado2)>=1)
			{
				$res2=mysql_fetch_row($resultado2);
				$next=$res2[0];
				$consulta3="update entradas set next1=next1+1 where id=1";
				$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			}
		}
		else
		{
			$consulta2  = "SELECT next FROM entradas where id=1";
			$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
			if(@mysql_num_rows($resultado2)>=1)
			{
				$res2=mysql_fetch_row($resultado2);
				$next=$res2[0];
				$consulta3="update entradas set next=next+1 where id=1";
				$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			}
		}
	}
	$consulta2  = "SELECT texto FROM banner where id=1";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
	if(@mysql_num_rows($resultado2)>=1)
	{
		$res2=mysql_fetch_row($resultado2);
		$banner=$res2[0];
	}
	$fecha=$_POST['fecha'];
	$fecha_temp=explode("/", $fecha);
	$fecha="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";

	$fletera=$_POST['fletera'];
	if($fletera=="")
		$fletera=$_POST['fletera2'];
		$consulta2  = "SELECT nombre FROM fleteras where id=".$fletera;
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
		if(@mysql_num_rows($resultado2)>=1)
		{
			$res2=mysql_fetch_row($resultado2);
			$mensajeria=$res2[0];
		}
		/*$consulta  = "SELECT id, nombre FROM ubicacion where  id=".$ubicacion_n;
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
		if(@mysql_num_rows($resultado)>=1)
		{
			$res=mysql_fetch_row($resultado);
			$nombre_ubicacion=$res[1];
		}*/
		$array=array("","SP-CH","SP-G","C-CH","C-M","C-G","C-XG", "Pallet","SP-XG","SP-M", "C-XCH","Otro");
		$tabla_re="";
		$extra=0;
		if($remesa=="0")///inserta la entrada cuando no es remesa
		{
			if($tipo=="7")
				$costo=0;
			$consulta3="insert into recepcion (pmb, id_cliente_recibe, nombre, tipo, fletera, peso, ubicacion, traking, costo, extra, id_empleado_recibe, fecha_recepcion, no_paquetes, id_remesa, cod, fromm, entrada, no_paquetes_resto, largo_plazo) values ($pmb, $id_nombre, '$nombre', '$tipo', '".$fletera."', '".$_POST['peso']."', '".$ubicacion_n."', '".$_POST['traking']."', $costo, $extra, $idU, '$fecha', $palet, $remesa, $cod, upper('$from'), $next, $palet, $lp)";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_recepcion=mysql_insert_id();

//////
if($tipo=="7" && $lp>0)
{
$consulta22  = "SELECT recepcion.largo_plazo, recepcion.pmb, clientes.razon_social, clientes.razon_social2, clientes.credito, recepcion.entrada FROM `recepcion` inner join clientes on recepcion.pmb=clientes.pmb where recepcion.id=$id_recepcion ";// and fecha_recepcion=now()+m and fecha_entrega is null
	//echo"$consulta";
	$resultado22 = mysql_query($consulta22) or die("La consulta fall&oacute;P11s $consulta22: ". mysql_error());

	$count22=1;
	while(@mysql_num_rows($resultado22)>=$count22)
	{
		$res22=mysql_fetch_row($resultado22);
		$costo_mes=$res22[0];
		$pmb_p=$res22[1];
		$razon=$res22[2];
		$razon2=$res22[3];
		$saldo_anterior=$res22[4];
		$entrada=$res22[5];
		$saldo_nuevo=$saldo_anterior+$costo_mes;
		$consulta33  = "SELECT nombre, app, apm from  c_recibir  where pmb = $pmb_p and tipo=1 order by id";
		$resultado33 = mysql_query($consulta33) or die("La consulta fall&oacute;P1.3:$consulta33 " . mysql_error());
		if(@mysql_num_rows($resultado33)>=1)
		{
			$res33=mysql_fetch_row($resultado33);
			$nombre3="$res33[0] $res33[1] $res33[2]";

		}
		if($razon!="")
			$facturar=$razon;
		else if($razon2!="")
			$facturar=$razon;
		if($nombre3!="")
			$facturar=$nombre3;

		$consulta44  = "insert into salidas (pmb, fecha, id_usuario, entrego, comentario, total_s, total_p, descuento, credito, total,tc, tipo, name, nuevo_saldo) values ('$pmb_p',now(), 1, 'Largo Plazo $entrada', 'Pago mensual de Pallet LP', $costo_mes, '0', '0', '1', '$costo_mes', 0, 0,'$facturar',$saldo_nuevo)";
		//echo"$consulta44";
		$resultado44 = mysql_query($consulta44) or die("La consulta fall&oacute;P1:$consulta44 " . mysql_error());
		$id_salida=  mysql_insert_id();
		$consulta44  = "insert into detalle_servicios(id_salida, id_servicio, precio, cantidad, pmb) values($id_salida, 19 , $costo_mes, 1, $pmb_p) ";
		//echo"$consulta44";
		$resultado44 = mysql_query($consulta44) or die("Error en operacion2:$consulta " . mysql_error());

		$consulta44  = "update clientes set credito=$saldo_nuevo  where pmb=$pmb_p ";
		//echo"$consulta44";
		$resultado44 = mysql_query($consulta44) or die("Error en operacion2:$consulta44 " . mysql_error());
		$count22++;
	}
}
/////

			$suma=$cod+$costo;
			$track=$_POST['traking'];
			$length = strlen($_POST['traking']);
			$length = $length-4;
			$track = substr($track , $length ,4);
			$track2 = substr($track , 0 ,4);
			$tabla_re=" $tabla_re <tr>
	  <td width=\"11%\"  class=\"style13\"><div align=\"center\">". date("d/m/Y")."</div></td>
	  <td width=\"12%\"  class=\"style13\"><div align=\"center\">".$next."</div></td>
	  <td width=\"22%\"  class=\"style13\"><div align=\"center\">".$from."</div></td>
	  <td width=\"11%\"  class=\"style13\"><div align=\"center\">".$mensajeria."</div></td>
	  <td width=\"26%\"  class=\"style13\"><div align=\"center\">$track2 ..$track</div></td>

	</tr>";
		}else
		{
			$fletera=$_POST['fletera'];
			if($fletera=="")
				$fletera=$_POST['fletera2'];
			if(sizeof($traking_n)>0)
			{
				$r=sizeof($traking_n);
				$count=0;
				$ubicacion_ns=$_POST['ubicacion_n'];
				foreach($traking_n as $a)
				{
					//echo"$ubicacion_n[$count]";
					if($tipo=="7")
						$costo_n[$count]=0;
					$ubica = explode('|', $ubicacion_ns[$count]);
					$ubicacion_n=$ubica[0];
					$nombre_ubicacion=$ubica[1];
					$consulta3="insert into recepcion (pmb, id_cliente_recibe, nombre, tipo, fletera, peso, ubicacion, traking, costo, extra, id_empleado_recibe, fecha_recepcion, no_paquetes, id_remesa, cod, fromm, entrada, no_paquetes_resto) values ('$pmb', $id_nombre, '$nombre', '".$tipo_n[$count]."', '".$fletera."', '".$peso_n[$count]."', '".$ubicacion_n."', '".$traking_n[$count]."', ".$costo_n[$count].", $extra, $idU, now(), $palet, $remesa, ".$cod_n[$count].", '$from', $next, $palet)";
					$resultado3 = mysql_query($consulta3) or die("Error en operacion2:  . $ubicacion_n[0] $ubicacion_n[1] $ubicacion_n[2] . $consulta3 " . mysql_error());
					$suma=$cod_n[$count]+$costo_n[$count];
					$length = strlen($traking_n[$count]);
					$length = $length-4;
					$track = substr($traking_n[$count] , $length ,4);
					$track2 = substr($traking_n[$count] , 0 ,4);
			$tabla_re=$tabla_re. "  <tr>
			 <td   class=\"style13\"><div align=\"center\">". date("d/m/Y")."</div></td>
	  <td   class=\"style13\"><div align=\"center\">".$next."</div></td>
	  <td   class=\"style13\"><div align=\"center\">".$from."</div></td>
	  <td   class=\"style13\"><div align=\"center\">".$mensajeria."</div></td>
	  <td   class=\"style13\"><div align=\"center\">$track2 ..$track</div></td>


	</tr>";
					$count++;
				}/* <td width=\"26%\"  class=\"style13\"><div align=\"center\">".$traking_n[$count]."</div></td>
	  <td width=\"22%\"  class=\"style13\"><div align=\"center\">".$array[$tipo_n[$count]]."</div></td>
	  <td width=\"12%\"  class=\"style13\"><div align=\"center\">".$peso_n[$count]."</div></td>
	  <td width=\"11%\"  class=\"style13\"><div align=\"center\">".$costo_n[$count]."</div></td>
	  <td width=\"11%\"  class=\"style13\"><div align=\"center\">".$cod_n[$count]."</div></td>
	  <td width=\"13%\"  class=\"style13\"><div align=\"center\">".$suma."</div></td>
	  <td width=\"5%\"  class=\"style13\">&nbsp;</td>*/
			}else
			{
				if($tipo=="7")
					$costo=0;
				$consulta3="insert into recepcion (pmb, id_cliente_recibe, nombre, tipo, fletera, peso, ubicacion, traking, costo, extra, id_empleado_recibe, fecha_recepcion, no_paquetes, id_remesa, cod, fromm, entrada) values ('$pmb', $id_nombre, '$nombre', '$tipo', '".$_POST['fletera']."', '".$_POST['peso']."', '".$_POST['ubicacion']."', '".$_POST['tracking']."', $costo, $extra, $idU, now(), $palet, $remesa, $cod, '$from', $next)";
				$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
				$suma=$cod+$costo;
				$length = strlen($traking_n);
				$length = $length-4;
				$track = substr($traking_n , $length ,4);
			$track2 = substr($traking_n , 0 ,4);
			$tabla_re=" $tabla_re <tr>
			<td   class=\"style13\"><div align=\"center\">". date("d/m/Y")."</div></td>
	  <td   class=\"style13\"><div align=\"center\">".$next."</div></td>
	  <td   class=\"style13\"><div align=\"center\">".$from."</div></td>
	  <td   class=\"style13\"><div align=\"center\">".$mensajeria."</div></td>
	  <td   class=\"style13\"><div align=\"center\">$track2 ..$track</div></td>



	</tr>";/*  <td width=\"26%\"  class=\"style13\"><div align=\"center\">".$_POST['traking']."</div></td>
	  <td width=\"22%\"  class=\"style13\"><div align=\"center\">".$array[$tipo]."</div></td>
	  <td width=\"12%\"  class=\"style13\"><div align=\"center\">".$_POST['peso']."</div></td>
	  <td width=\"11%\"  class=\"style13\"><div align=\"center\">".$costo."</div></td>
	  <td width=\"11%\"  class=\"style13\"><div align=\"center\">".$cod."</div></td>*/
			}

		}
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
    <td width=\"90\"><img src=\"http://www.maspostwarehouseusers.com/images/header_email.jpg\"  height=\"55\"></td>
    <td width=\"510\"><span class=\"style1\"></span> </td>
  </tr>
  <tr>
    <td colspan=\"2\"><p>Estimado $nombre</p>
    <p>Hemos recibido un envio de: $from </p>

	<table width=\"90%\" border=\"0\" cellpadding=\"0\" >
	<tr>
	  <td width=\"11%\" bgcolor=\"#CCCCCC\" class=\"style13\"><div align=\"center\">Fecha</div></td>
	  <td width=\"12%\" bgcolor=\"#CCCCCC\" class=\"style13\"><div align=\"center\">Entrada</div></td>
	  <td width=\"26%\" bgcolor=\"#CCCCCC\" class=\"style13\"><div align=\"center\">De</div></td>
	  <td width=\"11%\" bgcolor=\"#CCCCCC\" class=\"style13\"><div align=\"center\">Fletera</div></td>
	  <td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style13\"><div align=\"center\">Tracking</div></td>

	</tr>
	".$tabla_re."
  </table>
    ";

   $Body .= "

   <p>$banner</p>
   <p>.</p>
    <p>Esta es una notificacion automatica por favor no contestar.</p>
    <p>Para dudas o comentarios escribir a info@maspostwarehouse.com<br>
      <br>
    </p></td>
  </tr>
</table>";//<p>Para mayores detalles sobre su paquete accesar http://www.maspostwarehouseusers.com en apartado de postales con tu usuario y password.</p>

				$Body .= "</body>";
				$Body .= "</html>";
				/*if($email!="")
				$success = mail($email, $Subject, $Body, "From: maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");*/

				$pmb="";
				if($email!="")
				$success = mail($email, $Subject, $Body, "From: Maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
	echo"<script>alert(\"Paquete guardado con numero: $next\");</script>";
	///////if()
	////como insertar los siguientes de remesa y cobrar por el primero y subsecuentes

}

		}


$today = date("m/d/Y");
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

          <table width="979" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="8" bgcolor="#313630" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>

              <tr class="">
                <td width="146" bgcolor="#CCCCCC"  ><span class="verde">PMB</span></td>
                <td colspan="2" bgcolor="#CCCCCC"><p class="style5">
                  <input name="pmb" type="text" class="texto_verde" id="pmb" size="10" maxlength="10" onKeyPress="return maskKeyPress88(event)" onChange="buscar();" required/>
                  <input name="Buscar" type="button" class="barra-menu" id="Buscar" onClick="buscar();" value="buscar">
                  <br>
                  <input name="nombrec" type="text" id="nombrec" size="25" maxlength="100" onKeyPress="return maskKeyPress99(event)"/>
                  <input name="buscarNombre" type="button" class="barra-menu" id="buscarNombre" onClick="javascript:window.location='buscarNombreR.php?nombre='+document.form1.nombrec.value" value="Buscar por Nombre"/>
                </p>                </td>
                <td colspan="5" bgcolor="#CCCCCC"><div id="myDiv"><br>
                </div></td>
              </tr>
			  <tr class="">
			    <td  bgcolor="#D8D8D8" class="verde" >&nbsp;</td>
			    <td colspan="2" bgcolor="#D8D8D8"><span class="style5">Entrada
                    <input name="entrada" type="text" class="texto_verde" id="entrada" size="10" maxlength="10"  />
                </span></td>
		        <td colspan="5" bgcolor="#D8D8D8">Fecha<span class="style5">
		          <input name="fecha" type="text" class="texto_verde" id="fecha" value="<?echo"$today";?>" size="20" maxlength="10"  placeholder="mm/dd/aaaa"/>
		        mm/dd/aaaa</span></td>
	          </tr>
			  <tr class="">
                <td  bgcolor="#D8D8D8" class="verde" >Fletera</td>
                <td colspan="7" bgcolor="#D8D8D8">
				<table  border="0">
  <tr>
				<?
	$consulta  = "select fleteras.id, fleteras.nombre, logo from fleteras  where logo<>''  order by nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);

		$cadena="";
		$consulta2  = "select count(fletera) from  recepcion  where recepcion.fecha_recepcion=CURDATE() and fletera=$res[0]  ";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());

		if(@mysql_num_rows($resultado2)>=1)
		{
			$res2=mysql_fetch_row($resultado2);
		}
		?>
             <td width="36"> <input name="fletera" type="radio" value="<? echo $res[0];?>" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="ffletera();"></td><td width="78"><img src="images/fleteras/<? echo $res[2];?>" width="32" >(<? echo $res2[0];?>)</td>
<?
		   $count=$count+1;
		}

	?>
  </tr>
</table>
<span >
<select name="fletera2"  id="fletera2"  onChange="ffletera2();">
  <option value="0">--Selecciona Fletera--</option>
  <?
	$consulta  = "select * from fleteras where logo='' order by nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		//if($res[2]==$res[0])
		//echo"<option value=\"$res[0]\" selected>$res[1]</option>";
		//else
		echo"<option value=\"$res[0]\" >$res[1]</option>";
		$count=$count+1;
	}

		?>
</select>
	</span></td>
              </tr>
              <tr class="">
                <td bgcolor="#CCCCCC"
				 ><span class="verde">From </span></td>
                <td bgcolor="#CCCCCC"><span class="style5">
                  <input name="from" type="text" class="texto_verde" id="from" size="45" maxlength="100" required/>
                </span></td>
                <td bgcolor="#CCCCCC">&nbsp;</td>
                <td bgcolor="#CCCCCC" class="verde"><div align="right"><span class="verde">Remesa </span></div></td>
                <td width="28" bgcolor="#CCCCCC" class="verde"><div align="right"><span class="style5"> Si               </span></div></td>
                <td width="39" bgcolor="#CCCCCC" class="verde"><span class="style5">
                  <input name="remesa" type="radio" value="1" <? if($res[12]=="1") echo"checked";?> onChange="showRemesa()" style="width:30px; height:30px;font-size:150%;border-width:4px;">
                </span></td>
                <td width="20" bgcolor="#CCCCCC" class="verde"><span class="style5">&nbsp;No</span></td>
                <td bgcolor="#CCCCCC" class="verde"><span class="style5">
                  <input name="remesa" type="radio" value="0" checked <? if($res[12]=="0") echo"checked";?> onChange="hideRemesa();" style="width:30px; height:30px;font-size:150%;border-width:4px;">
                </span></td>
              </tr>

              <tr class="">
                <td colspan="8" bgcolor="#E8E8E8" class="text-primary" ><table width="103%" border="0">
                  <tr>
                    <td width="18%" bgcolor="#FFFFFF" class="verde"><div align="center">
                      <h5>SOBRE</h5>
                    </div></td>
                    <td width="42%" bgcolor="#FFFFFF" class="verde"><div align="center">
                      <h5>CAJA</h5>
                    </div></td>
                    <td width="20%" bgcolor="#FFFFFF" class="verde"><div align="center">
                      <h5>PALLET</h5>
                    </div></td>
                    <td width="20%" bgcolor="#FFFFFF" class="verde"><div align="center" class="verde">
                      <h5>OTRO</h5>
                    </div></td>
                  </tr>
                  <tr>
                    <td valign="top"><div align="center">
                      <div align="center">
					  <table width="148" border="0" align="center">
                        <tr>
                          <td class="verde"><div align="center"><span class="verde">SP-XCH</span></div></td>
                          <td><span class="style5">
                            <input name="tipo" type="radio" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)" value="12">
                            <span class="style15">1oz - 2oz                            </span></span></td>
                        </tr>
                        <tr>
                          <td class="verde"><div align="center"><span class="verde">SP-CH</span></div></td>
                          <td><div align="left"><span class="style5">
                              <input name="tipo" type="radio" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)" value="1">
                          </span><span class="style17">3oz -5 oz</span> </div></td>
                        </tr>
                        <tr>
                          <td class="verde"><div align="center"><span class="verde">SP-M</span></div></td>
                          <td><div align="left"><span class="style5">
                              <input name="tipo" type="radio" value="9" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                          </span><span class="style17">6oz - 1.5 lbs</span> </div></td>
                        </tr>
                        <tr>
                          <td class="verde"><div align="center"><span class="verde">SP-G</span></div></td>
                          <td><input name="tipo" type="radio" value="2" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                            <span class="style17">1.6lbs -3 lbs</span> </td>
                        </tr>
                        <tr>
                          <td class="verde"><div align="center"><span class="verde">SP-XG</span></div></td>
                          <td><span class="style5">
                            <input name="tipo" type="radio" value="8" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                            <span class="style15">3.1lbs-10 lbs </span></span></td>
                        </tr>
                      </table>
					  </div>                      </td>
                    <td valign="top"><div align="center">

                      <table width="327" border="0">
                        <tr>
                          <td class="verde"><div align="right"><span class="verde">C-XCH</span></div></td>
                          <td>
                            <div align="left">
                              <input name="tipo" type="radio" value="10" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                            </div></td>
                          <td class="style5">1 lbs </td>
                          <td class="verde"><div align="right"><span class="verde">C-G</span></div></td>
                          <td><div align="right"><span class="style5">
                            <input name="tipo" type="radio" value="5" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                          </span></div></td>
                          <td class="style5"><span class="style5">25-50 lbs </span></td>
                        </tr>
                        <tr>
                          <td class="verde"><div align="right"><span class="verde">C-CH</span></div></td>
                          <td><div align="left"><span class="style5">
                            <input name="tipo" type="radio" value="3" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                          </span></div></td>
                          <td class="style5">2-4 lbs </td>
                          <td class="verde"><div align="right"><span class="verde">C-XG</span></div></td>
                          <td><div align="right"><span class="style5">
                            <input name="tipo" type="radio" value="6" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this);">
                          </span></div></td>
                          <td class="style5"><span class="style5">51-80 lbs </span></td>
                        </tr>
                        <tr>
                          <td class="verde"><div align="right"><span class="verde">C-M</span></div></td>
                          <td><div align="left"><span class="style5">
                            <input name="tipo" type="radio" value="4" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                          </span></div></td>
                          <td class="style5">5-24 lbs </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>

                    </div></td>
                    <td valign="top"><div align="center">
                      <table width="100" border="0">
                        <tr>
                          <td><div align="right"><span class="verde">PALLET</span></div></td>
                          <td>
                            <div align="left">
                              <input name="tipo" type="radio" value="7" style="width:30px; height:30px;font-size:150%;border-width:4px;" >
                            </div></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><span class="style5">
                            <input name="palet" type="text" class="texto_verde" id="palet" size="10" maxlength="10"  placeholder="# pkgs" onKeyPress=" return evita(event);"/>
                          </span></td>
                        </tr>
                      </table>
                      </div></td>
                    <td valign="top"><table width="100" border="0" align="center">
                      <tr>
                        <td><div align="right"><span class="verde">OTRO</span></div></td>
                        <td><div align="left">
                            <input name="tipo" type="radio" value="11" style="width:30px; height:30px;font-size:150%;border-width:4px;" onClick="calculaCosto(this)">
                        </div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><span class="style5">
                          <input name="palet2" type="text" class="texto_verde" id="palet2" size="10" maxlength="10"  placeholder="# pkgs" onKeyPress=" return evita(event);"/>
                        </span></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr bgcolor="#D8D8D8">
                <td bgcolor="#D8D8D8" class="verde"  >Traking Number </td>
                <td width="231" bgcolor="#D8D8D8"><span class="style5">
                  <input name="traking" type="text" class="texto_verde" id="traking" size="45" maxlength="50" onKeyPress=" return focus1(event);"/>
                </span></td>
                <td width="177" bgcolor="#D8D8D8" class="verde"><div align="right"><span class="verde">C.O.D.</span></div></td>
                <td width="148" bgcolor="#D8D8D8"><span class="style5">
                  <input name="cod" type="text" class="texto_verde" id="cod" value="0" size="10" maxlength="10"  onKeyPress=" return evita(event);"/>
                </span></td>
                <td colspan="3" bgcolor="#D8D8D8"><span class="verde">Peso</span></td>
                <td width="154" bgcolor="#D8D8D8"><span class="style5">
                  <input name="peso" type="text" class="texto_verde" id="peso" value="0" size="10" maxlength="10" onChange="calculaCosto(document.form1.tipo)" onKeyPress=" return evita(event);"/>
                  <input name="cuantos" type="hidden" id="cuantos" value="0">
                </span></td>
              </tr>
              <tr bgcolor="#E8E8E8">
                <td bgcolor="#E8E8E8" class="verde" >Ubicacion</td>
                <td bgcolor="#E8E8E8"><span >
                  <select name="ubicacion" class="texto_verde" id="ubicacion">
                    <option value="0">--Selecciona Ubicacion--</option>
                    <?




	$consulta  = "SELECT id, nombre, descripcion FROM ubicacion   ORDER BY nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		//if($res[2]==$res[0])
		//echo"<option value=\"$res[0]\" selected>$res[1]</option>";
		//else
		echo"<option value=\"$res[0]|$res[1]\" >$res[1] ($res[2])</option>";
		$count=$count+1;
	}

		?>
                  </select>
                </span></td>
                <td bgcolor="#E8E8E8" class="verde"><div align="right"><span class="verde">Cobro</span></div></td>
                <td bgcolor="#E8E8E8"><span class="style5">
                  $
                  <input name="cobro" type="text" class="texto_verde" id="cobro" value="0" size="10" maxlength="10" onKeyPress=" return evita(event);"/>
                </span></td>
                <td colspan="3" bgcolor="#E8E8E8"><span class="verde">Largo Plazo </span></td>
                <td bgcolor="#E8E8E8"><span class="style5">
                  <input name="agregar" type="button" id="agregar" value="Agregar" onClick="insRow()" style="display:none">
                $
                  <input name="lp" type="text" class="texto_verde" id="lp" value="0" size="10" maxlength="10" onKeyPress=" return evita(event);"/>
</span></td>
              </tr>
              <tr bgcolor="#D8D8D8">
                <td colspan="8" class="text-primary" id="myRemesa" style="display:none">
				<table width="90%" border="0" cellpadding="0" >
                    <tr>
                      <td width="26%" bgcolor="#CCCCCC" class="h5"><div align="center" class="style11">Tracking</div></td>
                      <td width="22%" bgcolor="#CCCCCC" class="h5"><div align="center" class="style11">Tipo</div></td>
                      <td width="12%" bgcolor="#CCCCCC" class="h5"><div align="center" class="style11">Peso</div></td>
                      <td width="11%" bgcolor="#CCCCCC" class="h5"><div align="center" class="style11">Costo</div></td>
                      <td width="11%" bgcolor="#CCCCCC" class="h5"><div align="center" class="style11">C.O.D.</div></td>
                      <td width="13%" bgcolor="#CCCCCC" class="h5"><div align="center" class="style11">Subtotal</div></td>
                      <td width="5%" bgcolor="#CCCCCC" class="style13">&nbsp;</td>
                    </tr>
                  </table>
                    <table width="90%" border="0" cellpadding="0" id="myTable">
                    <tr>
                      <td width="27%" class="style5"><div align="center"></div></td>
                      <td width="22%">&nbsp;</td>
                      <td width="12%" class="style5">&nbsp;</td>
                      <td width="11%" class="style5">&nbsp;</td>
                      <td width="11%" class="style5">&nbsp;</td>
                      <td width="13%"><div align="center"></div></td>
                      <td width="4%">&nbsp;</td>
                    </tr>
                  </table>				</td>
              </tr>

              <tr class="">
                <td class="btn-link">&nbsp;</td>
                <td colspan="7"><span class="style5">
                  <input name="guardar" type="submit" class="h2" id="guardar" onClick="return valida();" value="Guardar Entrada">
                </span></td>
              </tr>
              <tr class="">
                <td class="btn-link">&nbsp;</td>
                <td colspan="7">&nbsp;</td>
              </tr>
              <tr class="">
                <td class="btn-link"><iframe src="sesionActiva.php" width="100" height="25" scrolling="no"></iframe></td>
                <td colspan="7"><table width="100%" border="0" bgcolor="#CCCCCC">
                  <tr>
                    <td width="17%" rowspan="2" bgcolor="#D8D8D8"><div align="center"><span class="h5">Ultima Captura </span></div></td>
                    <td width="22%" bgcolor="#D8D8D8" class="h5"><div align="center" class="style11">Entrada</div></td>
                    <td width="17%" bgcolor="#D8D8D8" class="h5"><div align="center" class="style11">Tipo</div></td>
                    <td width="19%" bgcolor="#D8D8D8" class="h5"><div align="center" class="style11">Cobro</div></td>
                    <td width="25%" bgcolor="#D8D8D8" class="h5"><div align="center" class="style11">Ubicación</div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#E8E8E8"><div align="center"><? echo"$next";?></div></td>
                    <td bgcolor="#E8E8E8"><div align="center"><? echo"$array[$tipo]";?></div></td>
                    <td bgcolor="#E8E8E8"><div align="center">$<? echo"$costo";?></div></td>
                    <td bgcolor="#E8E8E8"><div align="center"><? echo"$ubica[1]";?></div></td>
                  </tr>
                </table></td>
              </tr>
            </tbody>
          </table>
		   <p>&nbsp;</p>
		   <p>&nbsp;</p>
            </form>
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
	<script>
	<?
if($pmb!="")
echo" document.form1.pmb.value=$pmb; buscar();";
?>
</script>
<script>setTimeout(function() { document.form1.pmb.focus(); }, 10);</script>
  </body>
</html>
