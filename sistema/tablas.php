<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Tablas</title>
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
          <table width="1200" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="13" scope="row"><div align="right"><span class="verde"><a href="alta_tabla.php"><strong>Nueva (+)</strong></a><strong> </strong></span></div></th>
              </tr>
              <tr class="">
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">Nombre</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">Rango</span></div></th>
                <th bgcolor="#313630" class="style5" scope="row"><div align="center">SP-XCH</div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">SP-CH</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center" class="style5">SP-M </div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">SP-G </span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center" class="style5">SP-XG </div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">C-XCH</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">C-CH</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">C-M</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">C-G</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">C-XG</span></div></th>
                <th bgcolor="#313630" class="h5 style6" scope="row"><div align="center">OTRO</div></th>
              </tr>
            </thead>
            <tbody>
			<?



	$consulta  = "select tablas.id, nombre,c1,c2,sobres, paquetes, chico, mediano, grande, xtra, sobre_grande, paquete_grande, xtra_chico, otro,sobrex_chico from tablas inner join nombre_tablas on tablas.tipo=nombre_tablas.id where tipo not in (4,5,6,7)order by tipo, c1";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	$color="#E8E8E8";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);



		?>
              <tr  bgcolor="<? echo"$color";?>">
                <td width="77" ><div align="center"><a href="cambia_tabla.php?id=<?echo"$res[0]"?>"><? echo"$res[1]"; ?></a></div></td>
                <td width="59"><div align="center"><? echo"$res[2]-$res[3]"; ?></div>
                <div align="center"></div></td>
                <td width="71"><div align="center"><? echo"$res[14]"; ?></div></td>
                <td width="71"><div align="center"><? echo"$res[4]"; ?></div></td>
                <td width="80"><div align="center"><? echo"$res[10]"; ?></div></td>
                <td width="91"><div align="center"><? echo"$res[5]"; ?></div></td>
                <td width="98"><div align="center"><? echo"$res[11]"; ?></div></td>
                <td width="78"><div align="center"><? echo"$res[12]"; ?></div></td>
                <td width="78"><div align="center"><? echo"$res[6]"; ?></div></td>
                <td width="100"><div align="center"><? echo"$res[7]"; ?></div></td>
                <td width="87"><div align="center"><? echo"$res[8]"; ?></div></td>
                <td width="114"><div align="center"><? echo"$res[9]"; ?></div></td>
                <td width="114"><div align="center"><? echo"$res[13]"; ?></div></td>
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
		  <table width="535" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="5" scope="row"><div align="right"><span class="verde"><a href="alta_tabla_t.php"><strong>Nueva (+)</strong></a><strong> </strong></span></div></th>
              </tr>
              <tr class="">
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">Nombre</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">Rango</span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">Primeros 15 dias  </span></div></th>
                <th bgcolor="#313630" class="h5" scope="row"><div align="center"><span class="style5">Total x Mes  </span></div></th>
                <th width="12" bgcolor="#313630" class="h5" scope="row">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?



	$consulta  = "select tablas.id, nombre,c1,c2,sobres, paquetes, chico, mediano, grande, xtra, sobre_grande, paquete_grande, xtra_chico from tablas inner join nombre_tablas on tablas.tipo=nombre_tablas.id  where tipo in (4,5,6,7) order by tipo, c1";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	$color="#E8E8E8";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);



		?>
              <tr  bgcolor="<? echo"$color";?>">
                <td width="123" ><div align="center"><a href="cambia_tabla.php?id=<?echo"$res[0]"?>"><? echo"$res[1]"; ?></a></div></td>
                <td width="57"><div align="center"><? echo"$res[2]-$res[3]"; ?></div>
                    <div align="center"></div></td>
                <td width="121"><div align="center"><? echo"$res[4]"; ?></div></td>
                <td><div align="center"><? echo"$res[10]"; ?></div></td>
                <td>&nbsp;</td>
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
