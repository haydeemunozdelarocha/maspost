<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | PMBs</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/style-admin.css">
        <script src="assets/js/modernizr-2.6.2.min.js"></script>
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
      <div >
        <div >
          <div align="center">
          <table width="510" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="3" scope="row"><div align="right"><span class="verde"><a href="alta_pmb.php"><strong>Nuevo (+)</strong></a><strong> </strong></span></div></th>
              </tr>
              <tr class="">
                <th colspan="3" bgcolor="#313630" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
			<?



	$consulta  = "select pmbs.id, id_cliente, c_recibir.nombre, c_recibir.app, c_recibir.apm from pmbs  left outer join c_recibir on pmbs.id=c_recibir.pmb group by pmbs.id order by  pmbs.id";//left outer join clientes on pmbs.id=clientes.pmb where  c_recibir.tipo=1
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);



		?>
              <tr  bgcolor="<? echo"$color";?>">
                <td width="165" ><a href="cambia_pmb.php?id=<?echo"$res[0]"?>"><? echo"$res[0]"; ?></a></td>
                <td width="295" ><a href="cambia_pmb.php?id=<?echo"$res[0]"?>"><? if($res[1]==0) echo"Disponible"; else echo"$res[2] $res[3] $res[4]"; ?></a></td>
                <td width="34">&nbsp;</td>
              </tr>
	<?
		   if($color=="#E8E8E8")
		   		$color="#ffffff";
			else
				$color="#E8E8E8";
		   $count=$count+1;
		}

	?>
            </tbody>
          </table>
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
