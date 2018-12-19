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

if($_POST['guardar']=="Guardar"){


		$consulta3="insert into tablas (c1,c2,sobres,  sobre_grande, tipo) values ('".$_POST['c1']."', '".$_POST['c2']."', '".$_POST['sobres']."', '".$_POST['sobre_g']."', 4)";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());



		echo"<script>alert(\"Tabla Agregada\");</script>";
		echo"<script>parent.location=\"tablas.php\";</script>";

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
      <h2> Nueva Precio deTabla </h2>
      <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post" enctype="multipart/form-data" name="form1">

          <table width="650" border="0" align="center" cellpadding="1" cellspacing="2" class="">


              <tr class="">
                <td width="121" class="verde">&nbsp;</td>
                <td width="121" bgcolor="#EAEAEA" class="verde">Tabla				</td>
				<td width="267" bgcolor="#EAEAEA"><div class="form-group"><span class="style10">
				  <select name="tipo" class="texto_verde" id="select5">
                    <option value="0">--Selecciona Tabla--</option>
                    <?



	$consulta  = "SELECT id, nombre FROM nombre_tablas where id in (4,5,6,7) order by nombre";
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
				</span></div>			    </td>
              </tr>
			  <tr class="">
			    <td rowspan="2" class="verde"><div align="center">Rango</div></td>
			   <td bgcolor="#EAEAEA" class="verde">Min Peso 				</td>
				<td valign="middle" bgcolor="#EAEAEA"><div class="form-group">
				  <input name="c1" type="text" class="form-control" id="c1" size="10" maxlength="10" placeholder="Minimo" required>
				</div>			   </td>
              </tr>
			  <tr class="">
			    <td class="verde" bgcolor="#EAEAEA">Max Peso </td>

			    <td bgcolor="#EAEAEA"><div class="form-group">
			      <input name="c2" type="text" class="form-control" id="c2" size="10" maxlength="10" placeholder="Maximo" required>
			    </div></td>
		    </tr>
			  <tr class="">
			    <td rowspan="2" class="verde"><div align="center">Costo</div></td>
			    <td bgcolor="#EAEAEA" class="verde">Primeros 15 dias  </td>
			    <td bgcolor="#EAEAEA"><div class="form-group">
			      <input name="sobres" type="text" class="form-control" id="sobres" size="10" maxlength="10" placeholder="Sobre Chico" required>
			    </div></td>
		    </tr>
			  <tr class="">
			    <td class="verde" bgcolor="#EAEAEA"><div align="left">Mes completo  </div></td>
			    <td bgcolor="#EAEAEA"><div class="form-group">
			      <input name="sobre_g" type="text" class="form-control" id="sobre_g" size="10" maxlength="10" placeholder="Sobre Grande" required>
			    </div></td>
		    </tr>
			  <tr class="">
			    <td class="verde">&nbsp;</td>
			    <td colspan="3" class="verde"><div align="center">
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
