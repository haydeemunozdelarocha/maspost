<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Archivo Muerto</title>
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
.style5 {color: #FFFFFF; font-size: 12px; }
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


 <section class="tabla">
      <div class="container">
        <div class="table-responsive">
          <table width="1067" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="4" scope="row"><div align="right"><span class="verde"><a href="alta_cliente.php"><strong>Nuevo (+)</strong></a><strong> </strong></span></div></th>
              </tr>
              <tr class="">
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">PMB#</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Titular</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Plan</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Vigencia</span></div></th>
              </tr>
            </thead>
            <tbody>
              <?



	$consulta  = "select clientes.id, clientes.pmb, c_recibir.app, c_recibir.apm, c_recibir.nombre, DATE_FORMAT(clientes.vigencia,'%m-%d-%Y'), planes.nombre from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and clientes.pmb>1000 order by clientes.pmb,c_recibir.app, c_recibir.apm, c_recibir.nombre ";
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
              <tr  bgcolor="<? echo"$color";?>">
                <td width="118" height="149" ><div align="center"><a href="editar_cliente.php?id=<? echo"$res[0]";?>"><? echo"$res[1]"; ?></a><a href="cambia_pmb.php?id=<?echo"$res[0]"?>"></a></div></td>
                <td width="406" ><a href="editar_cliente.php?id=<?echo"$res[0]"?>"><? echo"$res[2] $res[3] $res[4]"; ?></a></td>
                <td width="260"><div align="center"><? echo"$res[5]"; ?></div></td>
                <td width="263"><div align="center"><? echo"$res[5]"; ?></div></td>
              </tr>
              <?

		   $count=$count+1;
		   $entrada_anterior=$res[1];
		}

	?>
            </tbody>
          </table>
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
