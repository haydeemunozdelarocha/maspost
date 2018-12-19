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

		$consulta3="update tablas set c1='".$_POST['c1']."',c2='".$_POST['c2']."',sobres='".$_POST['sobres']."', paquetes='".$_POST['paquetes']."', chico='".$_POST['chico']."', mediano= '".$_POST['mediano']."', grande= '".$_POST['grande']."', xtra='".$_POST['xtra']."', tipo='".$_POST['tipo']."', paquete_grande= '".$_POST['paquete_g']."', sobre_grande= '".$_POST['sobre_g']."', xtra_chico= '".$_POST['extra_chico']."', otro='".$_POST['otro']."', sobrex_chico='".$_POST['spxch']."' where id=$id";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());



		echo"<script>alert(\"Tabla Cambiada\");</script>";
		echo"<script>parent.location=\"tablas.php\";</script>";

}

$consulta  = "select * from tablas where id=$id";
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
      <h2> Cambia Tabla </h2>
      <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post" enctype="multipart/form-data" name="form1">

          <table width="531" align="center" class="">


              <tr class="">
                <td colspan="2" class="verde"><div align="center">
                  <input name="id" type="hidden" id="id" value="<? echo"$id";?>">
                Nombre				</div></td>
                <td width="323"><div class="form-group"><span class="style10">
                  <select name="tipo" class="texto_verde" id="select5">
                    <option value="0">--Selecciona Tabla--</option>
                    <?



	$consulta2  = "SELECT id, nombre FROM nombre_tablas order by nombre";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count2=1;

	while(@mysql_num_rows($resultado2)>=$count2)
	{
		$res2=mysql_fetch_row($resultado2);
		if($res2[0]==$res[9])
		echo"<option value=\"$res2[0]\" selected>$res2[1]</option>";
		else
		echo"<option value=\"$res2[0]\" >$res2[1]</option>";
		$count2=$count2+1;
	}

		?>
                  </select>
                </span></div>			    </td>
              </tr>
			  <tr class="">
			    <td width="70" rowspan="2" class="verde"><div align="center">Rango</div></td>
			   <td width="122" class="verde"><div align="center">Min Paquetes 				</div></td>
				<td><div class="form-group">
				  <input name="c1" type="text" class="form-control" id="c1" value="<? echo"$res[1]";?>" size="10" maxlength="10" placeholder="" required>
				</div>			   </td>
              </tr>
			  <tr class="">
			    <td class="verde"><div align="center">Max Paquetes </div></td>
			    <td><span class="form-group">
			      <input name="c2" type="text" class="form-control" id="c2" value="<? echo"$res[2]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td rowspan="10" class="verde"><div align="center">Costo</div></td>
			    <td class="verde"><div align="center">SP-XCH</div></td>
			    <td><span class="form-group">
			      <input name="spxch" type="text" class="form-control" id="spxch" value="<? echo"$res[14]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">SP-CH</div></td>
			    <td><span class="form-group">
			      <input name="sobres" type="text" class="form-control" id="sobres" value="<? echo"$res[3]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">SP-M </div></td>
			    <td><span class="form-group">
			      <input name="sobre_g" type="text" class="form-control" id="sobre_g" value="<? echo"$res[11]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">SP-G </div></td>
			    <td><span class="form-group">
			      <input name="paquetes" type="text" class="form-control" id="paquetes" value="<? echo"$res[4]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">SP-XG </div></td>
			    <td><span class="form-group">
			      <input name="paquete_g" type="text" class="form-control" id="paquete_g" value="<? echo"$res[10]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">C-XCH </div></td>
			    <td><span class="form-group">
			      <input name="extra_chico" type="text" class="form-control" id="extra_chico" value="<? echo"$res[12]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">C-CH </div></td>
			    <td><span class="form-group">
			      <input name="chico" type="text" class="form-control" id="chico" value="<? echo"$res[5]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">C-M </div></td>
			    <td><span class="form-group">
			      <input name="mediano" type="text" class="form-control" id="mediano" value="<? echo"$res[6]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">C-G </div></td>
			    <td><span class="form-group">
			      <input name="grande" type="text" class="form-control" id="grande" value="<? echo"$res[7]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde"><div align="center">C-XG </div></td>
			    <td><span class="form-group">
			      <input name="xtra" type="text" class="form-control" id="xtra" value="<? echo"$res[8]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
			    <td class="verde">&nbsp;</td>
			    <td class="verde"><div align="center">OTRO</div></td>
			    <td><span class="form-group">
			      <input name="otro" type="text" class="form-control" id="otro" value="<? echo"$res[13]";?>" size="10" maxlength="10" placeholder="" required>
			    </span></td>
		    </tr>
			  <tr class="">
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
