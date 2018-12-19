<?
include "coneccion.php";
$tipo=$_GET["tipo"];
$remesa=$_GET["remesa"];
$pmb=$_GET["pmb"];
$peso=$_GET["peso"];
$cuantos=$_GET["cuantos"];
$cuantos++;
	
	$cadena="";
	$consulta  = "SELECT  planes.tabla_paquetes, tabla_envios, tabla_pallets,cajas_incluidos, remesa from clientes  inner join planes on clientes.id_plan=planes.id where pmb = $pmb ";	
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	$cadena="<ul>";
	if(@mysql_num_rows($resultado)>=1)
	{		
		
		$res=mysql_fetch_row($resultado);
		$tabla1=$res[0];
		$tabla2=$res[1];
		$tabla3=$res[2];	
		$c_incluidas=$res[3];	
		$remesa_p=$res[4];
	}
	//consulta el numero e paquetes recibidos ese mes para poder buscar el costo segun el numero
	$consulta2  = "SELECT count(id), sum(peso) FROM recepcion where pmb=$pmb and MONTH(fecha_recepcion)= MONTH(CURRENT_TIMESTAMP) and YEAR(fecha_recepcion)= YEAR(CURRENT_TIMESTAMP) and tipo<>7";
	$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
	if(@mysql_num_rows($resultado2)>=1)
	{
		$res2=mysql_fetch_row($resultado2);
		if($remesa=="1" && $remesa_p=="0")
		$numero_recepciones=$res2[0]+$cuantos;
		else
		$numero_recepciones=$res2[0];
		$actual_peso=$res2[1];		
	}else
	{
		$numero_recepciones=0;
		$actual_peso=0;	
	}
	$numero_recepciones++;
	if($numero_recepciones>$c_incluidas || $tipo==7)
	{
	if($remesa=="1" && $remesa_p=="1")
			$tipo_plan_cobro="8";
	else
	{
		if($tipo!="7")
			$tipo_plan_cobro=$tabla1;
		else if($tipo=="7")
			$tipo_plan_cobro=$tabla3;
		
	}
	if($tipo=="7")
	$consulta2  = "SELECT * FROM tablas where tipo=$tipo_plan_cobro and c1<=$peso and c2>=$peso";
	else
	{
	if($tipo_plan_cobro=="8")
	$consulta2  = "SELECT * FROM tablas where tipo=$tipo_plan_cobro and c1<=$cuantos and c2>=$cuantos";
	else
	$consulta2  = "SELECT * FROM tablas where tipo=$tipo_plan_cobro and c1<=$numero_recepciones and c2>=$numero_recepciones";
	
	}
		$resultado2 = mysql_query($consulta2) or die("La consulta fall&oacute;P1:$consulta2 " . mysql_error());
		if(@mysql_num_rows($resultado2)>=1)
		{
			$res2=mysql_fetch_row($resultado2);
			$sobres=$res2[3];//1 
			$paquetes=$res2[4];//2
			$c_chicas=$res2[5];//3
			$c_mediana=$res2[6];//4
			$c_grande=$res2[7];//5
			$xtra=$res2[8];//6
			$paquete_g=$res2[10];//8
			$sobre_g=$res2[11];//9
			$c_xtrachicas=$res2[12];//10
			$otro=$res2[13];//11
			$base=$res2[9];
			$sp_xtrachicas=$res2[14];//12
			
			if($tipo=="1")
				$costo=$sobres;
			else if($tipo=="2")
				$costo=$paquetes;
			else if($tipo=="8")
				$costo=$paquete_g;
			else if($tipo=="9")
				$costo=$sobre_g;
			else if($tipo=="10")
				$costo=$c_xtrachicas;
			else if($tipo=="3")
				$costo=$c_chicas;
			else if($tipo=="4")
				$costo=$c_mediana;
			else if($tipo=="5")
				$costo=$c_grande;
			else if($tipo=="11")
				$costo=$otro;
			else if($tipo=="12")
				$costo=$sp_xtrachicas;
			else if($tipo=="7")
			{
				
					$costo=$sobres;
				
			}
			else if($tipo=="6")
			{
					$costo=$xtra;
			}
		}
		echo"$costo";
	}
	else
		
		
		echo"0";
?>