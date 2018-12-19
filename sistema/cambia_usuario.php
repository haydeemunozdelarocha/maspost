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
$id=$_GET['id'];
if($_POST['guardar']=="Guardar"){
		$id=$_POST['id'];

		$consulta3="update usuarios set nombre='".$_POST['nombre']."', email='".$_POST['email']."', pass='".$_POST['pass']."', tipo='".$_POST['adm']."' where id=$id";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());



		echo"<script>alert(\"Usuario Cambiado\");</script>";
		echo"<script>parent.location=\"usuarios.php\";</script>";

}

$consulta  = "select * from usuarios where id=$id";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>0)
	{
		$res=mysql_fetch_row($resultado);
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
      <h2> Cambia Usuario </h2>
      <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post" enctype="multipart/form-data" name="form1">
              <table width="488" align="center" class="">
                <tr class="">
                  <td width="121" class="verde">Nombre
                  <input name="id" type="hidden" id="id" value="<? echo"$id";?>"></td>
                  <td width="267"><div class="form-group">
                      <input name="nombre" type="text" class="form-control" value="<? echo"$res[4]";?>" placeholder="Nombre" required>
                  </div></td>
                </tr>
                <tr class="">
                  <td class="verde">Password</td>
                  <td><div class="form-group">
                      <input name="pass" type="text" class="form-control" id="pass" value="<? echo"$res[2]";?>" size="10" maxlength="10" placeholder="Costo Anual" required>
                  </div></td>
                </tr>
                <tr class="">
                  <td class="verde">Email</td>
                  <td><span class="form-group">
                    <input name="email" type="text" class="form-control" id="email" size="10" maxlength="30" value="<? echo"$res[1]";?>" required>
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Administardor</td>
                  <td><span class="style5">Si
                    <input name="adm" type="radio" value="1" <? if($res[3]=="1") echo"checked";?>>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No
                    <input name="adm" type="radio" value="0" <? if($res[3]=="0") echo"checked";?>>
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
