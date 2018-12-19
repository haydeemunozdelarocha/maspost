<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse | Búsqueda</title>
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
.style11 {color: #FFFFFF}
.style10 {color: #FF0000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
        </style>

<script>
function buscar()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
   }
  }
xmlhttp.open("GET","buscarpmb.php?id="+document.form1.pmb.value,true);
xmlhttp.send();
}
function valida(){
	if(document.form1.pmb.value=="")
	{
		alert("No escribio PMB");
		document.form1.pmb.focus();
		return false;
	}
	else
	{
		if(document.form1.peso.value=="" && document.form1.paqueteria[1].checked)
		{
			alert("No escribio peso");
			document.form1.peso.focus();
			return false;
		}
		else
		{
			if(document.form1.ubicacion.value=="0")
			{
				alert("No selecciono ubicacion");
				document.form1.ubicacion.focus();
				return false;
			}
			else
			{
				if(document.form1.tracking.value=="")
				{
					alert("No capturo tracking number ");
					document.form1.tracking.focus();
					return false;
				}else
				{
					var sele=0;
					if(document.form1.nombre)
					{
						if(document.form1.nombre.checked)
						{

									sele=1;
						}
						else
						{
							for (i=0;i<document.form1.nombre.length;i++) {
								if (document.form1.nombre[i].checked)
									sele=1;
							}
						}
					}
					if(sele==0 && document.form1.pmb.value!="50")
					{
						alert("Debe seleccionar cliente ");
						document.form1.pmb.focus();
						return false;
					}
				}

			}
		}
	}
}
</script>
</head>
<?

