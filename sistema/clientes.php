<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Clientes</title>
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
@media print {
  a[href]:after {
    content: none !important;
  }
  }
.style5 {color: #FFFFFF; font-size: 12px; }
.style14 {color: #000000}
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


?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">


           <? include "menu_f.php"?>

        </nav>
    </header> <!-- /. main-header -->

    <article class="barra-menu">

    </article><!-- /. barra-menu -->

  <section class="tipos-textos">

      <table width="300" border="1" cellspacing="0">
        <?
		$consulta  = "SELECT count(planes.nombre) FROM `planes` inner join clientes on planes.id=clientes.id_plan where vigencia>=now() ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	if(@mysql_num_rows($resultado)>0)
	{
	$res=mysql_fetch_row($resultado);
		?>
        <tr>
          <td>#Total de clientes </td>
          <td><div align="center"><? echo $res[0];?></div></td>
        </tr>

		<? }?>
		<?
		$consulta  = "SELECT  count(planes.nombre) FROM `planes` inner join clientes on planes.id=clientes.id_plan where YEAR(fecha_registro)=YEAR(now())";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	if(@mysql_num_rows($resultado)>0)
	{
	$res=mysql_fetch_row($resultado);
		?>
        <tr>
          <td>Clientes Nuevos este año </td>
          <td><div align="center"><? echo $res[0];?></div></td>
        </tr>
		<? }?>
		<?
		$consulta  = "SELECT planes.nombre, count(planes.nombre) FROM `planes` inner join clientes on planes.id=clientes.id_plan where vigencia>=now() group by planes.id order by planes.nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
	$res=mysql_fetch_row($resultado);
		?>
        <tr>
          <td><? echo $res[0];?> </td>
          <td><div align="center"><? echo $res[1];?></div></td>
        </tr>

		<?
		$count++;
		}?>
      </table>
    <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div class="container">
        <div class="table-responsive">
          <form name="form1" method="get" action="">
          
          <table width="818" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="2" scope="row">
                  <span class="style14">PMB
                <input name="pmb" type="text" id="pmb" size="5" maxlength="5" />
                <input name="buscarNombre" type="submit" id="buscarNombre" value="Buscar" />
                </span></th>
                <th scope="row">&nbsp;</th>
                <th scope="row">&nbsp;</th>
                <th scope="row"><span class="style14">
                  <input name="saldo" type="submit" id="saldo" value="Ver Solo Saldo" />
                </span></th>
              </tr>
              <tr class="">
                <th colspan="5" scope="row"><div align="right"><span class="verde"><a href="alta_cliente.php"><strong>Nuevo (+)</strong></a><strong> </strong></span></div></th>
              </tr>
              <tr class="">
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">PMB#</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Titular</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Plan</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Vigencia</span></div></th>
                <th bgcolor="#313630" class="style5" scope="row"><div align="center">Saldo</div></th>
              </tr>
            </thead>
            <tbody>
              <?

$pmb= $_GET["pmb"];
$verSaldo= $_GET["saldo"];
if($pmb=="")
{
		if($verSaldo!="")
		{
			$consulta  = "select clientes.id, clientes.pmb, c_recibir.app, c_recibir.apm, c_recibir.nombre, DATE_FORMAT(clientes.vigencia,'%m-%d-%Y'), planes.nombre,format(clientes.credito,2) from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and clientes.pmb<=1000 and clientes.credito>.5 order by credito desc ";
		}
		else
		{
				$consulta  = "select clientes.id, clientes.pmb, c_recibir.app, c_recibir.apm, c_recibir.nombre, DATE_FORMAT(clientes.vigencia,'%m-%d-%Y'), planes.nombre,format(clientes.credito,2) from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and clientes.pmb<=1000 order by clientes.pmb,c_recibir.app, c_recibir.apm, c_recibir.nombre ";
	
		}
	}
	else	
	$consulta  = "select clientes.id, clientes.pmb, c_recibir.app, c_recibir.apm, c_recibir.nombre, DATE_FORMAT(clientes.vigencia,'%m-%d-%Y'), planes.nombre, format(clientes.credito,2) from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and clientes.pmb=$pmb order by clientes.pmb,c_recibir.app, c_recibir.apm, c_recibir.nombre ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);

		if($res[1]!=$entrada_anterior && ""!=$entrada_anterior)
			{
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
			}

		?>
              <tr  bgcolor="<? echo"$color";?>" style="height:20px">
                <td width="75" height="33" ><div align="center"><a href="editar_cliente.php?id=<? echo"$res[0]";?>"><? echo"$res[1]"; ?></a><a href="cambia_pmb.php?id=<?echo"$res[0]"?>"></a></div></td>
                <td width="347" ><a href="editar_cliente.php?id=<?echo"$res[0]"?>"><? echo"$res[2] $res[3] $res[4]"; ?></a></td>
                <td width="160"><div align="center"><? echo"$res[6]"; ?></div></td>
                <td width="108"><div align="center"><? echo"$res[5]"; ?></div></td>
                <td width="104"><div align="center">$<? echo"$res[7]"; ?></div></td>
              </tr>
              <?

		   $count=$count+1;
		   $entrada_anterior=$res[1];
		}

	?>
            </tbody>
          </table>
		  </form>
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
