<? 
session_start();
include "checar_sesion_admin.php";

include "coneccion.php";
$id=$_GET["id"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>usps.jpg</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}body {
	margin-left: 0px;
	margin-top: 0px;
}
body,td,th {
	font-size: 14px;
}
</style>
<!--Fireworks 8 Dreamweaver 8 target.  Created Mon Jan 02 11:44:41 GMT-0700 2012-->
</head>

<?				
	
/*	$consulta="SELECT nombre, fecha_registro, direccion, ciudad, pais, estado, cp, telefono_fijo, razon_social,"; //idcliente
	$resultado = mysql_query($consulta) or die("consulta $consulta: ". mysql_error());
	
	if(@mysql_num_rows($resultado)>=1)
	{			
		$res=mysql_fetch_row($resultado);
		//$fecha=$res[3];
		$fecha_ll = explode('-', $res[3]);
		$fecha="$fecha_ll[1]-$fecha_ll[2]-$fecha_ll[0]";
		$nombre=$res[4];
		$address=$res[5];
		$delivery=$res[6];
		$restricted=$res[8];
		$applicant=$res[9];
		$home_address=$res[10];
		$telephone=$res[11];
		$id1=$res[12];
		$id2=$res[13];
		$firm=$res[14];
		$b_address=$res[15];
		$kind=$res[16];
		$members=$res[17];
		$corp_name=$res[18];
		$n15=$res[19];
		$tipo_id1=$res[28];
		$tipo_id2=$res[30];
						
	}else
	echo"No se encontro";	
	
	
	
	$consulsuite  = "SELECT numero FROM suites WHERE id_sucursal=$sucursal and id_cliente=$id"; //idcliente
	$resulsuite = mysql_query($consulsuite) or die("consulsuite $consulta: ". mysql_error());
	if(@mysql_num_rows($resulsuite)>=1)
	{		
		$cadena="<ul>";
		$res=mysql_fetch_row($resulsuite);				
		$pmb=$res[0];										        
	}else
	echo"No se encontro";
	
	$consulta_cli  = "SELECT ciudad, estado, cp, ciudad_trabajo, estado_trabajo, cp_trabajo, telefono_trabajo FROM clientes WHERE id=$id"; 
	$resultado_cli = mysql_query($consulta_cli) or die("consulta_cli1:  $consulta_cli: ". mysql_error());	
	if(@mysql_num_rows($resultado_cli)>=1)
	{		
		$res=mysql_fetch_row($resultado_cli);				
		$ciudad=$res[0];
		$edo=$res[1];
		$cp=$res[2];
		$cdtra=$res[3];
		$edotra=$res[4];
		$cptra=$res[5];
		$tel_tra=$res[6];
		
		
		$address="$pmb <br> $direccionsuc <br> $ciudadsuc , $estadosuc  $cpsuc";
		$addresdeliv="$direccionsuc <br> $ciudadsuc , $estadosuc  $cpsuc";						        
	}else
	echo"No se encontro";*/
?>


<body bgcolor="#ffffff">
<table width="691" border="0" cellpadding="0" cellspacing="0" >
  
  <tr>
    <td width="31">&nbsp;&nbsp;</td>
    <td width="31">&nbsp;&nbsp;</td>
    <td width="629"><table border="0" cellpadding="0" cellspacing="0" width="800" background="images/fondo_comun3.jpg">
      <!-- fwtable fwsrc="usps.png" fwbase="usps.jpg" fwstyle="Dreamweaver" fwdocid = "1365127019" fwnested="0" -->
      <tr>
        <td width="204"><img src="images/spacer.gif" width="190" height="1" border="0" alt="" /></td>
        <td width="52"><img src="images/spacer.gif" width="48" height="1" border="0" alt="" /></td>
        <td width="114"><img src="images/spacer.gif" width="114" height="1" border="0" alt="" /></td>
        <td width="10"><img src="images/spacer.gif" width="10" height="1" border="0" alt="" /></td>
        <td width="15"><img src="images/spacer.gif" width="4" height="1" border="0" alt="" /></td>
        <td width="105"><img src="images/spacer.gif" width="105" height="1" border="0" alt="" /></td>
        <td width="26"><img src="images/spacer.gif" width="24" height="1" border="0" alt="" /></td>
        <td width="92"><img src="images/spacer.gif" width="92" height="1" border="0" alt="" /></td>
        <td width="4"><img src="images/spacer.gif" width="4" height="1" border="0" alt="" /></td>
        <td width="4"><img src="images/spacer.gif" width="4" height="1" border="0" alt="" /></td>
        <td width="9"><img src="images/spacer.gif" width="9" height="1" border="0" alt="" /></td>
        <td width="47"><img src="images/spacer.gif" width="42" height="1" border="0" alt="" /></td>
        <td width="3"><img src="images/spacer.gif" width="3" height="1" border="0" alt="" /></td>
        <td width="105"><img src="images/spacer.gif" width="60" height="1" border="0" alt="" /></td>
        <td width="10"><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
      </tr>
      <tr>
        <td height="25" colspan="3">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td colspan="3" valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><p><span class="style2">&nbsp;</span><br />
              <br />
