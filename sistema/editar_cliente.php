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
		<script>
function borrar(id)
{
  if(confirm("Esta seguro de borrar este Receptor?"))
  {
       document.form1.borrar.value=id;
	   document.form1.submit();
   }
}
function borrar2(id)
{
  if(confirm("Esta seguro de borrar esta persona que puede recoger?"))
  {
       document.form1.borrar2.value=id;
	   document.form1.submit();
   }
}
</script>
        <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #000000}
.style3 {color: #FFFFFF; font-weight: bold; }
.style4 {color: #ffffff}
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

if($_POST['guardar']=="Guardar" || $_POST['agregarAd']=="Agregar" || $_POST['agregarRe']=="Agregar"){

	$id=$_POST['id'];
	$id_titular=$_POST['id_titular'];

$credito2=$_POST['credito2'];
  if($credito2=="")
  	$credito2=0;
	
if($_POST['credito2']=="")
$tiene_credito="0";
else
$tiene_credito=$_POST['credito2'];


		$consulta3="update clientes set pmb='".$_POST['pmb']."', tipo='".$_POST['tipo']."', id_plan='".$_POST['plan']."', direccion='".$_POST['direccion']."', estado='".$_POST['estado']."', ciudad='".$_POST['ciudad']."', pais='".$_POST['pais']."', cp='".$_POST['cp']."', email='".$_POST['t_email']."', telefono_fijo='".$_POST['telefono']."', celular='".$_POST['celular']."', fecha_registro='".$_POST['fecha_registro']."', vigencia='".$_POST['vigencia']."', credito='".$_POST['credito']."', tiene_credito='".$tiene_credito."' where id='".$_POST['id']."'";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());


 		/////si agrega razon social , se agrega receptor
		if($_POST['razon_a']!=$_POST['razon'] && $_POST['razon']!="")
		{
			$consulta3="insert into c_recibir (pmb, no_adicional, app, apm, nombre, email, tipo) values ('".$_POST['pmb']."', '2', '','', UPPER('".$_POST['razon']."'), '".$_POST['t_email']."', '2')";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		}
		if($_POST['razon2_a']!=$_POST['razon2'] && $_POST['razon2']!="")
		{
			$consulta3="insert into c_recibir (pmb, no_adicional, app, apm, nombre, email, tipo) values ('".$_POST['pmb']."', '2', '','', UPPER('".$_POST['razon2']."'), '".$_POST['t_email']."', '2')";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		}
 ///////////////////////////////////////
 		$consulta1  = "update c_recibir set nombre=UPPER('".$_POST['t_nombre']."'), app=UPPER('".$_POST['t_app']."'), apm=UPPER('".$_POST['t_apm']."'), email='".$_POST['t_email']."' where id=$id_titular";
		$resultado1 = mysql_query($consulta1) or die("Error en operacion: $consulta1" . mysql_error());

 		$consulta1  = "update pmbs set id_cliente=$id where id=".$_POST['pmb']."";
		$resultado1 = mysql_query($consulta1) or die("Error en operacion: $consulta1" . mysql_error());

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
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: $consulta1" . mysql_error());
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
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: $consulta1" . mysql_error());
  			}
			/////////////////////////////////////
		///	Guarda empresa
		if($_POST['razon']!="")
		{
			$consulta1  = "update clientes set razon_social=UPPER('".$_POST['razon']."'), pais_empresa='".$_POST['e_pais']."', rfc='".$_POST['rfc']."' where id=$id";
			$resultado1 = mysql_query($consulta1) or die("Error en operacion:$consulta1 " . mysql_error());
		}
		if($_POST['razon2']!="")
		{
			$consulta1  = "update clientes set razon_social2=UPPER('".$_POST['razon2']."'), pais_empresa2='".$_POST['e_pais2']."', rfc2='".$_POST['rfc2']."' where id=$id";
			$resultado1 = mysql_query($consulta1) or die("Error en operacion:$consulta1 " . mysql_error());
		}
		if($_POST['razon_a']!="" && $_POST['razon']=="")
		{
			$consulta1  = "update clientes set razon_social=UPPER('".$_POST['razon']."'), pais_empresa='".$_POST['e_pais']."', rfc='".$_POST['rfc']."' where id=$id";
			$resultado1 = mysql_query($consulta1) or die("Error en operacion:$consulta1 " . mysql_error());
		}
		if($_POST['razon2_a']!="" && $_POST['razon2']=="")
		{
			$consulta1  = "update clientes set razon_social2=UPPER('".$_POST['razon2']."'), pais_empresa2='".$_POST['e_pais2']."', rfc2='".$_POST['rfc2']."' where id=$id";
			$resultado1 = mysql_query($consulta1) or die("Error en operacion:$consulta1 " . mysql_error());
		}
		/////////////empresa

}


