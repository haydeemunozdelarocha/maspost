<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Banner</title>
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
$id=$_GET['id'];
if($_POST['guardar']=="Guardar"){

		$id=$_POST['id'];
		$consulta3="update banner set texto='".$_POST['texto']."' where id=1";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());






		echo"<script>alert(\"Banner Guardado\");</script>";


}
$consulta  = "select texto from banner ";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>0)
	{
		$res=mysql_fetch_row($resultado);
	}
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
            <form action="" method="post"  name="form1">

          <table width="400px" align="center" class="">


              <tr class="">
                <td class="verde">Texto				</td>
				<td><div class="form-group">
                          <textarea name="texto" cols="60" rows="3" class="form-control" id="texto" placeholder="Nombre" required="required"><? echo"$res[0]";?></textarea>
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