</p></td>
        <td colspan="4">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td colspan="3" valign="bottom"><div align="left"><? echo"$fecha"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="28" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="14">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="200" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2" colspan="5">&nbsp;</td>
        <td colspan="9"><div align="left"> 2220 Basset Ave. Suite  # <? echo"$pmb"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="36" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3" rowspan="2" valign="bottom"><div align="left">El Paso </div></td>
        <td rowspan="2" colspan="2">&nbsp;</td>
        <td colspan="3" rowspan="2" valign="bottom"><div align="left">TX</div>
          <div align="left"></div>
          <div align="center"></div></td>
        <td rowspan="2" valign="bottom"><div align="left">79901</div></td>
        <td><img src="images/spacer.gif" width="1" height="6" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5" valign="bottom"><? echo"$nombre"; ?> </td>
        <td><img src="images/spacer.gif" width="1" height="21" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5" rowspan="2" valign="bottom">&nbsp;</td>
        <td colspan="9">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="43" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9" rowspan="4" valign="top"><div align="left"><? echo"$members"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="10" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5" valign="top">MASPOST WAREHOUSE </td>
        <td><img src="images/spacer.gif" width="1" height="31" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5" valign="top"><div align="center">2220 Basset Ave.  </div></td>
        <td><img src="images/spacer.gif" width="1" height="38" border="0" alt="" /></td>
      </tr>
      <tr>
        <td valign="bottom">EL PASO </td>
        <td valign="bottom"> <div align="right">TX</div></td>
        <td colspan="3" valign="bottom"><div align="center">79901</div></td>
        <td><img src="images/spacer.gif" width="1" height="16" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5" valign="middle"><? echo"$applicant"; ?></td>
        <td colspan="9" valign="bottom"><div align="left"><? echo"$home_address"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="35" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2" colspan="5">&nbsp;</td>
        <td colspan="3" valign="middle"><div align="left"><? echo"$ciudad"; ?></div></td>
        <td colspan="5" valign="middle">
          <div align="center"><? echo"$edo"; ?></div></td>
        <td valign="middle"><div align="left"><? echo"$cp"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="37" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9" rowspan="2" valign="middle"><div align="left"><? echo"$telephone"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="30" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3" rowspan="2" valign="top"><? echo"$tipo_id1 $id1"; ?></td>
        <td rowspan="10" colspan="2">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="2" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9" valign="middle"><div align="left"><? echo"$firm"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="36" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3" rowspan="3" valign="middle"><? echo"$tipo_id2 $id2"; ?></td>
        <td colspan="9" rowspan="2" valign="middle"><div align="left"><? echo"$b_address"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="14" border="0" alt="" /></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="1" height="22" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="4" rowspan="2" valign="top"><div align="left"><? echo"$cdtra"; ?></div></td>
        <td colspan="3" rowspan="2" valign="top"><div align="left">&nbsp; <? echo"$edotra"; ?></div></td>
        <td colspan="2" rowspan="2" valign="top"><div align="left">&nbsp; <? echo"$cptra"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="16" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="4" colspan="3">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="15" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9" valign="top"><div align="left">&nbsp; <? echo"$tel_tra"; ?></div></td>
        <td><img src="images/spacer.gif" width="1" height="27" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9"><img src="images/spacer.gif" width="1" height="6" border="0" alt="" /></td>
        <td><img src="images/spacer.gif" width="1" height="6" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9" rowspan="2" valign="middle"><? echo"$kind"; ?></td>
        <td><img src="images/spacer.gif" width="1" height="25" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2" colspan="3">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="10" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="11">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="10" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="14" valign="middle"><? echo"$restricted"; ?></td>
        <td><img src="images/spacer.gif" width="1" height="61" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5">&nbsp;</td>
        <td rowspan="2" colspan="9">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="20" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="4" rowspan="2" valign="middle"><? if($firm!="") echo"$corp_name"; ?></td>
        <td rowspan="2">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="11" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9" valign="middle"><? echo"$n15"; ?></td>
        <td><img src="images/spacer.gif" width="1" height="60" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="5">&nbsp;</td>
        <td colspan="9">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="55" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2" colspan="4"></td>
        <td rowspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td rowspan="2" colspan="8">&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="13" border="0" alt="" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><img src="images/spacer.gif" width="1" height="25" border="0" alt="" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
