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
include "SimpleImage.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

if($_POST['guardar']=="Guardar"){

		$consulta  = "SELECT nombre FROM fleteras where nombre=UPPER('".$_POST['nombre']."')";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		echo"<script>alert(\"Fletera Duplicada\");</script>";
	}else
	{
		$consulta3="insert into fleteras (nombre) values (UPPER('".$_POST['nombre']."'))";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());

		$id=  mysql_insert_id();
		if($resultado3){
			if ($_FILES["file"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="images/fleteras/".$id."_".$_FILES["file"]["name"];
	 							$nom2="".$id."_".$_FILES["file"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["file"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update fleteras set logo='$nom2' where id=$id";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  				}

		}

		echo"<script>alert(\"Fletera Agregada\");</script>";
		}
		echo"<script>parent.location=\"fleteras.php\";</script>";

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
      <h2> Nueva Fletera </h2>
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
			   <td class="verde">Logo				</td>
				<td><div class="form-group">
				 <input type="file" name="file" class="form-control" placeholder="Selecciona logo">
			   </div>			   </td>
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
