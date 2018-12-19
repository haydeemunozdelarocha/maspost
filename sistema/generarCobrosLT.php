<?
include "coneccion.php";
$dia=date("d");
$year=date("y");

	
	//pallets largo plazo
	$consulta99  = "SELECT recepcion.largo_plazo, recepcion.pmb, clientes.razon_social, clientes.razon_social2, clientes.credito, recepcion.entrada FROM `recepcion` inner join clientes on recepcion.pmb=clientes.pmb where recepcion.largo_plazo>0 and recepcion.id_salida=0 and recepcion.tipo=7 and DAY(fecha_recepcion)=$dia and fecha_entrega is null "; //	
	//echo"$consulta";
	$resultado99 = mysql_query($consulta99) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	while(@mysql_num_rows($resultado99)>=$count)
	{				
		$res=mysql_fetch_row($resultado99);
		$pmb_p=$res[1];
		$consulta3  = "SELECT credito from clientes  where pmb = $pmb_p ";	
		$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$saldo_anterior=$res3[0];
		}
		$costo_mes=$res[0];
		
		$razon=$res[2];
		$razon2=$res[3];
		$entrada=$res[5];
		$saldo_nuevo=$saldo_anterior+$costo_mes;
		$consulta3  = "SELECT nombre, app, apm from  c_recibir  where pmb = $pmb_p and tipo=1 order by id";	
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
			
		$consulta  = "insert into salidas (pmb, fecha, id_usuario, entrego, comentario, total_s, total_p, descuento, credito, total,tc, tipo, name, nuevo_saldo) values ('$pmb_p',now(), 1, 'Largo Plazo $entrada', 'Pago mensual de Pallet LP', $costo_mes, '0', '0', '1', '$costo_mes', 0, 0,'$facturar',$saldo_nuevo)";
		echo"<br>Pago mensual de Pallet entrada=$entarda LP PMB=$pmb_p  coto=$costo_mes";
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
		$id_salida=  mysql_insert_id();
		$consulta  = "insert into detalle_servicios(id_salida, id_servicio, precio, cantidad, pmb) values($id_salida, 19 , $costo_mes, 1, $pmb_p) ";
		echo"LT $consulta";
		$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
		
		$consulta  = "update clientes set credito=$saldo_nuevo  where pmb=$pmb_p ";
		echo"Saldo anterior=$saldo_anterior  saldo nuevo=$saldo_nuevo";
		$resultado = mysql_query($consulta) or die("Error en operacion2:$consulta " . mysql_error());
		$count++;		
	}	
	echo"done";

?>

