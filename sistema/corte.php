<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Planes</title>
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
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
.style6 {color: #FFFFFF}
-->
        </style>
</head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'spanish');
$fecha_t = date("m/d/Y");
if($_POST["fecha"]!="")
	$fecha_t= $_POST["fecha"];
$fecha_temp=explode("/", $fecha_t);
	$fecha="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
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

          <table width="810" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="8" scope="row"><div align="right">Fecha<span class="style5">
                  <input name="fecha" type="text" class="texto_verde" id="fecha" value="<?echo"$fecha_t";?>" size="20" maxlength="10"  placeholder="mm/dd/aaaa"/>
                </span><span class="style5">
<input name="Buscar" type="submit" class="barra-menu" id="Buscar"  value="buscar">
</span></div></th>
              </tr>
              <tr class="">
                <th bgcolor="#313630" scope="row">&nbsp;</th>
                <th bgcolor="#313630" scope="row">&nbsp;</th>
                <th bgcolor="#313630" scope="row"><span class="style6">Cargo a cuenta </span></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style6">Efectivo</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style6">TC</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style6">Cheque</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style6">Trans</span></div></th>
                <th bgcolor="#313630" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
			<?






	$consulta  = "select sum(total_p),sum(total_s) from salidas where date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$salidas=$res[0];
		$servicios=$res[1];
	}
	$consulta  = "select sum(total_p),sum(total_s) from salidas where credito=1 and date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$salidas_credito=$res[0];
		$servicios_credito=$res[1];
	}
	$consulta  = "select sum(total_p),sum(total_s) from salidas where credito=2 and date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$salidas_efectivo=$res[0];
		$servicios_efectivo=$res[1];
	}
	$consulta  = "select sum(total_p),sum(total_s) from salidas where credito=3 and date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$salidas_tc=$res[0];
		$servicios_tc=$res[1];
	}
	$consulta  = "select sum(total_p),sum(total_s) from salidas where credito=4 and date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$salidas_cheque=$res[0];
		$servicios_cheque=$res[1];
	}
	$consulta  = "select sum(total_p),sum(total_s) from salidas where credito=5 and date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$salidas_trans=$res[0];
		$servicios_trans=$res[1];
	}
	$consulta  = "SELECT sum(monto), count(id) FROM `pagos` where date(fecha)='$fecha' and tipo=2";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$renovaciones=$res[0];
		$cuantos_renovaciones=$res[1];
		if($cuantos_renovaciones==0)
			$renovaciones=0;
	}
	$consulta  = "SELECT sum(monto), count(id) FROM `pagos` where date(fecha)='$fecha' and tipo=1";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$espacio=$res[0];
		$cuantos_espacio=$res[1];
		if($cuantos_espacio==0)
			$espacio=0;
	}
	$consulta  = "SELECT sum(monto), count(id) FROM `pagos` where date(fecha)='$fecha' and tipo=4";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$oficina=$res[0];
		$cuantos_oficina=$res[1];
		if($cuantos_oficina==0)
			$oficina=0;
	}
	$consulta  = "SELECT sum(monto), count(id) FROM `pagos` where date(fecha)='$fecha' and tipo=3";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$secundarios=$res[0];
		$cuantos_secundarios=$res[1];
		if($cuantos_secundarios==0)
			$secundarios=0;
	}

	$consulta  = "SELECT sum(monto) FROM `abonos` where date(fecha)='$fecha'";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$creditos=$res[0];
		if($creditos=="")
			$creditos="0";

	}
	$total=$creditos+$secundarios+$oficina+$espacio+$renovacion+$servicios+$salidas;

		?>
              <tr  bgcolor="<? echo"$color";?>">
                <td width="328" bgcolor="#E6E6E6" >RENOVACIÓN DE PMB (<? echo"$cuantos_renovaciones";?>) </td>
                <td width="80" bgcolor="#E6E6E6" >&nbsp;</td>
                <td width="109" bgcolor="#E6E6E6" ><div align="center"></div></td>
                <td width="63" bgcolor="#E6E6E6" ><div align="center">$<? echo"$renovaciones";?></div></td>
                <td width="63" bgcolor="#E6E6E6" >&nbsp;</td>
                <td width="63" bgcolor="#E6E6E6" >&nbsp;</td>
                <td width="72" bgcolor="#E6E6E6" >&nbsp;</td>
                <td width="80" bgcolor="#E6E6E6" ><div align="center">$<? echo"$renovaciones";?></div></td>
              </tr>
              <tr  bgcolor="<? echo"$color";?>">
                <td >PAGO RENTA DE OFICINA (<? echo"$cuantos_oficina";?>) </td>
                <td >&nbsp;</td>
                <td ><div align="center"></div></td>
                <td ><div align="center">$<? echo"$oficina";?></div></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td ><div align="center">$<? echo"$oficina";?></div></td>
              </tr>
              <tr  bgcolor="<? echo"$color";?>">
                <td bgcolor="#E6E6E6" >PAGO RENTA ESPACIO BODEGA (<? echo"$cuantos_espacio";?>) </td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" ><div align="center"></div></td>
                <td bgcolor="#E6E6E6" ><div align="center">$<? echo"$espacio";?></div></td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" ><div align="center">$<? echo"$espacio";?></div></td>
              </tr>
              <tr  bgcolor="<? echo"$color";?>">
                <td >PAGO SALIDAS DE BODEGA </td>
                <td >&nbsp;</td>
                <td ><div align="center">$<? echo round($salidas_credito,2);?></div></td>
                <td ><div align="center">$<? echo round($salidas_efectivo,2);?></div></td>
                <td ><div align="center">$<? echo round($salidas_tc,2);?></div></td>
                <td ><div align="center">$<? echo round($salidas_cheque,2);?></div></td>
                <td ><div align="center">$<? echo round($salidas_trans,2);?></div></td>
                <td ><div align="center">$<? echo round($salidas,2);?></div></td>
              </tr>
			   <tr  bgcolor="<? echo"$color";?>">
                <td bgcolor="#E6E6E6" >ANUALIDAD SECUNDARIOS  (<? echo"$cuantos_secundarios";?>) </td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" ><div align="center"></div></td>
		        <td bgcolor="#E6E6E6" ><div align="center">$<? echo round($secundarios,2);?></div></td>
		        <td bgcolor="#E6E6E6" ><div align="center"></div></td>
		        <td bgcolor="#E6E6E6" ><div align="center"></div></td>
		        <td bgcolor="#E6E6E6" ><div align="center"></div></td>
		        <td bgcolor="#E6E6E6" ><div align="center">$<? echo round($secundarios,2);?></div></td>
		      </tr>
              <tr  bgcolor="<? echo"$color";?>">
                <td >SERVICIOS </td>
                <td >&nbsp;</td>
                <td ><div align="center">$<? echo round($servicios_credito,2);?></div></td>
                <td ><div align="center">$<? echo round($servicios_efectivo,2);?></div></td>
                <td ><div align="center">$<? echo round($servicios_tc,2);?></div></td>
                <td ><div align="center">$<? echo round($servicios_cheque,2);?></div></td>
                <td ><div align="center">$<? echo round($servicios_trans,2);?></div></td>
                <td ><div align="center">$<? echo round($servicios,2);?></div></td>
              </tr>
              <tr  bgcolor="<? echo"$color";?>">
                <td bgcolor="#E6E6E6" >PAGO CREDITOS </td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" ><div align="center"></div></td>
                <td bgcolor="#E6E6E6" ><div align="center">$<? echo round($creditos,2);?></div></td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" >&nbsp;</td>
                <td bgcolor="#E6E6E6" ><div align="center">$<? echo round($creditos,2);?></div></td>
              </tr>
              <tr  bgcolor="<? echo"$color";?>">
                <td ><div align="right"></div></td>
                <td bgcolor="#CCCCCC" ><div align="center"><strong>TOTAL</strong></div></td>
                <td bgcolor="#CCCCCC" ><div align="center">$<? echo round($salidas_credito+$servicios_credito,2);?></div></td>
                <td bgcolor="#CCCCCC" ><div align="center">$<? echo round($creditos+$servicios_efectivo+$secundarios+$salidas_efectivo+$espacio+$oficina+$renovaciones,2);?></div></td>
                <td bgcolor="#CCCCCC" ><div align="center">$<? echo round($salidas_tc+$servicios_tc,2);?></div></td>
                <td bgcolor="#CCCCCC" ><div align="center">$<? echo round($salidas_cheque+$servicios_cheque,2);?></div></td>
                <td bgcolor="#CCCCCC" ><div align="center">$<? echo round($salidas_trans+$servicios_trans,2);?></div></td>
                <td bgcolor="#CCCCCC" ><div align="center">$<? echo round($total,2);?></div></td>
              </tr>
	<?


	?>
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
