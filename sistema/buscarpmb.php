
  


<?
include "coneccion.php";
$id=$_GET["id"];

	
	$cadena="";
	$consulta  = "SELECT c_recibir.nombre, c_recibir.app, c_recibir.apm, c_recibir.id, c_recibir.email, clientes.id_plan, planes.tabla_paquetes, tabla_envios, tabla_pallets, cajas_incluidos from clientes inner join c_recibir on clientes.pmb=c_recibir.pmb inner join planes on clientes.id_plan=planes.id where c_recibir.pmb = $id order by c_recibir.nombre";	
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	$cadena="<select name=\"nombre\" id=\"nombre\"><option value=\"0\">--Seleccione--</option>";
	while(@mysql_num_rows($resultado)>=$count)
	{		
		
		$res=mysql_fetch_row($resultado);		
		$nombre="$res[0] $res[1] $res[2]";
		
		$plan=$res[5];
		
		
		$cadena=" $cadena    <option value=\"$nombre|$res[3]|$res[4]\">$nombre</option>";
		$count++;	    
		
	}
	$consulta2  = "SELECT xtra FROM tablas where tipo=$res[6]";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
	if(@mysql_num_rows($resultado2)>=1)
	{
		$res2=mysql_fetch_row($resultado2);
		$grande=$res2[0];
	}		
		$cadena= "$cadena </select><input name=\"plan\" type=\"hidden\" id=\"plan\" value=\"$plan\"><input name=\"tabla1\" type=\"hidden\" id=\"tabla1\" value=\"$res[6]\"><input name=\"tabla2\" type=\"hidden\" id=\"tabla2\" value=\"$res[7]\"><input name=\"tabla3\" type=\"hidden\" id=\"tabla3\" value=\"$res[8]\"><input name=\"costo_grande\" type=\"hidden\" id=\"costo_grande\" value=\"$grande\">";
		
			$consulta3  = "SELECT count(id), sum(peso) FROM recepcion where pmb=$id and MONTH(fecha_recepcion)= MONTH(CURRENT_TIMESTAMP) and YEAR(fecha_recepcion)= YEAR(CURRENT_TIMESTAMP) and tipo<>7";
			$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
			if(@mysql_num_rows($resultado3)>=1)
			{
				$res3=mysql_fetch_row($resultado3);
				$numero_recepciones=$res3[0];	
			}else
			{
				$numero_recepciones=0;
		
			}
		if($res[9]>0)
			$cadena="$cadena <br>Paquetes permitidos: $res[9]<br>Paquetes del mes:$numero_recepciones";
		else
			$cadena="$cadena <br>Paquetes del mes:$numero_recepciones";
		
		echo"$cadena";
	if($count==0)
	echo"No se encontro";
	
?>
	
	
	
	



</body>
</html>