////////////////////////////////////////
///Liberar PMB  hace update a todas las tablas con un nuevo PMB
if($_POST['liberar']=="Liberar PMB"){
			$pmb=$_POST['pmb'];
			$pmb=$pmb+1000;
			$consulta3="insert into pmbs (id,id_cliente) values ($pmb, 0)";
			$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());


			$consulta  = "update abonos set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update clientes set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update c_entregar set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update c_recibir set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update detalle_servicios set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			//$consulta  = "update entradas set pmb=$pmb  where pmb=".$_POST['pmb'];
			//$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update pagos set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update facturas_renovacion set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update recepcion set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update salidas set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			$consulta  = "update ventas set pmb=$pmb  where pmb=".$_POST['pmb'];
			$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
			///$consulta  = "select id from clientes where pmb=".$_POST['pmb'];
			//$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
			//if(@mysql_num_rows($resultado)>0)
			//{
			//	$res=mysql_fetch_row($resultado);
				$consulta2  = "update pmbs set id_cliente=$id  where id=$pmb";
				$resultado2 = mysql_query($consulta2) or die("Error en operacion2:$consulta2 " . mysql_error());
				$consulta2  = "update pmbs set id_cliente=0  where id=".$_POST['pmb'];
				$resultado2 = mysql_query($consulta2) or die("Error en operacion2:$consulta2 " . mysql_error());
			echo"<script>alert(\"PMB liberado\");</script>";
			//}

}
/////////////////////////////////////
		///	Guarda Adicional
if($_POST['agregarAd']=="Agregar"){

	$id=$_POST['id'];

			$consulta3="insert into c_recibir (pmb, no_adicional, app, apm, nombre, email, tipo) values ('".$_POST['pmb']."', '1', UPPER('".$_POST['a_app']."'), UPPER('".$_POST['a_apm']."'), UPPER('".$_POST['a_nombre']."'), '".$_POST['a_email']."', 2)";
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
      							$image->load($_FILES["t_ife"]["tmp_name"]);
      							$image->save($nom);

								$consulta1  = "update c_recibir set ife='$nom2' where id=$id_adicional";
								$resultado1 = mysql_query($consulta1) or die("Error en operacion: " . mysql_error());
  			}

		////////////////titular
}

/////////////////////////////////////
///	Guarda recibe
if($_POST['agregarRe']=="Agregar"){

	$id=$_POST['id'];


			$consulta3="insert into c_entregar (pmb,  app, apm,  nombre) values (UPPER('".$_POST['pmb']."'),   UPPER('".$_POST['r_app']."'), UPPER('".$_POST['r_apm']."'), '".$_POST['r_nombre']."')";
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
								$resultado1 = mysql_query($consulta1) or die("Error en operacion:$consulta1 " . mysql_error());
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
								$resultado1 = mysql_query($consulta1) or die("Error en operacion:$consulta1 " . mysql_error());
  			}



}

if($_POST['borrar']!=""){
		$consulta3="delete from c_recibir  where id=".$_POST['borrar'];
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
}
if($_POST['borrar2']!=""){
		$consulta3="delete from c_entregar  where id=".$_POST['borrar2'];
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
}