include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
$traking= $_GET["traking"];
?>

  <body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">


       <?php  if($_SESSION['tipoU']=="0"){
include "menu_fu.php";
}else if($_SESSION['tipoU']=="1"){
include "menu_f.php";    }?>
        </nav>
    </header> <!-- /. main-header -->

    <article class="barra-menu">

    </article><!-- /. barra-menu -->

 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <form name="form1" method="get" action="">

          <table width="1031" align="center" cellspacing="2" class="">

            <tbody>
              <tr class="">
                <td bgcolor="#CCCCCC"  ><table width="1056" class="tablesorter" id="myTable">
                    <thead>
                      <tr>
                        <th height="30" colspan="13" bgcolor="#313630"><div align="right"><span class="style11">Tracking</span><span class="style10">
                            <input name="traking" type="text" id="traking" size="45" maxlength="100" onKeyPress="return maskKeyPress22(event)"/>
                            <span class="style5">
                            <input name="Buscar" type="submit" id="Buscar"  value="buscar">
                            </span>                        </span></div></th>
                      </tr>
                      <tr>
                        <th width="6%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Fecha</div></th>
                        <th width="5%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Entrada</div></th>
                        <th width="5%" bgcolor="#313630" class="h5 style11"><div align="center">Salida</div></th>
                        <th width="11%" bgcolor="#313630" class="h5"><div align="center" class="style11"> Tipo</div></th>
                        <th width="12%" bgcolor="#313630" class="h5"><div align="center" class="style11"> From</div></th>
                        <th width="11%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                            <div align="center"> Recibe</div>
                        </div></th>
                        <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                            <div align="center"> Fletera</div>
                        </div></th>
                        <th width="7%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                            <div align="center"> Tracking No. </div>
                        </div></th>
                        <th width="6%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                            <div align="center"> Costo</div>
                        </div></th>
                        <th width="6%" bgcolor="#313630" class="h5"><div align="left" class="style11">
                            <div align="center"> Extra</div>
                        </div></th>
                        <th width="5%" bgcolor="#313630" class="h5"><div align="center" class="style11"> COD</div></th>
                        <th width="7%" bgcolor="#313630" class="style11">Ubicacion</th>
                        <th width="12%" bgcolor="#313630"><div align="center" class="style11">Entregado</div></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?




	if($traking!=""){

	$consulta="select recepcion.nombre, recepcion.fromm, date_format(recepcion.fecha_recepcion, '%d/%m/%Y'), tipo_entradas.nombre, fleteras.nombre, recepcion.peso, recepcion.traking, ubicacion.nombre, recepcion.costo, usuarios.nombre, recepcion.entrada, TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) as meses, TIMESTAMPDIFF(DAY,DATE_ADD(fecha_recepcion,INTERVAL TIMESTAMPDIFF(MONTH, fecha_recepcion, now()) MONTH), now()) as dias, recepcion.tipo, recepcion.cod, planes.tabla_pallets, recepcion.id_salida, recepcion.extra, recepcion.pmb,recepcion.id_salida from recepcion inner join tipo_entradas on recepcion.tipo=tipo_entradas.id inner join fleteras on fleteras.id=recepcion.fletera inner join ubicacion on ubicacion.id=recepcion.ubicacion inner join usuarios on usuarios.id=recepcion.id_empleado_recibe inner join clientes on clientes.pmb=recepcion.pmb inner join planes on clientes.id_plan=planes.id where traking like '%$traking%'  order by recepcion.fecha_recepcion";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$count=1;
	$conta=0;
	$color="FFFFFF";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$extra=$res[17];
		$texto_extra="";
		$res=mysql_fetch_row($resultado);
		$length = strlen($res[6]);
		$length = $length-4;
		$track = substr($res[6] , $length ,4);
		$peso=$res[5];
		$dias=$res[12];
		$meses=$res[11];
		$tipo=$res[13];
		$cod=$res[14];
		$costo=$res[8];
		$tabla_pallets=$res[15];
		$id_salida=$res[16];
		$pmb=$res[18];

		if($id_salida=="0")
		{
		$entregado="No";
		if($tipo=="7")//si es pallet calcula el costo segun los dias transcurridos
		{
			$consulta3  = "select sobres, paquetes from tablas  where tipo=$tabla_pallets and c1<=$peso and c2>$peso ";
			//echo"$consulta3";
			$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
			if(@mysql_num_rows($resultado3)>=1)
			{
				$res3=mysql_fetch_row($resultado3);
				$quince=$res3[0];
				$completo=$res3[1];
				$costo_pallet=$meses*$completo;
				if($dias>15)
					$costo_pallet2=$completo;
				else
					$costo_pallet2=$quince;
				$costo=$costo_pallet+$costo_pallet2;
				//echo"costo=$costo";
			}

		}else // si no es pallet calcula los meses trascurridos y si es mas de 1 se cobra extra.
		{
			if($meses >0)
				$extra=$meses*$res[8];
		}

		}else
		{
			$entregado="Si";
		}

		?>
                      <tr bgcolor="#<? echo"$color";?>">
                        <td><div align="center"><? echo"$res[2]";?></div></td>
                        <td><div align="center"><? echo"$res[10]";?></div></td>
                        <td><div align="center"><a href="ver_entrega.php?id=<?echo"$res[19]";?>" target="_blank"><? echo"$res[19]";?></a></div></td>
                        <td><div align="center"><? echo"$res[3]";?></div></td>
                        <td><div align="center"><? echo"$res[1]";?></div></td>
                        <td><div align="center"><? echo"$pmb $res[0]";?></div></td>
                        <td><div align="center"><? echo"$res[3]";?><br>
                                <? echo"$res[4]";?></div></td>
                        <td><div align="center"><? echo"$track";?></div></td>
                        <td><div align="center"><? echo"$costo";?>
                                <input name="costo" type="hidden" id="costo" value="<? echo"$costo";?>" />
                                <input name="costo<? echo"$res[10]";?>" type="hidden" id="costo<? echo"$res[10]";?>" value="<? echo"$costo";?>" />
                                <input name="extra2" type="hidden" id="extra2" value="<? echo"$extra";?>" />
                                <input name="conta<? echo"$res[10]";?>2" type="hidden" id="conta<? echo"$res[10]";?>2" value="<? echo"$extra";?>" />
                        </div></td>
                        <td><div align="center"><? echo"$extra";?></div></td>
                        <td><div align="center"><? echo"$cod";?></div></td>
                        <td><div align="center"><? echo"$res[7]";?></div></td>
                        <td><div align="center"><? echo"$entregado";?></div></td>
                      </tr>
                      <?
			   $count=$count+1;
			   $conta++;
			   if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
	}


	}

?>
                    </tbody>
                  </table>
                <p>&nbsp;</p></td>
              </tr>
              <tr class="">
                <td bgcolor="#CCCCCC"  >&nbsp;</td>
              </tr>
            </tbody>
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
	<script>
	<?
if($pmb!="")
echo" document.form1.pmb.value=$pmb; buscar();";
?>
</script>
<script>setTimeout(function() { document.form1.pmb.focus(); }, 10);</script>
  </body>
</html>
