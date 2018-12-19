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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
        <style type="text/css">
<!--
.style5 {color: #FFFFFF; font-size: 12px; }
.style7 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
-->
        </style>
		<script>
		$(function() {
		$( "#fecha" ).datepicker({ dateFormat: 'mm/dd/yy' });
		$( "#fecha_hasta" ).datepicker({ dateFormat: 'mm/dd/yy' });
		
		
	});
		</script>
</head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];

$fecha = date("m/d/Y");
$fecha_hasta = date("m/d/Y");

if($_POST["fecha"]!="")	
{
	$fecha= $_POST["fecha"];	
	$fecha_temp=explode("/", $fecha);
	//$fecha="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
	$fecha2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}else
{
	$fecha_temp=explode("/", $fecha);
	$fecha2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}
if($_POST["fecha_hasta"]!="")
{	
	$fecha_hasta= $_POST["fecha_hasta"];	
	$fecha_temp=explode("/", $fecha_hasta);
	//$fecha_hasta="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
	$fecha_hasta2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
}else
{
	$fecha_temp=explode("/", $fecha_hasta);
	$fecha_hasta2="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
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
      <h2> Vencimientos </h2>
      <h3 align="center">&nbsp;</h3>
  </section>
 <section class="tabla">
      <div class="container">
        <div class="table-responsive">
          <form name="form1" method="post" action="">
          
          <table width="1067" align="center" cellspacing="2" class="">
            <thead>
              <tr class="">
                <th colspan="4" scope="row"><div align="left"><span class="verde"><a href="alta_cliente.php"></a><strong> </strong></span>Fecha desde: <span class="style7">
                <input name="fecha" type="text" class="texto_verde" id="fecha" value="<?echo"$fecha";?>" size="20" maxlength="10"  />
hasta
<input name="fecha_hasta" type="text" class="texto_verde" id="fecha_hasta" value="<?echo"$fecha_hasta";?>" size="20" maxlength="10"  />
                </span><span class="style7">
                <input name="Buscar" type="submit" class="barra-menu" id="Buscar"  value="buscar">
                </span></div></th>
              </tr>
              <tr class="">
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">PMB#</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Titular</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Plan</span></div></th>
                <th bgcolor="#313630" scope="row"><div align="center"><span class="style5">Vigencia</span></div></th>
              </tr>
            </thead>
            <tbody>
              <?	  
	if($fecha2!="")
		$and=" and clientes.vigencia>='$fecha2' and clientes.vigencia<='$fecha_hasta2' ";
	else
		$and="";
	
	$consulta  = "select clientes.id, clientes.pmb, c_recibir.app, c_recibir.apm, c_recibir.nombre, DATE_FORMAT(clientes.vigencia,'%m-%d-%Y'), planes.nombre from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.tipo=1 and clientes.pmb<=1000 $and order by clientes.vigencia, clientes.pmb,c_recibir.app, c_recibir.apm, c_recibir.nombre ";
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		
		if($res[1]!=$entrada_anterior && ""!=$entrada_anterior)
			{
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
			}	
		
		?>
              <tr  bgcolor="<? echo"$color";?>">
                <td width="118" height="149" ><div align="center"><a href="editar_cliente.php?id=<? echo"$res[0]";?>"><? echo"$res[1]"; ?></a><a href="cambia_pmb.php?id=<?echo"$res[0]"?>"></a></div></td>
                <td width="406" ><a href="editar_cliente.php?id=<?echo"$res[0]"?>"><? echo"$res[2] $res[3] $res[4]"; ?></a></td>
                <td width="260"><div align="center"><? echo"$res[6]"; ?></div></td>
                <td width="263"><div align="center"><? echo"$res[5]"; ?></div></td>
              </tr>
              <?
		  
		   $count=$count+1;
		   $entrada_anterior=$res[1];
		}
		
	?>
            </tbody>
          </table>
		  </form>
        </div>
      </div>
  </section>



    <footer class="main-footer">
        <div class="footer-bottom">
            <div class="container text-right">
                mas-post @ derechos reservados 2016
        </div>
      </div>        
    </footer> <!-- main-footer -->

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
   

    <!-- Bootsrap javascript file -->
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- owl carouseljavascript file -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Template main javascript -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
