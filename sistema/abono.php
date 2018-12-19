
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Blck</title><meta name="DESCRIPTION" content="">
<meta name="KEYWORDS" content="">




<style type="text/css">
<!--
.style3 {color: #FFFFFF}
.style4 {
	color: #000099;
	font-weight: bold;
}
.style5 {color: #0000FF}
.style13 {color: #000000}
.style14 {color: #FF0000}
-->
</style>
<?
session_start();
include "coneccion.php";
date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'spanish'); 
$usu=$_SESSION['idU'];




$pmb=$_GET['id'];

if(  $_POST['abonar']=="Abonar")
{
	$tc_monto= $_POST["tc_monto"];
	if($tc_monto=="")
		$tc_monto=0;
	$pmb=$_POST['pmb'];
	$abono=$_POST['abono'];
	$descuento=$_POST['descuento'];
	$abono2=$abono+$descuento;
	$tipo=$_POST['tipo'];
	$consulta3  = "SELECT  credito from clientes  where pmb = $pmb";	
	$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
	if(@mysql_num_rows($resultado3)>=1)
	{
		$res3=mysql_fetch_row($resultado3);
		$credito=$res3[0];	
		$saldo=$credito-$abono2;
	} 
	$consulta  = "insert into abonos(pmb,fecha,monto, id_usuario,tipo, descuento, name, tc_cargo, saldo) values($pmb,now(),$abono,$usu,$tipo,$descuento,'".$_POST['factura']."',$tc_monto, $saldo)";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$id_abono=  mysql_insert_id();
	$consulta  = "update clientes set credito=credito-$abono2 where pmb=$pmb ";
	$resultado = mysql_query($consulta) or die("Error en operacion1:$consulta " . mysql_error());

				
					
					echo"<script>alert(\"Abono realizado\");</script>";
					echo"<script>window.open=window.open(\"imprimir_abono.php?id=$id_abono\");</script>";
					
					
					
			
		
}

?>
<script>
function calcula(){
	document.form1.nuevo_saldo.value=document.form1.saldito.value-document.form1.abono.value-document.form1.descuento.value;
	var calcular=document.form1.nuevo_saldo.value;
	document.form1.nuevo_saldo.value=parseFloat(calcular).toFixed(2);
}
</script>
</head>
<BODY MARGINHEIGHT="0" MARGINWIDTH="0" TOPMARGIN="0" RIGHTMARGIN="0" BOTTOMMARGIN="0" LEFTMARGIN="0">
<form name="form1" method="post" action="abono.php">
  <table width="535" border="0" align="center" cellpadding="2" cellspacing="4" bgcolor="#FFFFFF">
    <tr>
      <td height="26" class="sm" style="font-size: 20px;">Abono a cuentas:</td>
    </tr>
    <tr>
      <td class="sm"><table width="100%" border="0" cellpadding="0">
          <tr>
            <td colspan="4"  scope="row"><span class="form-group">
              <select name="factura" id="factura" style="width:250px">
                                <?
						if($pmb!=""){
						$consulta  = "SELECT razon_social, razon_social2 from  clientes  where pmb = $pmb ";	
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{		
		
		$res=mysql_fetch_row($resultado);		
		$razon="$res[0]";
		$razon2="$res[1]";

		if($razon!="")
		echo"<option value=\"$razon\">$razon</option>";
		if($razon2!="")
		echo"<option value=\"$razon\">$razon2</option>";
		$count++;	    
		
	}
					  $consulta  = "SELECT nombre, app, apm from  c_recibir  where pmb = $pmb order by tipo,nombre";	
	//echo"$consulta";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P11s $consulta: ". mysql_error());
	
	$count=1;
	//$cadena="<ul>";
	while(@mysql_num_rows($resultado)>=$count)
	{		
		
		$res=mysql_fetch_row($resultado);		
		$nombre="$res[0] $res[1] $res[2]";
		echo"<option value=\"$nombre\">$nombre</option>";
		$count++;	    
		
	}
	
	//$cadena= "$cadena </ul>";
	//echo"$cadena";
	}
		?>
              </select>
            </span></td>
          </tr>
          <tr>
            <?	  
	$query = "select credito as saldo2 from clientes where pmb=$pmb";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	while($res_marca = mysql_fetch_assoc($result)){
         
		 $saldo2=$res_marca['saldo2'];
		 ?>
            <td width="13%" bgcolor="#666666" class="style3"  scope="row"><div align="center"  class="sm">Saldo</div></td>
            <td colspan="2" bgcolor="#666666" class="style3"  scope="row"><div align="left" class="sm">
              <div align="center">Abono</div>
            </div></td>
			<td bgcolor="#666666" class="style3">Nuevo Saldo </td>
            <?     
     }	
	
?>
          </tr>
          <tr>
            <td width="13%" bgcolor="#E5E5E5"  scope="row"><div align="center"  class="sm">$<? echo round($saldo2,2);?>
              <input name="saldito" type="hidden" id="saldito" value="<? echo"$saldo2";?>">
            </div></td>
            <td width="38%" bgcolor="#E5E5E5"  scope="row"><div align="left" class="sm">&nbsp;<select name="tipo" id="tipo">
                    <!-- <option value="0">--Tipo de pago--</option>-->
                    <!--<option value="1">Cargo a cuenta</option>-->
                    <option value="2">Efectivo</option>
                    <option value="3">TC</option>
                    <option value="4">Cheque</option>
                    <option value="5">Transferencia</option>
                  </select>
                  &nbsp;
                  <input name="abono" type="text" id="abono" value="0" size="5" maxlength="10" onChange="calcula()">
            </div></td>
            <td width="29%" bgcolor="#E5E5E5"  scope="row"><div align="left" class="sm">
              <div align="center"><span class="style14">Descuento</span>
                <input name="descuento" type="text" id="descuento" value="0" size="5" maxlength="10" onChange="calcula()">
                </div>
            </div></td>
            <td width="20%" bgcolor="#E5E5E5"  scope="row"><div align="center">
              <input name="nuevo_saldo" type="text" id="nuevo_saldo" value="0" size="5" maxlength="10" readonly>
            </div></td>
          </tr>
          <tr>
            <td  scope="row"><div align="center"></div></td>
            <td  scope="row">&nbsp;</td>
            <td  scope="row">&nbsp;</td>
            <td  scope="row">&nbsp;</td>
          </tr>
          <tr>
            <td  scope="row"><span class="style13">Cargo TC</span></td>
            <td  scope="row"><input name="tc_monto" type="text" id="tc_monto" value="0" size="5" maxlength="10" onChange="suma();"/></td>
            <td  scope="row"><input name="abonar" type="submit" id="abonar" value="Abonar"></td>
            <td  scope="row">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td class="sm"><table width="100%" border="0" cellpadding="0">
          <tr>
            <td colspan="4" bgcolor="#666666"  scope="row"> <span class="style3">Abonos </span>
              <input name="pmb" type="hidden" id="pmb" value="<? echo"$pmb";?>"></td>
          </tr>
          <tr>
            <td width="19%" bgcolor="#CCCCCC"  scope="row"><div align="center"  class="sm">Fecha</div></td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row"><div align="center" class="sm">Monto</div></td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row"><div align="center">Saldo</div></td>
          </tr>
          <?	  
		
	$query = "select date_format(fecha, '%m/%d/%Y') as fecha1,monto, descuento,saldo from abonos where pmb=$pmb order by fecha desc limit 6";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	$color="CCCCCC";
	$fecha1="";
	$monto="";
	while($res_pago = mysql_fetch_assoc($result)){
		$fecha1=$res_pago["fecha1"];
		$monto=$res_pago["monto"];
		$saldo=$res_pago["saldo"];
		$descuento=$res_pago["descuento"];
		?>
          <tr bgcolor="#<?  echo"$color";?> ">
            <td  class="sm">
            <div align="center"><? echo"$fecha1";?></div></td>
            <td  class="sm"><div align="center" class="style4">$<?  echo number_format(round($monto,2),2); ?> <? if($descuento>0) echo"($ $descuento)"; ?> </div></td>
            <td  class="sm"><div align="center"><span class="style4">$
              <?  echo number_format(round($saldo,2),2); ?>
            </span></div></td>
          </tr>
          <?
			 if($color=="CCCCCC")
			 	$color="FFFFFF";
			else
				$color="CCCCCC";
	}
	

	

?>
      </table></td>
    </tr>
    <tr>
      <td class="sm"><table width="100%" border="0" cellpadding="0">
        <tr>
          <td colspan="8"  scope="row"></td>
        </tr>
        <tr>
          <td colspan="7" bgcolor="#666666"  scope="row"><span class="style3">Creditos por mes </span></td>
        </tr>
        <tr>
          <td width="19%" bgcolor="#CCCCCC"  scope="row"><div align="center"  class="sm">Mes</div></td>
          <td width="17%" bgcolor="#CCCCCC"  scope="row"><div align="center" class="sm">Total  </div></td>
          <td width="17%" bgcolor="#CCCCCC"  scope="row">Pkt. Incl. </td>
          <td width="17%" bgcolor="#CCCCCC"  scope="row">Pkt. Ing </td>
          <td width="8%" bgcolor="#CCCCCC"  scope="row">Pallet</td>
          <td width="9%" bgcolor="#CCCCCC"  scope="row">Entr</td>
          <td width="9%" bgcolor="#CCCCCC"  scope="row">Salida</td>
        </tr>
        <?
		//obtiene numero de paquete en el plan
	 $consulta3  = "SELECT  cajas_incluidos, fecha_registro from clientes inner join planes on clientes.id_plan=planes.id where clientes.pmb = $pmb";	
	 $resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1.3:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$numero_paquetes=$res3[0];
			$fecha_r=$res3[1];
		}   
	//String grupo= request.getParameter("grupo");
	$query = "select MONTHNAME(fecha) as fecha , MONTH(fecha) as mes, YEAR(fecha) as anio from salidas where  fecha>='$fecha_r' and credito='1'   group by anio,mes   desc ORDER BY `anio`  DESC ";//limit 0,7 format(sum(total),2) as total 
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	$color="CCCCCC";
	$fecha="";
	$total="";
	$id_v="";
	$des="";
	$canti="";
	$preci="";
	while($res_pago = mysql_fetch_assoc($result)){
		$fecha=$res_pago["fecha"];
		//$total=$res_pago["total"];
		$id_mes=$res_pago["mes"];
		$id_year=$res_pago["anio"];
		$consulta3  = "SELECT format(sum(total),2) as total FROM salidas where pmb=$pmb and MONTH(fecha)= $id_mes and YEAR(fecha)=$id_year and credito=1";
		$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$total=$res3[0];	
		}
		$consulta3  = "SELECT format(sum(monto),2) FROM pagos where pmb=$pmb and MONTH(fecha)= $id_mes and YEAR(fecha)=$id_year and credito=1";
		$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
		if(@mysql_num_rows($resultado3)>=1)
		{
			$res3=mysql_fetch_row($resultado3);
			$total_pagos=$res3[0];	
		}
			$consulta3  = "SELECT count(id), sum(peso) FROM recepcion where pmb=$pmb and MONTH(fecha_recepcion)= $id_mes and YEAR(fecha_recepcion)=$id_year and tipo<>7";
			$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
			if(@mysql_num_rows($resultado3)>=1)
			{
				$res3=mysql_fetch_row($resultado3);
				$numero_recepciones=$res3[0];	
			}
			$consulta3  = "SELECT count(id), sum(peso) FROM recepcion where pmb=$pmb and MONTH(fecha_recepcion)= $id_mes and YEAR(fecha_recepcion)=$id_year and tipo=7";
			$resultado3 = mysql_query($consulta3) or die("La consulta fall&oacute;P1:$consulta3 " . mysql_error());
			if(@mysql_num_rows($resultado3)>=1)
			{
				$res3=mysql_fetch_row($resultado3);
				$numero_recepciones_p=$res3[0];	
			}
		?>
        <tr bgcolor="#<? echo"$color";?>">
          <td  class="sm style3"><div align="center" class="style5"><a href="estado_cuenta.php?id_mes=<?echo"$id_mes";?>&id_year=<?echo"$id_year";?>&pmb=<?echo"$pmb";?>" target="_blank"><? echo"$fecha";?></a></div></td>
          <td  class="sm style3"><div align="center" class="style5">
            <div align="right">$<? echo number_format(round($total+$total_pagos,2),2);?></div>
          </div></td>
          <td  class="style5"><div align="center"><? echo"$numero_paquetes";?></div></td>
          <td  class="style5"><div align="center"><? echo"$numero_recepciones";?></div></td>
          <td  class="style5"><div align="center"><? echo"$numero_recepciones_p";?></div></td>
          <td  class="sm style3"><div align="center"><a href="detalle_mes.php?id=<?echo"$pmb";?>&mes=<?echo"$id_mes";?>&anio=<?echo"$id_year";?>" target="_blank">Ver</a></div></td>
          <td  class="sm style3"><div align="center"><a href="salidas_mes.php?id=<?echo"$pmb";?>&mes=<?echo"$id_mes";?>&anio=<?echo"$id_year";?>" target="_blank">Ver</a></div></td>
        </tr>
        <?
		/*listGStrD = "SELECT productos.descripcion, detalle_venta.cantidad, detalle_venta.precio FROM  `detalle_venta` INNER JOIN productos ON productos.id_producto = detalle_venta.id_producto WHERE detalle_venta.id_venta ="+id_v;
		lsDatosD=stmtD.executeQuery(listGStrD);
		while(lsDatosD.next())
		{
		des=lsDatosD.getString("descripcion");
		canti=lsDatosD.getString("cantidad");
		preci=lsDatosD.getString("precio");*/
		?>
        <!-- <tr bgcolor="#<%=color%>">
            <td  class="sm"><div align="right"><%=canti%> <%=des%></div></td>
            <td  class="sm"><%=preci%></td>
          </tr>-->
        <?
	  if($color=="CCCCCC")
			 	$color="E9E9E9";
			else
				$color="CCCCCC";
	  
			
	}

?>
      </table>
       
      <table width="100%" border="0" cellpadding="0">
          <tr>
            <td colspan="4"  scope="row"></td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#666666"  scope="row"><span class="style3">Creditos</span></td>
          </tr>
          <tr>
            <td width="19%" bgcolor="#CCCCCC"  scope="row"><div align="center"  class="sm">Fecha</div></td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row"><div align="center" class="sm">Total Compra </div></td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row">&nbsp;</td>
          </tr>
          <?
	    
	//String grupo= request.getParameter("grupo");
	//$query = "select date_format(fecha, '%m/%d/%Y') as fecha, total,id from salidas where pmb=$pmb AND credito='1' order by fecha desc";
	$query = "select date_format(fecha, '%m/%d/%Y') as fecha, fecha as fechao, total,id,1 as tipo from salidas where pmb=$pmb AND credito='1' union select date_format(fecha, '%m/%d/%Y') as fecha, fecha as fechao, monto as total,factura_id as id,2 as tipo from pagos where pmb=$pmb AND credito='1' order by fechao desc limit 6";
	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	$color="CCCCCC";
	$fecha="";
	$total="";
	$id_v="";
	$des="";
	$canti="";
	$preci="";
	while($res_pago = mysql_fetch_assoc($result)){
		$fecha=$res_pago["fecha"];
		$total=$res_pago["total"];
		
		?>
          <tr bgcolor="#<? echo"$color";?>">
            <td  class="sm style3"><div align="center"><a href="<? if($res_pago['tipo']=="1")echo"imprimir_entrega2.php?id="; else echo"imprimir_pago_t.php?id=";?><? echo $res_pago['id'];?>" target="_blank"><? echo"$fecha";?></a></div></td>
            <td  class="sm style3"><div align="center" class="style5">
              <div align="right">$<? echo number_format(round($total,2),2);?></div>
            </div></td>
            <td  class="sm style3">&nbsp;</td>
          </tr>
          <?
		/*listGStrD = "SELECT productos.descripcion, detalle_venta.cantidad, detalle_venta.precio FROM  `detalle_venta` INNER JOIN productos ON productos.id_producto = detalle_venta.id_producto WHERE detalle_venta.id_venta ="+id_v;
		lsDatosD=stmtD.executeQuery(listGStrD);
		while(lsDatosD.next())
		{
		des=lsDatosD.getString("descripcion");
		canti=lsDatosD.getString("cantidad");
		preci=lsDatosD.getString("precio");*/
		?>
         <!-- <tr bgcolor="#<%=color%>">
            <td  class="sm"><div align="right"><%=canti%> <%=des%></div></td>
            <td  class="sm"><%=preci%></td>
          </tr>-->
          <?
	  if($color=="CCCCCC")
			 	$color="E9E9E9";
			else
				$color="CCCCCC";
	  
			
	}

?>
      </table></td></tr>
  </table>
  
</form></BODY></HTML>
