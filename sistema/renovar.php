<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Renovación</title>
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



        <style type="text/css">
<!--
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
.style8 {color: #FFFFFF; font-weight: bold; }
.style13 {color: #000000}
.style14 {color: #FFFFFF}
-->
        </style>

		<script>

function validar() {
	if(!document.form1.pago[0].checked && !document.form1.pago[1].checked && !document.form1.pago[2].checked && !document.form1.pago[3].checked && !document.form1.pago[4].checked&& !document.form1.pago[5].checked   )
	{
		alert("Seleccione Tipo de pago");
		document.form1.pago[0].focus();
		return false;
	}else
	{
		if((document.form1.pago[0].checked || document.form1.pago[1].checked  ) && document.form1.anio.value==0 )
		{
			alert("Seleccione Año de pago ");
			document.form1.anio.focus();
			return false;
		}else
		{
			if((document.form1.pago[2].checked ) && (document.form1.mes.value==0 || document.form1.annio.value==0))
			{
				alert("Seleccione Mes y Año de pago bodega");
				document.form1.mes.focus();
				return false;
			}else
			{
				if((document.form1.pago[3].checked ) && document.form1.anio_s.value==0)
				{
					alert("Seleccione Año de pago Anualidad Secundario");
					document.form1.anio.focus();
					return false;
				}else
				{
					if((document.form1.pago[4].checked ) && (document.form1.mes_o.value==0 || document.form1.anio_o.value=="0"))
					{
						alert("Seelccione Mes y Año de Pago de Oficina");
						document.form1.mes_o.focus();
						return false;
					}else
					{
						if(document.form1.credito.value==0)
						{
							alert("Seleccione tipo de pago");
							document.form1.credito.focus();
							return false;
						}else
						{
							if((document.form1.pago[5].checked ) && (document.form1.mes_m.value==0 || document.form1.anio_m.value=="0"|| document.form1.dia_m.value=="0"))
							{
								alert("Seelccione Dia, Mes y Año de Pago de Parcial");
								document.form1.dia_m.focus();
								return false;
							}
						}

					}
				}
			}
		}


	}
}
</script>
</head>
<?

include "coneccion.php";
include "checar_sesion_admin.php";
date_default_timezone_set("America/Chihuahua");
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
$pmb=$_GET['pmb'];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
if($_POST['guardar']=="Aplicar"){
	$pmb=$_POST['pmb'];
	$tc_monto= $_POST["tc_monto"];
	if($tc_monto=="")
			$tc_monto=0;
			$pago=$_POST['pago'];

if(sizeof($pago)>0){
	$consultaFactura  = "insert into facturas_renovacion (pmb, fecha,  name, credito, tc_cargo) values ('".$pmb."', now(),'".$_POST['factura']."', ".$_POST['credito'].", $tc_monto)";
		$factura = mysql_query($consultaFactura) or die("Error en operacion1:  $factura" . mysql_error());

						$factura_id=  mysql_insert_id();
	$consulta  = "select date_format(vigencia, '%m/%d/%Y'), credito from clientes where pmb=$pmb";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>0){
		$res=mysql_fetch_row($resultado);
		$vigencia_a=$res[0];
		$saldo=$res[1];
	}
foreach($pago as $na) {

		if($na=="1") {
			$monto=$_POST['uno']; //mensualidad espacio bodega
			$por_mes=$_POST['por_mes'];
			for($i=0; $i<$por_mes; $i++) {
					$mes=$_POST['mes']+$i;
					if($mes>12) {
						$mes=1;
						$an=$_POST['annio']+1;
					} else
						$an=$_POST['annio'];
						$consulta3="insert into pagos (monto, id_usuario, mes, anio, tipo,factura_id, pmb, fecha,credito,saldo) values ('".$monto."', ".$idU.", '".$mes."', '".$an."', 1,".$factura_id.", '$pmb', now(), ".$_POST['credito'].", ".$saldo.");";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
						$id_pago=  mysql_insert_id();
						$tc_monto=0;
					if($_POST['credito']==1){
						$consulta3="update clientes set credito=credito+$monto where pmb=$pmb";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
						$saldo=$saldo+$monto;
						$consulta3="update pagos set saldo=$saldo where id=$id_pago";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
					}

			}
			//$consulta3="update  clientes set ultimo='".$mes." ".$_POST['anio']."', monto='".$monto."', u_mes=".$_POST['mes'].", u_anio=".$_POST['anio']." where id=$id";
			//$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		}

		if($na=="2"){ // anualidad de secundarios
			$monto=$_POST['dos'];
			$consulta3="insert into pagos (monto, id_usuario, mes, anio, tipo,factura_id, pmb, fecha,credito) values ('".$monto."', ".$idU.",  '0', '".$_POST['anio_s']."', 3,".$factura_id.", '$pmb', now(), ".$_POST['credito'].")";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_pago=  mysql_insert_id();
			//$consulta3="update  clientes set vigencia=DATE_ADD(vigencia,INTERVAL 1 YEAR) where pmb=$pmb";
			//$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$tc_monto=0;
		}
		if($na=="3") {//mensualidad oficina
			$monto=$_POST['tres'];
			$por_mes=$_POST['por_mes_o'];
			
			for($i=0; $i<$por_mes; $i++){
					$mes=$_POST['mes_o']+$i;
					if($mes>12) {
						$mes=1;
						$an=$_POST['anio_o']+1;
					} else
						$an=$_POST['anio_o'];
						//$an=$_POST['anio_o'];
						$consulta3="insert into pagos (monto, id_usuario, mes, anio, tipo,factura_id, pmb, fecha,credito, saldo) values ('".$monto."', ".$idU.", '".$mes."', '".$an."', 4,".$factura_id.", '$pmb', now(), ".$_POST['credito'].", ".$saldo.")";
							$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
							$id_pago=  mysql_insert_id();
						if($_POST['credito']==1){
						$consulta3="update clientes set credito=credito+$monto where pmb=$pmb";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
						$saldo=$saldo+$monto;
						$consulta3="update pagos set saldo=$saldo where id=$id_pago";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
					}
					$tc_monto=0;
			}
			//$consulta3="update  clientes set ultimo='".$mes." ".$mes."', monto='".$monto."', u_mes=$mes, u_anio=$an where pmb=$pmb";
			//$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		}

		if($na=="4"){//anualidad
			$monto=$_POST['cuatro'];
			
			$consulta3="update  clientes set vigencia=DATE_ADD(vigencia,INTERVAL 1 YEAR) where pmb=$pmb";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			
			$consulta  = "select date_format(vigencia, '%m/%d/%Y') from clientes where pmb=$pmb";
			$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
			if(@mysql_num_rows($resultado)>0){
				$res=mysql_fetch_row($resultado);
				$vigencia_n=$res[0];// obtiene nuev avigencia
			}
			$consulta3="insert into pagos (monto, id_usuario, mes, anio, tipo,factura_id, rango, pmb, fecha,credito, saldo) values ('".$monto."', ".$idU.",  '0', '".$_POST['anio']."', 2,".$factura_id.", '$vigencia_a - $vigencia_n','$pmb', now(), ".$_POST['credito'].", ".$saldo.")";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_pago=  mysql_insert_id();
			if($_POST['credito']==1){
						$consulta3="update clientes set credito=credito+$monto where pmb=$pmb";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
						$saldo=$saldo+$monto;
						$consulta3="update pagos set saldo=$saldo where id=$id_pago";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
					}
			$tc_monto=0;
		}
		if($na=="5"){//semestre

			$monto=$_POST['cinco'];
			
			$consulta3="update  clientes set vigencia=DATE_ADD(vigencia,INTERVAL 6 MONTH) where pmb=$pmb";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			
			$consulta  = "select date_format(vigencia, '%m/%d/%Y') from clientes where pmb=$pmb";
			$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
			if(@mysql_num_rows($resultado)>0){
				$res=mysql_fetch_row($resultado);
				$vigencia_n=$res[0];// obtiene nuev avigencia
			}
			$consulta3="insert into pagos (monto, id_usuario, mes, anio, tipo,factura_id, rango, pmb, fecha,credito,saldo) values ('".$monto."', ".$idU.",  '0', '".$_POST['anio']."', 5,".$factura_id.", '$vigencia_a - $vigencia_n', '$pmb', now(), ".$_POST['credito'].", ".$saldo.")";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_pago=  mysql_insert_id();
			if($_POST['credito']==1){
						$consulta3="update clientes set credito=credito+$monto where pmb=$pmb";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
						$saldo=$saldo+$monto;
						$consulta3="update pagos set saldo=$saldo where id=$id_pago";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
					}
			$tc_monto=0;
		}
		if($na=="6"){//renovacion parcial

			$monto=$_POST['seis'];
			$dia_m=$_POST['dia_m'];
			$mes_m=$_POST['mes_m'];
			$anio_m=$_POST['anio_m'];
			
			$consulta3="update  clientes set vigencia='$anio_m-$mes_m-$dia_m' where pmb=$pmb";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			
			$consulta  = "select date_format(vigencia, '%m/%d/%Y') from clientes where pmb=$pmb";
			$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
			if(@mysql_num_rows($resultado)>0){
				$res=mysql_fetch_row($resultado);
				$vigencia_n=$res[0];// obtiene nuev avigencia
			}
			$consulta3="insert into pagos (monto, id_usuario, mes, anio, tipo,factura_id, rango, pmb, fecha,credito, saldo) values ('".$monto."', ".$idU.",  '0', '".$_POST['anio_m']."', 6,".$factura_id.", '$vigencia_a - $vigencia_n', '$pmb', now(), ".$_POST['credito'].", ".$saldo.")";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_pago=  mysql_insert_id();
			if($_POST['credito']==1){
						$consulta3="update clientes set credito=credito+$monto where pmb=$pmb";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
						$saldo=$saldo+$monto;
						$consulta3="update pagos set saldo=$saldo where id=$id_pago";
						$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			}
		}

		$parametros="id=".$factura_id;
	}//ends foreach
}



		echo"<script>alert(\"Pago Aplicado\");</script>";
		echo"<script>window.open(\"imprimir_pago_t.php?$parametros\", \"Cobro\"); </script>";
		/*echo"<script>window.open=window.open (\"imprimir_pago.php?id=$id_pago\",\"mywindow\");</script>";*/
		/*echo"<script>window.location=\"socios.php\"</script>";*/

}

if($_POST['borrar']!=""){
		$consulta  = "select facturas_renovacion.credito, facturas_renovacion.pmb, sum(monto) from facturas_renovacion inner join pagos on facturas_renovacion.id=pagos.factura_id where facturas_renovacion.id=".$_POST['borrar'];
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
		if(@mysql_num_rows($resultado)>0){
			$res=mysql_fetch_row($resultado);
			$credito_t=$res[0];
			$pmb_b=$res[1];
			$monto_b=$res[2];
			if($credito_t=="1")
			{
				$consulta3="update clientes set credito=credito-$monto_b where pmb=$pmb_b";
				$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			}
		}
		$consulta3="update facturas_renovacion set void=1 where id=".$_POST['borrar'];
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		$consulta4="update pagos set monto=0 where factura_id=".$_POST['borrar'];
		$resultado3 = mysql_query($consulta4) or die("Error en operacion1:  $consulta3" . mysql_error());
}
}//fin post method

/*$getVigencia = 'SELECT (case when concat_ws("/",(DATE_FORMAT(clientes.fecha_registro,"%m/%d")),(pagos.anio+1)) then concat_ws("/",(DATE_FORMAT(clientes.fecha_registro,"%m/%d")),(pagos.anio+1)) else clientes.fecha_registro end) as vigencia  FROM facturas_renovacion join clientes on facturas_renovacion.pmb = clientes.pmb join pagos on facturas_renovacion.id = pagos.factura_id WHERE facturas_renovacion.pmb = '.$pmb.' and pagos.tipo in (4,2) and void = 0 order by anio desc limit 1;';
$resultadoVigencia = mysql_query($getVigencia) or die("La consulta fall&oacute;P1:$getVigencia " . mysql_error());
		if(@mysql_num_rows($resultadoVigencia)>=1){
			$vigenciaRes=mysql_fetch_row($resultadoVigencia);
			$vigencia = $vigenciaRes[0];
			} else {
				$vigencia ='';
			}*/
			//echo $vigencia;
//consulta plan, vigencia
$consulta  = "SELECT date_format(vigencia, '%m/%d/%Y') , c_recibir.nombre, c_recibir.app, c_recibir.apm, clientes.credito, planes.nombre, clientes.comentarios, planes.costo_anual, planes.costo_mensual, planes.costo_anual_adicional, date_format(clientes.fecha_registro, '%m/%d/%Y'), no_usuarios, reempaque FROM `clientes` inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and c_recibir.activo=1 and clientes.pmb=$pmb";

$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
		if(@mysql_num_rows($resultado)>=1){
			$res2=mysql_fetch_row($resultado);
			//$costo_almacen=$res2[1];
			$titular="$res2[1] $res2[2] $res2[3]";
			/*if($vigencia == ''){
			$vigencia=$res2[10];
			}else*/ 
			$vigencia=$res2[0];
			$saldo=$res2[4];
			$comentario=$res2[6];
			$plan=$res2[5];
			$costo_anual=$res2[7];
			$costo_anual_adicional=$res2[9];
			$costo_mensual=$res2[8];
			$reempaque=$res2[12];
			$fecha_registro=$res2[10];
			$no_usuarios=$res2[11];

		}
	$cuantos_adicionales=0;
	//Contar usuarios adicionales
	$consulta  = "select count(id) from c_recibir where pmb=$pmb and tipo=2 and activo=1";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>0){
		$res=mysql_fetch_row($resultado);
		$cuantos_adicionales=$res[0];
	}
	//calcula si hay adicionales que cobrar
	if($no_usuarios>0){
		$adicionales_cobrar=$cuantos_adicionales;
	} else{
		$adicionales_cobrar=0;
	}

	//busca pagos mensuales si aplica para este plan
	if($costo_mensual>0){

		$consulta2  = "select mes, anio from pagos join facturas_renovacion on pagos.factura_id = facturas_renovacion.id where facturas_renovacion.pmb=$pmb and tipo=1 order by anio, mes desc";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
		if(@mysql_num_rows($resultado2)>0){
			$res2=mysql_fetch_row($resultado2);
			$ultimo_mes=$res2[0];
			$ultimo_anio_mensual=$res2[1];
		} else {
			$ultimo_mes="";
			$ultimo_anio_mensual="";
		}
	}
	//busca pagos mensuales si aplica para este plan espacio en bodega
	if($costo_mensual>0){
		$consulta2  = "select mes, anio from pagos join facturas_renovacion on pagos.factura_id = facturas_renovacion.id where facturas_renovacion.pmb=$pmb and tipo=4 order by anio, mes desc";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
		if(@mysql_num_rows($resultado2)>0){
			$res2=mysql_fetch_row($resultado2);
			$ultimo_mes_o=$res2[0];
			$ultimo_anio_mensual_o=$res2[1];
		} else {
			$ultimo_mes_o='';
			$ultimo_anio_mensual_o='';
		}
	}
	$actual_anio=date("Y");
			//busca pagos anuales si aplican pata este plan
			if($costo_anual>0){
				echo "<script>console.log(\"Pagos Anuales\");</script>";
						$consulta2  = "select anio from pagos join facturas_renovacion on pagos.factura_id = facturas_renovacion.id where facturas_renovacion.pmb=$pmb and tipo=2 and void=0"; // no detecta los pagos de anualidad al hacer el inner join con la de facturas, quiza no todos tiene factura
						//$consulta2  = "select anio from pagos  where pmb=$pmb and tipo=2 and void=0";
						$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
						if(@mysql_num_rows($resultado2)>0){
							$res2=mysql_fetch_row($resultado2);
							$ultimo_anio_anual=$res2[0];
							echo "<script>console.log(\"ultimo anio anual\", $ultimo_anio_anual);</script>";
							if($actual_anio<=$ultimo_anio_anual)
								$inscripcion=1;
							else {
								$inscripcion=0;
								echo"<script>alert(\"Pendiente pago de Anualidad\");</script>";
							echo "<script>console.log(\"ultimo anio anual\", $ultimo_anio_anual);</script>";
							}
						} else {
							$inscripcion=0;
							$ultimo_anio_anual="";
							echo"<script>alert(\"Pendiente pago de Anualidad\");</script>";
						}
			}
	//busca pagos anuales por secundarios si aplica
	if($adicionales_cobrar>0){
		$consulta2  = "select anio from pagos join facturas_renovacion on pagos.factura_id = facturas_renovacion.id where facturas_renovacion.pmb=$pmb and tipo=3 and void=0";
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
		if(@mysql_num_rows($resultado2)>0){
			$res2=mysql_fetch_row($resultado2);
			$ultimo_anio_secundario=$res2[0];
			$inscripcion2=1;

		} else {
			$inscripcion2=0;
						$ultimo_anio_secundario='';
			/*echo"<script>alert(\"Pendiente pago de Anualidad\");</script>";*/
		}
	}

?>
<script>
function borrar(id)
{
  if(confirm("Esta seguro de hacer VOID este Pago?"))
  {
       document.form1.borrar.value=id;
	   document.form1.submit();
   }
}
</script>
  <body><!-- /. main-header -->
  <!-- /. barra-menu -->
<section class="tipos-textos">
      <h2> Pagos - Renovaciones </h2>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post"  name="form1">
              <table width="717" align="center" cellpadding="1" cellspacing="2" class="">
                <tr class="">
                  <td colspan="4" bgcolor="#313630"><span class="style8">INFORMACIÓN</span></td>
                </tr>
                <tr class="">
                  <td width="210" bgcolor="#CCCCCC" class="verde">Factura a nombre de  </td>
                  <td colspan="3" bgcolor="#CCCCCC"><div class="form-group">

                      <input name="pmb" type="hidden" id="pmb" value="<? echo"$pmb";?>">
                    <a href="alta_socio.php" class="main-footer"><strong>
                  <input name="borrar" type="hidden" id="borrar" />
                      </strong></a>
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

	//$cadena= "$cadena </ul>";
	//echo"$cadena";
	}
		?>
                      </select>
                  </div></td>
                </tr>
                <tr class="">
                  <td bgcolor="#FFFFFF" class="verde">Fecha Contratación </td>
                  <td colspan="3" bgcolor="#FFFFFF"><span class="style5">
				  <?
				  if($fecha_registro){
				  echo "$fecha_registro";
				}
				  ?>
                  </span></td>
                </tr>
				<tr class="">
                  <td bgcolor="#CCCCCC" class="verde">Fecha Vencimiento (Anual) </td>
                  <td colspan="3" bgcolor="#CCCCCC"><span class="style5">
				  <?
           $time = strtotime($vigencia);

				  echo" $vigencia";

				  ?></span></td>
                </tr>
                <tr class="">
                  <td class="verde">Plan Contratado  </td>
                  <td width="300" class="verde"><span class="form-group">


                      <? echo $plan?>


                  </span></td>
                  <td width="46" class="verde">&nbsp;</td>
                  <td width="141" class="verde">&nbsp;</td>
                </tr>
                <tr class="">
                  <td class="verde">&nbsp;</td>
                  <td class="verde">&nbsp;</td>
                  <td class="verde">&nbsp;</td>
                  <td class="verde">&nbsp;</td>
                </tr>
                <tr class="">
                  <td colspan="4" bgcolor="#313630"><span class="style8">Pago a realizar  </span></td>
                </tr>
				<? if($inscripcion=="0"){ ?>
				<? }?>
                <tr >
                  <td colspan="4" class="verde"><table width="93%" border="0">
                    <tr>
                      <td width="14%" bgcolor="#313630"><div align="center" class="style14">Tipo de pago </div></td>
                      <td width="33%" bgcolor="#313630"><div align="center" class="style14">Costo</div></td>
                      <td width="22%" bgcolor="#313630"><div align="center" class="style14">Ultimo Pago </div></td>
                      <td width="31%" bgcolor="#313630"><div align="center" class="style14">Pagar</div></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" ><div align="center">Renovación PMB </div></td>
                      <td bgcolor="#CCCCCC"><div align="left">
                        <p><span class="style5">
                          <input name="pago[]" id="pago" type="checkbox" value="4" onclick="suma();"/>
                            ($
                          <? //echo"$costo_anual";?>
                          <input name="cuatro" type="text" id="cuatro" value="<? echo"$costo_anual";?>" size="3" maxlength="3"  onchange="suma();"/></span>
                          )

                          <span class="style5"> año<br />
                          <input name="pago[]" id="pago" type="checkbox" value="5" onclick="suma();"/>
                          ($
                          <? //echo"$costo_anual";?>
                          <input name="cinco" type="text" id="cinco" value="<? echo $costo_anual/2;?>" size="3" maxlength="3"  onchange="suma();"/></span>
                          ) <span class="style5">semestre</span></p>
                        </div></td>
                      <td bgcolor="#CCCCCC"><div align="center"><? echo"$ultimo_anio_anual";?></div></td>
                      <td bgcolor="#CCCCCC"><div align="right"><span class="style5">
                        <select name="anio" class="texto_verde" id="anio" >
                          <option value="0">-Año-</option>
                          <?
		  for($i=date('Y',$time); $i<=(date('Y',$time)+2); $i++)
		  {
		  ?>
                          <option value="<? echo"$i";?>"><? echo"$i";?></option>
                          <?
		  }
		  ?>
                        </select>
                      </span></div></td>
                    </tr>

                    <tr>
                      <td ><div align="center">Renta Espacio Bodega </div></td>
                      <td><div align="left"><span class="style5">
                        <input name="pago[]" id="pago" type="checkbox" value="1" onclick="suma();"/>
                      ($<? //echo"$costo_mensual";?>
                      <input name="uno" type="text" id="uno" value="<? echo"$costo_mensual";?>" size="3" maxlength="3"  onchange="suma();"/>
                      )

                      x
                      <input name="por_mes" type="text" id="por_mes" value="1" size="1" maxlength="2" onchange="suma();" style="width:auto"/></span>
                      </div></td>
                      <td><div align="center"><? echo"$ultimo_mes / $ultimo_anio_mensual";?></div></td>
                      <td><div align="right"><span class="style5">
                        <select name="mes" class="texto_verde" id="mes" >
                          <option value="0">-Mes-</option>
                          <option value="01" <? if(date("Y")==1) echo"selected";?>>Enero</option>
                          <option value="02" <? if(date("Y")==2) echo"selected";?>>Febrero</option>
                          <option value="03" <? if(date("Y")==3) echo"selected";?>>marzo</option>
                          <option value="04" <? if(date("Y")==4) echo"selected";?>>Abril</option>
                          <option value="05" <? if(date("Y")==5) echo"selected";?>>Mayo</option>
                          <option value="06" <? if(date("Y")==6) echo"selected";?>>Junio</option>
                          <option value="07" <? if(date("Y")==7) echo"selected";?>>Julio</option>
                          <option value="08" <? if(date("Y")==8) echo"selected";?>>Agosto</option>
                          <option value="09" <? if(date("Y")==9) echo"selected";?>>Septiembre</option>
                          <option value="10" <? if(date("Y")==10) echo"selected";?>>Octubre</option>
                          <option value="11" <? if(date("Y")==11) echo"selected";?>>Noviembre</option>
                          <option value="12" <? if(date("Y")==12) echo"selected";?>>Diciembre</option>
                        </select>
                        <select name="annio" class="texto_verde" id="annio" >
                          <option value="0">-Año-</option>
                          <?
		  for($i=date("Y")-1; $i<=date("Y")+1; $i++)
		  {
		  ?>
                          <option value="<? echo"$i";?>"><? echo"$i";?></option>
                          <?
		  }
		  ?>
                        </select>
                      </span></div></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" ><div align="center"><span >Anualidad Secundarios</span></div></td>
                      <td bgcolor="#CCCCCC"><div align="left"><span class="style5">
                        <input name="pago[]" id="pago" type="checkbox" value="2" onclick="suma();"/>
                      ($<? //echo"$costo_anual_adicional";?>
                      <input name="dos" type="text" id="dos" value="<? echo $costo_anual_adicional*$adicionales_cobrar;?>" size="3" maxlength="3"  onchange="suma();"/>
                      x <input name="dosm" type="text" id="dosm" value="<? echo"$adicionales_cobrar";?>" size="1" maxlength="2" />
                      )</span>

                      </div></td>
                      <td bgcolor="#CCCCCC"><div align="center"><? echo"$ultimo_anio_secundario";?></div></td>
                      <td bgcolor="#CCCCCC"><div align="right"><span class="style5">
                        <select name="anio_s" class="texto_verde" id="anio_s" >
                          <option value="0">-Año-</option>
                          <?
		  for($i=date('Y',$time); $i<=date('Y',$time)+2; $i++)
		  {
		  ?>
                          <option value="<? echo"$i";?>"><? echo"$i";?></option>
                          <?
		  }
		  ?>
                        </select>
                      </span></div></td>
                    </tr>
                    <tr>
                      <td><div align="center"><span> Espacio Oficina </span></div></td>
                      <td><span class="style5">
                        <input name="pago[]" id="pago" type="checkbox" value="3" onclick="suma();"/>
                      ($
                      <? //echo"$reempaque";?>
                      <input name="tres" type="text" id="tres" value="<? echo $reempaque;?>" size="3" maxlength="3"  onchange="suma();"/>
x
<input name="por_mes_o" type="text" id="por_mes_o" value="1" size="1" maxlength="2" onchange="suma();"/>
) </span></td>
                      <td><div align="center"><? echo"$ultimo_mes_o / $ultimo_anio_mensual_o";?></div></td>
                      <td><div align="right"><span class="style5">
                        <select name="mes_o" class="texto_verde" id="mes_o" >
                          <option value="0">-Mes-</option>
                          <option value="01" <? if(date("Y")==1) echo"selected";?>>Enero</option>
                          <option value="02" <? if(date("Y")==2) echo"selected";?>>Febrero</option>
                          <option value="03" <? if(date("Y")==3) echo"selected";?>>marzo</option>
                          <option value="04" <? if(date("Y")==4) echo"selected";?>>Abril</option>
                          <option value="05" <? if(date("Y")==5) echo"selected";?>>Mayo</option>
                          <option value="06" <? if(date("Y")==6) echo"selected";?>>Junio</option>
                          <option value="07" <? if(date("Y")==7) echo"selected";?>>Julio</option>
                          <option value="08" <? if(date("Y")==8) echo"selected";?>>Agosto</option>
                          <option value="09" <? if(date("Y")==9) echo"selected";?>>Septiembre</option>
                          <option value="10" <? if(date("Y")==10) echo"selected";?>>Octubre</option>
                          <option value="11" <? if(date("Y")==11) echo"selected";?>>Noviembre</option>
                          <option value="12" <? if(date("Y")==12) echo"selected";?>>Diciembre</option>
                        </select>
                        <select name="anio_o" class="texto_verde" id="select2" >
                          <option value="0">-Año-</option>
                          <?
		  for($i=date("Y")-1; $i<=date("Y")+1; $i++)
		  {
		  ?>
                          <option value="<? echo"$i";?>"><? echo"$i";?></option>
                          <?
		  }
		  ?>
                        </select>
                      </span></div></td>
                    </tr>
					<tr>
                      <td bgcolor="#CCCCCC" ><span >Renovación Parcial PMB</span></td>
                      <td bgcolor="#CCCCCC"><span class="style5">
                        <input name="pago[]" id="pago" type="checkbox" value="6" onclick="suma();"/>
                      </span>($
                      
                      <input name="seis" type="text" id="seis" value="0" size="3" maxlength="3"  onchange="suma();"/>
)</td>
                      <td colspan="2" bgcolor="#CCCCCC"><span class="style5">
                        <select name="dia_m" class="texto_verde" id="dia_m" >
                          <option value="0">-Dia-</option>
                          <?
		  for($i=1; $i<=31; $i++)
		  {
		  ?>
                          <option value="<? echo"$i";?>"><? echo"$i";?></option>
                          <?
		  }
		  ?>
                        </select>
                        <select name="mes_m" class="texto_verde" id="mes_m" >
                          <option value="0">-Mes-</option>
                          <option value="01" >Enero</option>
                          <option value="02" >Febrero</option>
                          <option value="03" >marzo</option>
                          <option value="04" >Abril</option>
                          <option value="05" >Mayo</option>
                          <option value="06" >Junio</option>
                          <option value="07" >Julio</option>
                          <option value="08" >Agosto</option>
                          <option value="09" >Septiembre</option>
                          <option value="10" >Octubre</option>
                          <option value="11" >Noviembre</option>
                          <option value="12" >Diciembre</option>
                        </select>
                        <select name="anio_m" class="texto_verde" id="select3" >
                          <option value="0">-Año-</option>
                          <?
		  for($i=date("Y")+1; $i>=date("Y")-1; $i--)
		  {
		  ?>
                          <option value="<? echo"$i";?>"><? echo"$i";?></option>
                          <?
		  }
		  ?>
                        </select>
                      </span></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="total" type="text" id="total" value="0" size="10" maxlength="5" />
                      <? //echo"$costo_anual";?></td>
                      <td><select name="credito" id="credito">
                        <option value="0">-Tipo de pago-</option>
                        <option value="1">Cargo a cuenta</option>
                        <option value="2">Efectivo</option>
                        <option value="3">TC</option>
                        <option value="4">Cheque</option>
                        <option value="5">Transferencia</option>
                      </select></td>
                      <td><span >Cargo TC</span>
                      <input name="tc_monto" type="text" id="tc_monto" value="0" size="5" maxlength="10" onchange="suma();"/></td>
                    </tr>
                  </table></td>
                </tr>
                <tr class="">
                  <td class="verde">&nbsp;</td>
                  <td class="verde">&nbsp;</td>
                  <td colspan="2" class="verde"><span class="form-group">
                    <input name="guardar" type="submit" id="guardar" value="Aplicar" onclick="return validar()" />
                  </span></td>
                </tr>
				<tr class="">
                  <td colspan="4" bgcolor="#313630"><span class="style8">HISTORIAL DE PAGOS </span></td>
                </tr>
				 <tr class="">
                  <td colspan="4" class="verde"><div align="right">
                    <table width="88%" border="0" align="center">
                      <tr>
                        <td width="22%" bgcolor="#CCCCCC"><div align="center"><span class="style8">Fecha</span></div></td>
                        <td width="47%" bgcolor="#CCCCCC"><div align="center"><span class="style8">Tipo</span></div></td>
                        <td width="20%" bgcolor="#CCCCCC"><div align="center"><span class="style8">Monto</span></div></td>
                        <td width="11%" bgcolor="#CCCCCC">&nbsp;</td>
                      </tr>
                     <?


	$color="#ffffff";
	$consulta  = "select  tipo, monto, facturas_renovacion.id,mes, anio, date_format(facturas_renovacion.fecha, '%m/%d/%Y'),facturas_renovacion.credito, pagos.rango, pagos.factura_id from pagos join facturas_renovacion on pagos.factura_id = facturas_renovacion.id where facturas_renovacion.pmb=$pmb and void=0 order by facturas_renovacion.fecha desc;";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	$tipos=array("","renta espacio Bodega", "Renovación Anual", "Secundario Anualidad", "Renta Espacio Oficina Personal", "Renovación Semestral", "Renovación Parcial","","","VOID");
	$meses=array("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		?>
					  <tr  bgcolor="<? echo"$color";?>">
					    <td><div align="center"><? echo $res[5];?><? if($res[6]=="1") echo"(Credito)"; ?></div></td>
                        <td><? echo $tipos[$res[0]];?> <? echo $meses[$res[3]];?> <? echo $res[4];?> <? echo $res[7];?></td>
                        <td><div align="center"><a href="imprimir_pago_t.php?id=<? echo $res[8];?>"><? echo number_format(round($res[1],2),2);?></a></div></td>
                        <td><div align="center"><? if($tipoU=="1"){?><a href="javascript:borrar(<? echo"$res[2]";?>)"><img src="images/close.gif" width="15" height="13" border="0" /></a><? }?></div></td>
					  </tr>
		<?
		    if($color=="#E8E8E8")
		   		$color="#ffffff";
			else
				$color="#E8E8E8";
		   $count=$count+1;
		}

	?>
                    </table>
                  </div></td>
                </tr>
                <tr class="">
                  <td class="verde">&nbsp;</td>
                  <td class="verde">&nbsp;</td>
                  <td colspan="2" class="verde">&nbsp;</td>
                </tr>
              </table>
            </form>
		  </div>
        </div>
      </div>
  </section>

<script>
function suma()
{
	var total=0;
	if(document.form1.pago[0].checked)
		total=total+document.form1.cuatro.value*1;
	if(document.form1.pago[1].checked)
		total=total+document.form1.cinco.value*1;
	if(document.form1.pago[2].checked)
		total=total+(document.form1.uno.value*1*document.form1.por_mes.value);
	if(document.form1.pago[3].checked)
		total=total+document.form1.dos.value*1;
	if(document.form1.pago[4].checked)
		total=total+(document.form1.tres.value*1*document.form1.por_mes_o.value);
	if(document.form1.pago[5].checked)
		total=total+(document.form1.seis.value*1);
/*	if(document.form1.pago[4].checked)
		total=total+document.form1.parcial.value*1;*/
document.form1.total.value=total;
}
</script><!-- main-footer -->


</body>
</html>
