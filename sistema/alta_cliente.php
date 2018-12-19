<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Cliente Nuevo</title>
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
.style3 {color: #FFFFFF; font-weight: bold; }
-->
        </style>

<script>
function validar(){
	if(document.form1.pmb.value=="")
	{
		alert("No seleccionó PMB");
		document.form1.pmb.focus();
		return false;
	}else if(document.form1.tipo.value=="0")
	{
		alert("No seleccionó Tipo");
		document.form1.tipo.focus();
		return false;
	}else if(document.form1.plan.value=="")
	{
		alert("No seleccionó Plan");
		document.form1.plan.focus();
		return false;
	}else if(document.form1.t_nombre.value=="")
	{
		alert("No escribió Nombre del Titular");
		document.form1.t_nombre.focus();
		return false;
	}else if(document.form1.t_app.value=="")
	{
		alert("No escribió Apellido Paterno del Titular");
		document.form1.t_app.focus();
		return false;
	}else  if(1>2)
	{
		alert("No escribió Apellido Materno del Titular");
		document.form1.t_apm.focus();
		return false;
	}else  if(document.form1.t_email.value=="")
	{
		alert("No escribió Email del Titular");
		document.form1.t_email.focus();
		return false;
	}else
		return true;

}
</script>
</head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
include "SimpleImage.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
if($_POST['guardar']=="Guardar"){

	$pmb=$_POST['pmb'];

  $credito=$_POST['credito'];
  if($credito=="")
  	$credito=0;
  $credito2=$_POST['credito2'];
  if($credito2=="")
  	$credito2=0;

		$consulta3="insert into clientes (pmb, tipo, id_plan, direccion, estado, ciudad, pais, cp, email, telefono_fijo, celular, fecha_registro, password, vigencia, credito, tiene_credito) values ('".$_POST['pmb']."', '".$_POST['tipo']."', '".$_POST['plan']."', '".$_POST['direccion']."', '".$_POST['estado']."', '".$_POST['ciudad']."', '".$_POST['pais']."', '".$_POST['cp']."', '".$_POST['t_email']."', '".$_POST['telefono']."', '".$_POST['celular']."', now(), '".$_POST['pmb']."', now(), '".$credito."','".$credito2."' )";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		$id=  mysql_insert_id();

 		$consulta1  = "update pmbs set id_cliente=$id where id=".$_POST['pmb']."";
		$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());

		/////////////////////////////////////
		///	Guarda titular
			$consulta3="insert into c_recibir (pmb, no_adicional, app, apm, nombre, email, tipo) values ('".$_POST['pmb']."', '1', UPPER('".$_POST['t_app']."'), UPPER('".$_POST['t_apm']."'), UPPER('".$_POST['t_nombre']."'), '".$_POST['t_email']."', 1)";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_titular=  mysql_insert_id();


			if ($_FILES["t_visa"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="docs/visa_".$id_titular."_".$_FILES["t_visa"]["name"];
	 							$nom2="visa_".$id_titular."_".$_FILES["t_visa"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["t_visa"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_recibir set visa='$nom2' where id=$id_titular";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}
			if ($_FILES["t_ife"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="docs/ife_".$id_titular."_".$_FILES["t_ife"]["name"];
	 							$nom2="visa_".$id_titular."_".$_FILES["t_ife"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["t_ife"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_recibir set ife='$nom2' where id=$id_titular";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}
		////////////////titular

		/////////////////////////////////////
		///	Guarda adicional
		if($_POST['a_nombre']!="")
		{
			$consulta3="insert into c_recibir (pmb, no_adicional, app, apm, nombre, email, tipo) values ('".$_POST['pmb']."', '2', UPPER('".$_POST['a_app']."'), UPPER('".$_POST['a_apm']."'), UPPER('".$_POST['a_nombre']."'), '".$_POST['a_email']."', '2')";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_adicional=  mysql_insert_id();


			if ($_FILES["a_visa"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="docs/visa_".$id_adicional."_".$_FILES["a_visa"]["name"];
	 							$nom2="visa_".$id_adicional."_".$_FILES["a_visa"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["a_visa"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_recibir set visa='$nom2' where id=$id_adicional";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}
			if ($_FILES["a_ife"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="docs/ife_".$id_adicional."_".$_FILES["a_ife"]["name"];
	 							$nom2="visa_".$id_adicional."_".$_FILES["a_ife"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["a_ife"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_recibir set ife='$nom2' where id=$id_adicional";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}
		}
		////////////////adicional

		/////////////////////////////////////
		///	Guarda recoger
		if($_POST['r_nombre']!="")
		{
			$consulta3="insert into c_entregar (pmb,  app, apm,  nombre) values ('".$_POST['pmb']."',  UPPER('".$_POST['r_app']."'), UPPER('".$_POST['r_apm']."'), UPPER('".$_POST['r_nombre']."'))";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
			$id_entregar=  mysql_insert_id();


			if ($_FILES["r_visa"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="docs/visa_".$id_adicional."_".$_FILES["r_visa"]["name"];
	 							$nom2="visa_".$id_adicional."_".$_FILES["r_visa"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["r_visa"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_entregar set visa='$nom2' where id=$id_entregar";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}
			if ($_FILES["r_ife"]["error"] > 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";
  			}else {
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="docs/ife_".$id."_".$_FILES["r_ife"]["name"];
	 							$nom2="visa_".$id_titular."_".$_FILES["r_ife"]["name"];
      							$image = new SimpleImage();
      							$image->load($_FILES["r_ife"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_entregar set ife='$nom2' where id=$id_entregar";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}
		}
		////////////////entregar

		/////////////////////////////////////
		///	Guarda empresa
		if($_POST['razon']!="")
		{
			$consulta1  = "update clientes set razon_social='".$_POST['razon']."', pais='".$_POST['e_pais']."', rfc='".$_POST['rfc']."' where id=$id";
			$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());

			$consulta3="insert into c_recibir (pmb, no_adicional, app, apm, nombre, email, tipo) values ('".$_POST['pmb']."', '2', '','', UPPER('".$_POST['razon']."'), '".$_POST['t_email']."', '2')";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		}
		/////////////empresa
		echo"<script>alert(\"PMB Agregado\");</script>";
		echo"<script>parent.location=\"editar_cliente.php?id=$id\";</script>";

}
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
            <form action="" method="post" enctype="multipart/form-data" name="form1">

          <table width="995" align="center" class="">


              <tr class="">
                <td height="30" colspan="4" bgcolor="#313630" class="verde"><span class="style3">Datos Generales </span></td>
              </tr>
              <tr class="">
                <td width="135" class="verde">PMB				</td>
				<td width="384"><div class="form-group">
				  <select name="pmb"     id="pmb" >
                    <option value="">--Selecciona PMB--</option>
                    <?
						  	$query = "SELECT * from pmbs where id not in(select pmb from clientes) order by id";
                            $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                            while($io = mysql_fetch_assoc($result)){?>
                    <option value="<? echo $io['id']?>" <? echo $ob==$io['id']?"selected":""; ?> ><? echo $io['id']?></option>
                    <?
                            }
                          ?>
                  </select>
				</div>			    </td>
                <td width="130"><span class="verde">Tipo</span></td>
                <td width="326"><select name="tipo" id="tipo">
                  <option value="0">--Seleccione tipo--</option>
                  <option value="1">Persona</option>
                  <option value="2">Empresa</option>
                </select>                </td>
              </tr>
              <tr class="">
                <td class="verde">Plan</td>
                <td><span class="form-group">
                  <select name="plan"  class="texto_tareas"  id="plan" >
                    <option value="">--Selecciona Plan a contratar--</option>
                    <?
						  	$query = "SELECT * from planes  order by id";
                            $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                            while($io = mysql_fetch_assoc($result)){?>
                    <option value="<? echo $io['id']?>" <? echo $ob==$io['id']?"selected":""; ?> ><? echo $io['nombre']?> <? echo $io['costo']?></option>
                    <?
                            }
                          ?>
                  </select>
                </span></td>
                <td class="verde">Fecha de Ingreso </td>
                <td>&nbsp;</td>
              </tr>
              <tr class="">
                <td class="verde">Dirección</td>
                <td><span class="form-group">
                  <input name="direccion" type="text" class="form-control" id="direccion" placeholder="Address" required>
                </span></td>
                <td><span class="verde">Ciudad / Estado</span></td>
                <td><span class="form-group">
                  <input name="estado" type="text" class="form-control" id="estado" placeholder="City/State" required>
                </span></td>
              </tr>
              <tr class="">
                <td class="verde">Pais </td>
                <td><span class="form-group">
                  <input name="pais" type="text" class="form-control" id="pais" placeholder="Country" required>
                </span></td>
                <td><span class="verde">CP</span></td>
                <td><span class="form-group">
                  <input name="cp" type="text" class="form-control" id="cp" placeholder="Zip Code" >
                </span></td>
              </tr>
              <tr class="">
                <td class="verde">Telefono fijo </td>
                <td><span class="form-group">
                  <input name="telefono" type="text" class="form-control" id="telefono" placeholder="Phone" >
                </span></td>
                <td><span class="verde">Celular</span></td>
                <td><span class="form-group">
                  <input name="celular" type="text" class="form-control" id="celular" placeholder="Celphone" >
                </span></td>
              </tr>
              <!--<tr class="">
                <td class="verde">E-mail</td>
                <td><span class="form-group">
                  <input name="email" type="text" class="form-control" id="email" placeholder="Email" >
                </span></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>-->
              <tr class="">
                <td class="verde">Credito</td>
                <td><span class="form-group">
                  <input name="credito" type="text" class="form-control" id="credito" placeholder="Credit" >
                </span></td>
                <td class="verde"><input name="credito2" type="checkbox" id="credito2" value="1"></td>
                <td>&nbsp;</td>
              </tr>
              <tr class="">
                <td colspan="4" class="verde">&nbsp;</td>
              </tr>
			  <tr class="">
			    <td colspan="4" bgcolor="#313630" class="verde"><div align="left" class="style3">Titular</div></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><table width="100%" border="0">
                  <tr>
                    <td width="6%">Nombre</td>
                    <td width="36%"><span class="form-group">
                      <input name="t_nombre" type="text" class="form-control" id="t_nombre" placeholder="Name" required>
                    </span></td>
                    <td width="6%">Apellido Paterno </td>
                    <td width="22%"><span class="form-group">
                      <input name="t_app" type="text" class="form-control" id="t_app" placeholder="Last Name" required>
                    </span></td>
                    <td width="8%">Apellido Materno </td>
                    <td width="22%"><span class="form-group">
                      <input name="t_apm" type="text" class="form-control" id="t_apm" placeholder="" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><span class="form-group">
                      <input name="t_email" type="text" class="form-control" id="t_email" placeholder="Email" required>
                    </span></td>
                    <td>IFE</td>
                    <td><input name="t_ife" type="file" id="t_ife"></td>
                    <td>Visa</td>
                    <td><input name="t_visa" type="file" id="t_visa"></td>
                  </tr>
                </table></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" bgcolor="#313630" class="style3">Adicional</td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><table width="100%" border="0">
                  <tr>
                    <td>Nombre</td>
                    <td><span class="form-group">
                      <input name="a_nombre" type="text" class="form-control" id="a_nombre" placeholder="Name" >
                    </span></td>
                    <td>Apellido Paterno </td>
                    <td><span class="form-group">
                      <input name="a_app" type="text" class="form-control" id="a_app" placeholder="Last Name" >
                    </span></td>
                    <td>Apellido Materno </td>
                    <td><span class="form-group">
                      <input name="a_apm" type="text" class="form-control" id="a_apm" placeholder="Nombre" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><span class="form-group">
                      <input name="a_email" type="text" class="form-control" id="a_email" placeholder="Name" >
                    </span></td>
                    <td>IFE</td>
                    <td><input name="a_ife" type="file" id="a_ife"></td>
                    <td>VISA</td>
                    <td><input name="a_visa" type="file" id="a_visa"></td>
                  </tr>
                  <tr>
                    <td>#Sub</td>
                    <td><span class="form-group">
                      <input name="a_sub" type="text" class="form-control" id="a_sub" placeholder="Aditional number" >
                    </span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" bgcolor="#313630" class="style3">Quien puede recoger</td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><table width="100%" border="0">
                  <tr>
                    <td>Nombre</td>
                    <td><span class="form-group">
                      <input name="r_nombre" type="text" class="form-control" id="r_nombre" placeholder="Name" >
                    </span></td>
                    <td>Apellido Paterno </td>
                    <td><span class="form-group">
                      <input name="r_app" type="text" class="form-control" id="r_app" placeholder="Last Name" >
                    </span></td>
                    <td>Apellido Materno </td>
                    <td><span class="form-group">
                      <input name="r_apm" type="text" class="form-control" id="r_apm" placeholder="" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><span class="form-group">
                      <input name="r_email" type="text" class="form-control" id="r_email" placeholder="Email" >
                    </span></td>
                    <td>IFE</td>
                    <td><input name="r_ife" type="file" id="r_ife"></td>
                    <td>Visa</td>
                    <td><input name="r_visa" type="file" id="r_visa"></td>
                  </tr>
                </table></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" bgcolor="#313630" class="style3">Empresa</td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><table width="100%" border="0">
                  <tr>
                    <td>Razon Social </td>
                    <td><span class="form-group">
                      <input name="razon" type="text" class="form-control" id="razon" placeholder="Company" >
                    </span></td>
                    <td>RFC </td>
                    <td><span class="form-group">
                      <input name="rfc" type="text" class="form-control" id="rfc" placeholder="RFC" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Pais</td>
                    <td><select name="e_pais" id="e_pais">
                        <option value="0">--Seleccione tipo--</option>
                        <option value="1">Mexicana</option>
                        <option value="2">Americana</option>
                    </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><div align="center">
			      <input name="guardar" type="submit" id="guardar" value="Guardar" onClick="return validar()">
			      </div></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde">..</td>
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