$consulta  = "select * from clientes where id=$id";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
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
      <h2> Editar Cliente </h2>
      <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form action="" method="post" enctype="multipart/form-data" name="form1">

          <table width="995" align="center" class="">


              <tr class="">
                <td height="30" colspan="4" bgcolor="#313630" class="style3">Datos Generales </td>
              </tr>
              <tr class="">
                <td width="135" class="verde">PMB				</td>
				<td width="384"><div class="form-group">
				  <select name="pmb"     id="pmb" >
                    <option value="">--Selecciona PMB--</option>
                    <?
						  	$query = "SELECT * from pmbs where  id=$res[1] order by id";
                            $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                            while($io = mysql_fetch_assoc($result)){?>
                    <option value="<? echo $io['id']?>" <? echo $res[1]==$io['id']?"selected":""; ?> ><? echo $io['id']?></option>
                    <?
                            }
                          ?>
                  </select>
				  <input name="id" type="hidden" id="id" value="<? echo $id;?>">
				  <input name="borrar" type="hidden" id="borrar">
				  <input name="borrar2" type="hidden" id="borrar2">
				</div>			    </td>
                <td width="130"><span class="verde">Tipo</span></td>
                <td width="326"><select name="tipo" id="tipo">
                  <option value="0">--Seleccione tipo--</option>
                  <option value="1" <? echo $res[12]=="1"?"selected":""; ?>>Persona</option>
                  <option value="2" <? echo $res[12]=="2"?"selected":""; ?>>Empresa</option>
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
                    <option value="<? echo $io['id']?>" <? echo $res[21]==$io['id']?"selected":""; ?> ><? echo $io['nombre']?> <? echo $io['costo']?></option>
                    <?
                            }
                          ?>
                  </select>
                </span></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr class="">
                <td class="verde">Dirección</td>
                <td><span class="form-group"><input name="direccion" type="text" class="form-control" id="direccion" value="<? echo"$res[2]";?>" placeholder="Address" >

                </span></td>
                <td><span class="verde">Estado</span></td>
                <td><span class="form-group">
                  <input name="estado" type="text" class="form-control" id="estado" value="<? echo"$res[3]";?>" placeholder="State" >
                </span></td>
              </tr>
              <tr class="">
                <td class="verde">Pais </td>
                <td><span class="form-group">
                  <input name="pais" type="text" class="form-control" id="pais" value="<? echo"$res[5]";?>" placeholder="Country" >
                </span></td>
                <td><span class="verde">Ciudad</span></td>
                <td><span class="form-group">
                  <input name="ciudad" type="text" class="form-control" id="ciudad" value="<? echo"$res[4]";?>" placeholder="Zip Code" >
                </span></td>
              </tr>
              <tr class="">
                <td class="verde">Telefono fijo </td>
                <td><span class="form-group">
                  <input name="telefono" type="text" class="form-control" id="telefono" value="<? echo"$res[8]";?>" placeholder="Phone" >
                </span></td>
                <td><span class="verde">Celular</span></td>
                <td><span class="form-group">
                  <input name="celular" type="text" class="form-control" id="celular" value="<? echo"$res[9]";?>" placeholder="Celphone" >
                </span></td>
              </tr>
              <tr class="">
                <td class="verde">Fecha de Registro</td>
                <td><span class="form-group">
                  <input name="fecha_registro" type="text" class="form-control" id="fecha_registro" value="<? echo"$res[10]";?>" placeholder="Fecha Registro" required>
                </span></td>
                <td><span class="verde">CP</span></td>
                <td><span class="form-group">
                  <input name="cp" type="text" class="form-control" id="cp" value="<? echo"$res[6]";?>" placeholder="Zip Code" >
                </span></td>
              </tr>
              <tr class="">
                <td class="verde">Vigencia</td>
                <td><span class="form-group">
                  <input name="vigencia" type="text" class="form-control" id="vigencia" value="<? echo"$res[19]";?>" placeholder="Vigencia" required>
                </span></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr class="">
                <td class="verde">Credito</td>
                <td><span class="form-group">
                  <input name="credito" type="text" class="form-control" id="credito" value="<? echo"$res[22]";?>" placeholder="Credit" >
                </span></td>
                <td><input name="credito2" type="checkbox" id="credito2" value="1" <? if($res[25]=="1") echo"checked";?>></td>
                <td><input name="guardar" type="submit" id="guardar" value="Guardar"></td>
              </tr>
              <tr bgcolor="#115C9B" class="">
                <td height="30" colspan="4" bgcolor="#313630" class="style3">Titular</td>
              </tr>
              <tr class="">
                <td colspan="4" class="verde"><?
				$consulta2  = "select * from c_recibir where pmb=$res[1] and tipo=1";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: $consulta2" . mysql_error());
	if(@mysql_num_rows($resultado2)>0)
	{
		$res2=mysql_fetch_row($resultado2);
	}
	?>
                  <table width="100%" border="0">
                  <tr>
                    <td width="6%">Nombre</td>
                    <td width="36%"><span class="form-group">
                      <input name="t_nombre" type="text" class="form-control" id="t_nombre" value="<? echo"$res2[5]";?>" placeholder="Name" required>
                    </span></td>
                    <td width="6%">Apellido Paterno </td>
                    <td width="22%"><span class="form-group">
                      <input name="t_app" type="text" class="form-control" id="t_app" value="<? echo"$res2[3]";?>" placeholder="Last Name" >
                    </span></td>
                    <td width="8%">Apellido Materno </td>
                    <td width="22%"><span class="form-group">
                      <input name="t_apm" type="text" class="form-control" id="t_apm" value="<? echo"$res2[4]";?>" placeholder="" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><span class="form-group">
                      <input name="t_email" type="text" class="form-control" id="t_email" value="<? echo"$res2[6]";?>" placeholder="Email" >
                      <input name="id_titular" type="hidden" id="id_titular" value="<? echo"$res2[0]";?>">
                    </span></td>
                    <td>IFE</td>
                    <td><p><? if($res2[7]!=""){?>
                      <a href="docs/<? echo"$res2[7]";?>" target="_blank">Ver IFE</a> <? }?>
                      </p>
                      <p>
                        <input name="t_ife" type="file" id="t_ife">
                      </p></td>
                    <td>Visa</td>
                    <td><p>
                      <? if($res2[8]!=""){?>
                       <a href="docs/<? echo"$res2[8]";?>" target="_blank">Ver VISA</a>
                      <? }?>

                      </p>
                      <p>
                        <input name="t_visa" type="file" id="t_visa">
                      </p></td>
                  </tr>
                </table>                </td>
              </tr>
			  <tr class="">
			    <td height="30" colspan="4" bgcolor="#313630" class="verde"><div align="left" class="style3">Empresa</div></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><table width="100%" border="0">
                  <tr>
                    <td><strong>Empresa 1 </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Razon Social </td>
                    <td><span class="form-group">
                      <input name="razon" type="text" class="form-control" id="razon" value="<? echo"$res[13]";?>" placeholder="Company" >
                      <input name="razon_a" type="hidden" id="razon_a" value="<? echo"$res[13]";?>">
                    </span></td>
                    <td>RFC </td>
                    <td><span class="form-group">
                      <input name="rfc" type="text" class="form-control" id="rfc" value="<? echo"$res[15]";?>" placeholder="RFC" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Pais</td>
                    <td><select name="e_pais" id="e_pais">
                        <option value="0">--Seleccione tipo--</option>
                        <option value="1" <? echo $res[14]=="1"?"selected":""; ?>>Mexicana</option>
                        <option value="2" <? echo $res[14]=="2"?"selected":""; ?>>Americana</option>
                    </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><strong>Empresa 2 </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Razon Social </td>
                    <td><span class="form-group">
                      <input name="razon2" type="text" class="form-control" id="razon2" value="<? echo"$res[16]";?>" placeholder="Company" >
                      <input name="razon2_a" type="hidden" id="razon2_a" value="<? echo"$res[16]";?>">
                    </span></td>
                    <td>RFC</td>
                    <td><span class="form-group">
                      <input name="rfc2" type="text" class="form-control" id="rfc2" value="<? echo"$res[17]";?>" placeholder="RFC" >
                    </span></td>
                  </tr>
                  <tr>
                    <td>Pais</td>
                    <td><select name="e_pais2" id="e_pais2">
                        <option value="0">--Seleccione tipo--</option>
                        <option value="1" <? echo $res[17]=="1"?"selected":""; ?>>Mexicana</option>
                        <option value="2" <? echo $res[17]=="2"?"selected":""; ?>>Americana</option>
                    </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
		    </tr>
			  <tr bgcolor="#115C9B" class="">
			    <td height="30" colspan="4" bgcolor="#313630" class="style3">Adicional (Receptor) </td>
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
                    <td><input name="agregarAd" type="submit" id="agregarAd" value="Agregar"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6"><table width="100%" border="0" cellspacing="1">
                        <tr>
                          <td width="43%" bgcolor="#313630" class="h5"><span class="style1">Nombre</span></td>
                          <td width="40%" bgcolor="#313630" class="h5"><span class="style1">Email</span></td>
                          <td width="13%" bgcolor="#313630" class="h5"><span class="style1">Sub</span></td>
                          <td width="4%" bgcolor="#313630"><span class="style1"></span></td>
                        </tr>
                        <?
						  	$querya = "SELECT * from c_recibir where pmb=$res[1] and activo=1 and tipo=2 order by no_adicional";
                            $resulta = mysql_query($querya) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                            while($ad = mysql_fetch_assoc($resulta)){?>
                        <tr>
                          <td bgcolor="#E8E8E8"><span class="style5"><? echo $ad['nombre']?> <? echo $ad['app']?> <? echo $ad['apm']?></span></td>
                          <td bgcolor="#E8E8E8"><span class="style5"><? echo $ad['email']?></span></td>
                          <td bgcolor="#E8E8E8"><div align="center" class="style5"><? echo $ad['no_adicional']?></div></td>
                          <td bgcolor="#E8E8E8"><a href="javascript:borrar(<? echo $ad['id'];?>)"><img src="images/close.gif" width="15" height="13" border="0" /></a></td>
                        </tr>

                        <?
                            }
                          ?>
                    </table></td>
                  </tr>
                </table></td>
		    </tr>
			  <tr bgcolor="#115C9B" class="">
			    <td height="30" colspan="4" bgcolor="#313630" class="style1"><strong>Quien puede recoger</strong></td>
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
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input name="agregarRe" type="submit" id="agregarRe" value="Agregar"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6"><table width="100%" border="0" cellspacing="1">
                        <tr>
                          <td width="43%" bgcolor="#313630"><span class="h5 style4">Nombre</span></td>
                          <td width="13%" bgcolor="#313630"><span class="h5 style4">Sub</span></td>
                          <td width="4%" bgcolor="#313630"><span class="style1"></span></td>
                        </tr>
                        <?
						  	$querya = "SELECT * from c_entregar where pmb=$res[1] and activo=1 order by nombre, app";
                            $resulta = mysql_query($querya) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                            while($ad = mysql_fetch_assoc($resulta)){?>
                        <tr>
                          <td bgcolor="#E8E8E8"><span class="style5"><? echo $ad['nombre']?> <? echo $ad['app']?> <? echo $ad['apm']?></span></td>
                          <td bgcolor="#E8E8E8"><div align="center" class="style5"><? echo $ad['no_adicional']?></div></td>
                          <td bgcolor="#E8E8E8"><a href="javascript:borrar2(<? echo $ad['id'];?>)"><img src="images/close.gif" width="15" height="13" border="0" /></a></td>
                        </tr>
                        <option value="<? echo $io['id']?>" <? echo $res[1]==$io['pmb']?"selected":""; ?> ><? echo $io['id']?></option>
                        <?
                            }
                          ?>
                    </table></td>
                  </tr>
                </table></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><div align="center">
			      <input name="guardar" type="submit" id="guardar" value="Guardar">
			    </div></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="tooltip-inner"><a href="uspsn.php?id=<?echo"$id"; ?>" target="_blank">Ver contrato de USPS </a></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde">&nbsp;</td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde"><div align="center">
			      <input name="liberar" type="submit" id="liberar" value="Liberar PMB">
		        </div></td>
		    </tr>
			  <tr class="">
			    <td colspan="4" class="verde">.</td>
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
