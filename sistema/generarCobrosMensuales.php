
<?
include "coneccion.php";
$mes=date("m");
$year=date("Y");
	
	//bodega
	$consulta  = "SELECT clientes.pmb, planes.costo_mensual, planes.reempaque, razon_social, razon_social2, clientes.credito FROM `clientes` inner join planes on clientes.id_plan=planes.id where costo_mensual>0 and costo_anual=0  ";	//and vigencia>now()
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{				
		$res=mysql_fetch_row($resultado);
		$pmb_cobrar=$res[0];
		$costo_mes=$res[1];
		$razon=$res[3];
		$razon2=$res[4];
		$consulta3  = "SELECT  credito FROM `clientes`  where  pmb = $pmb_cobrar ";	
		$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$saldo_actual=$res3[0];
			
		}
		
		$nuevo_saldo=$saldo_actual+$costo_mes;
		
		$consulta3  = "SELECT nombre, app, apm from  c_recibir  where pmb = $pmb_cobrar and tipo=1 order by id";	
		$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$nombre="$res3[0] $res3[1] $res3[2]";
			
		}
		if($razon!="")
			$facturar=$razon;
		else if($razon2!="")
			$facturar=$razon;
		else if($nombre!="")
			$facturar=$nombre;
		$consultaFactura  = "insert into facturas_renovacion (pmb, fecha,  name, credito, tc_cargo, saldo) values ('".$pmb_cobrar."', now(),'$facturar', 1, 0,".$nuevo_saldo.")";
		$factura = mysql_query($consultaFactura) or die("Error en operacion1:  $factura" . mysql_error());
		$factura_id=  mysql_insert_id();

		$consulta4="insert into pagos (pmb, fecha,  monto, id_usuario, mes, anio, tipo,name, tc_cargo, saldo, credito, factura_id) values ('".$pmb_cobrar."', now(), '".$costo_mes."', 1, '".$mes."', '".$year."', 1,'".$facturar."', 0, $nuevo_saldo,1,".$factura_id.")";
		echo"<br>bodega PMB= $pmb_cobrar  cobro= $costo_mes";
		$resultado4 = mysql_query($consulta4) or die("Error en operacion1:  $consulta4" . mysql_error());
		$consulta5  = "update clientes set credito=$nuevo_saldo  where pmb=$pmb_cobrar ";
		echo"  Saldo anterior=$saldo_actual  saldo nuevo=$nuevo_saldo";
		$resultado5 = mysql_query($consulta5) or die("Error en operacion2:$consulta5 " . mysql_error());
		$count++;

	}
	
	//oficina
	/*$consulta  = "SELECT clientes.pmb, planes.costo_mensual, planes.reempaque, razon_social, razon_social2, clientes.credito FROM `clientes` inner join planes on clientes.id_plan=planes.id where planes.reempaque>0 and costo_anual=0  and vigencia>now() ";	
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	while(@mysql_num_rows($resultado)>=$count)
	{				
		$res=mysql_fetch_row($resultado);
		$pmb_cobrar=$res[0];
		$costo_mes=$res[2];
		$razon=$res[3];
		$razon2=$res[4];
		$saldo_actual=$res[5];
		$nuevo_saldo=$saldo_actual+$costo_mes;
		
		$consulta3  = "SELECT nombre, app, apm from  c_recibir  where pmb = $pmb_cobrar and tipo=1 order by id";	
		$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$nombre="$res3[0] $res3[1] $res3[2]";
			
		}
		if($razon!="")
			$facturar=$razon;
		else if($razon2!="")
			$facturar=$razon;
		else if($nombre!="")
			$facturar=$nombre;
		$consulta3="insert into pagos (pmb, fecha,  monto, id_usuario, mes, anio, tipo,name, tc_cargo, saldo) values ('".$pmb_cobrar."', now(), '".$costo_mes."', 1, '".$mes."', '".$year."', 3,'".$facturar."', 0, $nuevo_saldo)";
		echo"<br>oficna PMB= $pmb_cobrar  cobro= $costo_mes";
		$resultado3 = mysql_query($consulta3) or die("Error en operacion1:  $consulta3" . mysql_error());
		$consulta  = "update clientes set credito=$nuevo_saldo  where pmb=$pmb_cobrar ";
		echo"  Saldo anterior=$saldo_actual  saldo nuevo=$nuevo_saldo";
		$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
		$count++;
		
	}*/
	

?>
