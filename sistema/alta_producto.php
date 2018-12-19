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
    </head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";

$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

if($_POST['guardar']=="Guardar"){


		$nombre= $_POST["nombre"];
	$precio= $_POST["precio"];
	$taxable= $_POST["taxable"];
	$cantidad= $_POST["cantidad"];

	$codigo= $_POST["codigo"];
	$costo= $_POST["costo"];
	$id=$_POST["id"];

	$consulta  =  "insert into productos(nombre, precio, taxable, cantidad,  codigo, costo) values('$nombre', $precio, $taxable, $cantidad,  '$codigo', $costo) ";
	//out.println(listGStr);
	$resultado = mysql_query($consulta) or die("Error en operacion1: $consulta " . mysql_error());
	echo"<script>alert(\"Producto Agregado\");</script>";


		echo"<script>window.location=\"productos.php\";</script>";

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
      <h2> Nuevo Producto </h2>
      <h3 align="center">&nbsp;</h3>
    </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post" enctype="multipart/form-data" name="form1">

          <table width="400px" align="center" class="">


              <tr class="">
                <td class="verde">Nombre				</td>
				<td><div class="form-group">
                          <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                       </div>			    </td>
              </tr>
			   <tr class="">
                <td class="verde">Precio				</td>
				<td><div class="form-group">
                          <input name="precio" type="text" class="form-control" id="precio" value="0" placeholder="Precio" required>
                       </div>			    </td>
              </tr>
			  <tr class="">
                <td class="verde">Taxable				</td>
				<td><div class="form-group"><span class="style5">No
                      <input name="taxable" type="radio" value="0" checked="checked" />
Si
<input name="taxable" type="radio" value="1"  />
				</span></div>			    </td>
              </tr>
			  <tr class="">
                <td class="verde">Cantidad				</td>
				<td><div class="form-group">
                          <input name="cantidad" type="text" class="form-control" id="cantidad" value="0" placeholder="Precio" required>
                       </div>			    </td>
              </tr>
			  <tr class="">
                <td class="verde">Codigo				</td>
				<td><div class="form-group">
                          <input name="codigo" type="text" class="form-control" id="codigo" placeholder="Precio" required>
                       </div>			    </td>
              </tr>
			  <tr class="">
                <td class="verde">Costo				</td>
				<td><div class="form-group">
                          <input name="costo" type="text" class="form-control" id="costo" value="0" placeholder="Precio" required>
                       </div>			    </td>
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
