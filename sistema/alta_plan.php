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
        <style type="text/css">
<!--
.style10 {font-size: 16px}
.style14 {color: #1c51c6}
-->
        </style>
</head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
include "SimpleImage.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

if($_POST['guardar']=="Guardar"){


		$consulta3="insert into planes (nombre, costo_anual, costo_mensual, costo_anual_adicional, no_usuarios, tabla_paquetes, tabla_envios, tabla_pallets, reempaque, remesa, cajas_incluidos, pallets_incluidos) values ('".$_POST['nombre']."', '".$_POST['costo_anual']."', '".$_POST['costo_mensual']."', '".$_POST['costo_anual_adicional']."', '".$_POST['no_usuarios']."', '".$_POST['tabla_paquetes']."', '".$_POST['tabla_envios']."', '".$_POST['tabla_pallets']."', '".$_POST['reempaque']."', '".$_POST['remesa']."', ".$_POST['cajas_incluidas'].", ".$_POST['cajas_incluidas'].")";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());



		echo"<script>alert(\"Plan Agregado\");</script>";
		echo"<script>parent.location=\"planes.php\";</script>";

}

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

           <? include "menu_f.php"?>
        </nav>
    </header> <!-- /. main-header -->

    <article class="barra-menu">

    </article><!-- /. barra-menu -->

  <section class="tipos-textos">
      <h2> Nuevo Plan </h2>
      <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post" enctype="multipart/form-data" name="form1">
              <table width="488" align="center" class="">
                <tr class="">
                  <td width="121" class="verde">Nombre </td>
                  <td width="267"><div class="form-group">
                      <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                  </div></td>
                </tr>
                <tr class="">
                  <td class="verde"><span class="style14">Renovación PMB</span></td>
                  <td><div class="form-group">
                      <input name="costo_anual" type="text" class="form-control" id="costo_anual" value="0" size="10" maxlength="10" placeholder="Costo Anual" required>
                  </div></td>
                </tr>
                <tr class="">
                  <td class="verde"><span class="style14">Pago renta Espacio Bodega</span></td>
                  <td><span class="form-group">
                    <input name="costo_mensual" type="text" class="form-control" id="costo_mensual" size="10" maxlength="10" value="0" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Costo Anual por Secundario </td>
                  <td><span class="form-group">
                    <input name="costo_anual_adicional" type="text" class="form-control" id="costo_anual_adicional" size="10" maxlength="10" placeholder="Adicional" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Numero usuarios permitidos </td>
                  <td><span class="form-group">
                    <input name="no_usuarios" type="text" class="form-control" id="no_usuarios" size="10" maxlength="10" placeholder="Numero usuarios" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Precios Cajas </td>
                  <td><span class="style10">
                    <select name="tabla_paquetes" class="texto_verde" id="select5">
                      <option value="0">--Selecciona Tabla--</option>
                      <?



	$consulta  = "SELECT id, nombre FROM nombre_tablas order by nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;

	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);

		echo"<option value=\"$res[0]\" >$res[1]</option>";
		$count=$count+1;
	}

		?>
                    </select>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Precios Envios </td>
                  <td><span class="style10">
                    <select name="tabla_envios" class="texto_verde" id="tabla_envios">
                      <option value="0">--Selecciona Tabla--</option>
                      <?



	$consulta  = "SELECT id, nombre FROM nombre_tablas order by nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;

	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);

		echo"<option value=\"$res[0]\" >$res[1]</option>";
		$count=$count+1;
	}

		?>
                    </select>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Precios Pallets </td>
                  <td><span class="style10">
                    <select name="tabla_pallets" class="texto_verde" id="tabla_pallets">
                      <option value="0">--Selecciona Tabla--</option>
                      <?



	$consulta  = "SELECT id, nombre FROM nombre_tablas order by nombre";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;

	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);

		echo"<option value=\"$res[0]\" >$res[1]</option>";
		$count=$count+1;
	}

		?>
                    </select>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde"><span class="style14">Pago Renta Oficina</span></td>
                  <td><span class="form-group">
                    <input name="reempaque" type="text" class="form-control" id="reempaque" value="0" size="10" maxlength="10" placeholder="Reempaque" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Permite Remesa </td>
                  <td><span class="style5">Si
                    <input name="remesa" type="radio" value="1">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No
                    <input name="remesa" type="radio" value="0">
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde"># Cajas Incluidas </td>
                  <td><span class="form-group">
                    <input name="cajas_incluidas" type="text" class="form-control" id="cajas_incluidas" value="0" size="10" maxlength="10" placeholder="Numero usuarios" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Pallets Incluidos </td>
                  <td><span class="form-group">
                    <input name="pallets_incluidas" type="text" class="form-control" id="pallets_incluidas" value="0" size="10" maxlength="10" placeholder="Numero usuarios" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td colspan="2" class="verde"><div align="center">
                    <input name="guardar" type="submit" id="guardar" value="Guardar">
                  </div></td>
                </tr>
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
