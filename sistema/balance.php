
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
-->
</style>
<?

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
	$consulta  = "insert into abonos(pmb,fecha,monto, id_usuario,tipo, descuento, name, tc_cargo) values($pmb,now(),$abono,$usu,$tipo,$descuento,'".$_POST['factura']."',$tc_monto)";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
	$id_abono=  mysql_insert_id();
	$consulta  = "update clientes set credito=credito-$abono2 where pmb=$pmb ";
	$resultado = mysql_query($consulta) or die("Error en operacion1:$consulta " . mysql_error());

				
					
					echo"<script>alert(\"Abono realizado\");</script>";
					echo"<script>window.open=window.open(\"imprimir_abono.php?id=$id_abono\");</script>";
					
					
					
			
		
}

?>
</head>
<BODY MARGINHEIGHT="0" MARGINWIDTH="0" TOPMARGIN="0" RIGHTMARGIN="0" BOTTOMMARGIN="0" LEFTMARGIN="0">
<form name="form1" method="post" action="abono.php">
  <table width="669" border="0" align="center" cellpadding="2" cellspacing="4" bgcolor="#FFFFFF">
    <tr>
      <td height="26" class="sm" style="font-size: 20px;"><p>Balance</p>
      </td>
    </tr>
    <tr>
      <td class="sm">&nbsp;</td>
    </tr>
    <tr>
      <td class="sm"><table width="100%" border="0" cellpadding="0">
          <tr>
            <td colspan="6" bgcolor="#666666"  scope="row">&nbsp;</td>
          </tr>
          <tr>
            <td width="19%" bgcolor="#CCCCCC"  scope="row"><div align="center"  class="sm">PMB</div></td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row"><div align="center" class="sm">Abonos</div></td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row">Creditos</td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row">Balance</td>
            <td width="17%" bgcolor="#CCCCCC"  scope="row">Saldo Cliente </td>
          </tr>
          <?	  
	$query1 = "select pmb, credito from clientes  order by pmb";
	$result1 = mysql_query($query1) or print("<option value=\"ERROR\">".mysql_error()."</option>");
	$color="CCCCCC";
	
		while($res_pago1 = mysql_fetch_assoc($result1)){
		$monto=0;
		$total=0;	
			$query2 = "select sum(monto) as monto, sum(descuento) as descuento from abonos where pmb=".$res_pago1["pmb"]." group by pmb";
			$result2 = mysql_query($query2) or print("<option value=\"ERROR\">".mysql_error()."</option>");
			
			
			while($res_pago2 = mysql_fetch_assoc($result2)){
			$monto=$res_pago2["monto"];
			$descuento=$res_pago2["descuento"];
			}
			$query3 = "select sum(total) as total from salidas where pmb=".$res_pago1["pmb"]." and credito=1 group by pmb";
			$result3 = mysql_query($query3) or print("<option value=\"ERROR\">".mysql_error()."</option>");
			
			
			while($res_pago3 = mysql_fetch_assoc($result3)){
			$total=$res_pago3["total"];
			}
			
		?>
          <tr bgcolor="#<?  echo"$color";?> ">
            <td  class="sm">
            <div align="center"><? echo $res_pago1["pmb"];?></div></td>
            <td  class="sm"><? echo number_format(round($monto+$descuento,2),2);?></td>
            <td  class="sm"><? echo number_format(round($total,2),2);?></td>
            <td  class="sm"><? echo number_format(round($total-($monto+$descuento),2),2);?></td>
            <td  class="sm"><? echo number_format(round($res_pago1["credito"],2),2);?></td>
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
      <td class="sm">&nbsp;</td>
    </tr>
  </table>
  
</form></BODY></HTML>
