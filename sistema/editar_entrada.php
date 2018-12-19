<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Maspost & Warehouse</title>
        <meta name="description" content="">
        
        
        <style type="text/css">
<!--
.style10 {font-size: 16px}
.style15 {color: #000000; }
-->
        </style>
		<script>
function borrar1()
{
  if(confirm("Esta seguro de borrar esta entrada?"))
  {
      return true;
   }else
   	return false;
}
</script>
</head>
<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";

$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
$id=$_GET['id'];
$origen=$_GET['origen'];
if($_POST['guardar']=="Guardar"){
		$id=$_POST['id'];
		$origen=$_POST['origen'];
		$pmb=$_POST['pmb'];
		$cod=$_POST['cod'];
		$fecha=$_POST['fecha'];
		$fecha_temp=explode("/", $fecha);
		$fecha="$fecha_temp[2]/$fecha_temp[0]/$fecha_temp[1]";
		$consulta3="update recepcion set fecha_recepcion='$fecha', nombre='".$_POST['nombre']."', tipo='".$_POST['tipo']."', fletera='".$_POST['fletera']."', peso=".$_POST['peso'].", traking='".$_POST['tracking']."', costo=".$_POST['costo'].", extra=".$_POST['extra'].", fromm='".$_POST['fromm']."', id_salida ='".$_POST['salida']."', no_paquetes='".$_POST['paquetes']."', no_paquetes_resto='".$_POST['paquetes2']."', pmb='".$_POST['pmb']."', cod='".$_POST['cod']."', ubicacion=".$_POST['ubicacion']." where id=$id";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		
		
		if($origen==1)
		echo"<script>alert(\"Entrada Cambiada\");parent.location=\"entrega.php?pmb=$pmb\";</script>";
		else if($origen==2)
			echo"<script>alert(\"Entrada Cambiada\");parent.location=\"entrega_dia.php?pmb=$pmb\";</script>";
		else if($origen==3)
			echo"<script>alert(\"Entrada Cambiada\");parent.location=\"salidas_dia.php?pmb=$pmb\";</script>";
	
}
if($_POST['borrar']=="Borrar"){
		$id=$_POST['id'];
		$pmb=$_POST['pmb'];
		$origen=$_POST['origen'];
		$consulta3="delete from recepcion where id=$id";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		
		if($origen==1)
		echo"<script>alert(\"Entrada Borrada\");parent.location=\"entrega.php?pmb=$pmb\";</script>";
		else if($origen==2)
			echo"<script>alert(\"Entrada Borrada\");parent.location=\"entrega_dia.php?pmb=$pmb\";</script>";
		else if($origen==3)
			echo"<script>alert(\"Entrada Borrada\");parent.location=\"salidas_dia.php?pmb=$pmb\";</script>";
}
$consulta  = "select date_format(recepcion.fecha_recepcion, '%m/%d/%Y'), nombre, tipo, fletera, peso, traking, costo, extra, fromm, id_salida,pmb, no_paquetes_resto, no_paquetes,cod, ubicacion from recepcion where id=$id";
//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	if(@mysql_num_rows($resultado)>0)
	{
		$res=mysql_fetch_row($resultado);
	}

?>

  <body><!-- /. main-header -->
  <!-- /. barra-menu -->

      <div >
        <div >
          <div align="center">
            <form action="" method="post" name="form1">
              <p>EDITAR ENTRADA</p>
              <table width="488" align="center" class="">
                <tr class="">
                  <td width="131">Fecha 
                    <input name="id" type="hidden" id="id" value="<? echo"$id";?>">
                    
                    <input name="origen" type="hidden" id="origen" value="<? echo"$origen";?>"></td>
                  <td colspan="3"><div class="form-group">
                      <input name="fecha" type="text" class="form-control" id="fecha" value="<? echo"$res[0]";?>"  >
                  </div></td>
                </tr>
                <tr class="">
                  <td class="style15">PMB</td>
                  <td colspan="3"><span class="form-group">
                    <input name="pmb" type="text" class="form-control" id="pmb" value="<? echo"$res[10]";?>" size="10" maxlength="10"  >
                  </span></td>
                </tr>
                <tr class="">
                  <td class="style15">Entrada a nombre de </td>
                  <td colspan="3"><div class="form-group">
                      <input name="nombre" type="text" class="form-control" id="nombre" value="<? echo"$res[1]";?>" size="20" maxlength="100"  >
                  </div></td>
                </tr>
                <tr class="">
                  <td>Tipo </td>
                  <td colspan="3"><span class="style10">
                    <select name="tipo" class="texto_verde" id="select5">
                      <option value="0">--Selecciona Tabla--</option>
                      <?	  

	
	
	$consulta2  = "SELECT id, nombre FROM tipo_entradas ";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count2=1;
	
	while(@mysql_num_rows($resultado2)>=$count2)
	{
		$res2=mysql_fetch_row($resultado2);
		if($res2[0]==$res[2])
		echo"<option value=\"$res2[0]\" selected>$res2[1]</option>";
		else
		echo"<option value=\"$res2[0]\" >$res2[1]</option>";
		$count2=$count2+1;
	}	
		
		?>
                    </select>
                  </span></td>
                </tr>
                <tr class="">
                  <td>Fletera </td>
                  <td colspan="3"><span class="style10">
                    <select name="fletera" class="texto_verde" id="fletera">
                      <option value="0">--Selecciona Tabla--</option>
                      <?	  

	
	
	$consulta2  = "SELECT id, nombre FROM fleteras order by nombre";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count2=1;
	
	while(@mysql_num_rows($resultado2)>=$count2)
	{
		$res2=mysql_fetch_row($resultado2);
		if($res2[0]==$res[3])
		echo"<option value=\"$res2[0]\" selected>$res2[1]</option>";
		else
		echo"<option value=\"$res2[0]\" >$res2[1]</option>";
		$count2=$count2+1;
	}	
		
		?>
                    </select>
                  </span></td>
                </tr>
                <tr class="">
                  <td><span class="style15">Peso</span></td>
                  <td colspan="3"><span class="form-group">
                    <input name="peso" type="text" class="form-control" id="peso" value="<? echo"$res[4]";?>" size="10" maxlength="10"  >
                  </span></td>
                </tr>
				 <tr class="">
                  <td><span class="style15">Tracking</span></td>
                  <td colspan="3"><span class="form-group">
                    <input name="tracking" type="text" class="form-control" id="tracking" value="<? echo"$res[5]";?>" size="40" maxlength="50"  >
                  </span></td>
                </tr>
                <tr class="">
                  <td>Costo</td>
                  <td width="111"><span class="form-group">
                    <input name="costo" type="text" class="form-control" id="costo" value="<? echo"$res[6]";?>" size="10" >
                  </span></td>
                  <td width="100"><div align="right">Extra</div></td>
                  <td width="126"><span class="form-group">
                    <input name="extra" type="text" class="form-control" id="extra" value="<? echo"$res[7]";?>" size="10"  >
                  </span></td>
                </tr>
				 <tr class="">
				   <td>COD</td>
				   <td colspan="3"><span class="form-group">
				     <input name="cod" type="text" class="form-control" id="cod" value="<? echo"$res[13]";?>" size="10" >
				   </span></td>
			    </tr>
				 <tr class="">
                  <td>From </td>
                  <td colspan="3"><span class="form-group">
                    <input name="fromm" type="text" class="form-control" id="fromm" size="40" maxlength="100" value="<? echo"$res[8]";?>" >
                  </span></td>
                </tr>
				 <tr class="">
                  <td>Salida </td>
                  <td colspan="3"><span class="form-group">
                    <input name="salida" type="text" class="form-control" id="salida" size="10" maxlength="10" value="<? echo"$res[9]";?>" >
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde"><div align="left">Paquetes </div></td>
                  <td class="verde"><span class="form-group">
                    <input name="paquetes" type="text" class="form-control" id="paquetes" size="10" maxlength="10" value="<? echo"$res[9]";?>" >
                  </span></td>
                  <td class="verde">Pkt Restantes </td>
                  <td class="verde"><span class="form-group">
                    <input name="paquetes2" type="text" class="form-control" id="paquetes2" size="10" maxlength="10" value="<? echo"$res[9]";?>" >
                  </span></td>
                </tr>
                <tr class="">
                  <td class="verde">Ubicación</td>
                  <td colspan="3" class="verde"><span class="style10">
                    <select name="ubicacion" class="texto_verde" id="ubicacion">
                      <option value="0">--Selecciona Ubicacion--</option>
                      <?




	$consulta2  = "SELECT id, nombre, descripcion FROM ubicacion   ORDER BY nombre";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	while(@mysql_num_rows($resultado2)>=$count)
	{
		$res2=mysql_fetch_row($resultado2);
		if($res[14]==$res2[0])
		echo"<option value=\"$res2[0]\" selected>$res2[1]</option>";
		else
		echo"<option value=\"$res2[0]\" >$res2[1] ($res2[2])</option>";
		$count=$count+1;
	}

		?>
                    </select>
                  </span></td>
                </tr>
                <tr class="">
                  <td colspan="4" class="verde"><div align="center"> 
				  <? if($res[9]!=""){?>
                    <input name="guardar" type="submit" id="guardar" value="Guardar">
					<? }?>
                  </div></td>
                </tr>
                <tr class="">
                  <td colspan="4" class="verde"><div align="center">.</div></td>
                </tr>
                <tr class="">
                  <td colspan="4" class="verde"><div align="center">
				  <? if($res[9]!=""){?>
                    <input name="borrar" type="submit" id="borrar" value="Borrar" onClick="return borrar1();">
					<? }?>
                  </div></td>
                </tr>
              </table>
            </form>
		  </div>
        </div>
      </div>
 

    
  </body>
</html>
