<?
session_start();
//include "checar_sesion_admin.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PMB office Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
td img {display: block;}

</style>
<!--Fireworks 8 Dreamweaver 8 target.  Created Wed Dec 14 11:47:01 GMT-0700 2011-->
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link rel="stylesheet" href="thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery-1[1].3.2.js"></script> 
<script type="text/javascript" src="thickbox.js"></script>
<link href="images/texto.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style6 {color: #FFFFFF}
-->
</style>
<script>
function selecciona(valor){
	//parent.tb_remove(); 
	document.form1.pmb.value=valor;
	document.form1.submit();
	//parent.tb_remove();
}
</script>
</head>
<?php
include "coneccion.php";
$nombre=$_GET["nombre"];



?>
<body bgcolor="#ffffff" onload="MM_preloadImages('images/boton_1_o.jpg','images/boton_2_o.jpg','images/boton_3_o.jpg','images/boton_4_o.jpg')">
<div align="center">
<table width="590" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
<!-- fwtable fwsrc="inicio.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "140675292" fwnested="0" -->
  <tr>
    <td><p align="center" class="style1">&nbsp;</p>
      <p align="center" class="style1">&nbsp;</p>
      <table width="574" border="0" align="center">
        <tr>
          <td width="100%"><div align="center">
              <table width="87%" border="0" cellpadding="0">
                <tr>
                  <td width="71%" bgcolor="#999999" class="style8" scope="row"><div align="center" class="style4 style6">Nombre</div></td>
                  <td width="29%" bgcolor="#999999" class="style4 style6"><div align="center">&nbsp;Suite</div></td>
                </tr>
                <?	  

	
	
	$consulta  = "select c_recibir.nombre as nom, c_recibir.app, c_recibir.apm, c_recibir.pmb from c_recibir where c_recibir.nombre like '%$nombre%' or c_recibir.app like '%$nombre%' or c_recibir.apm like '%$nombre%' order by nom";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " . mysql_error());
	$count=1;
	$color="ffffff";
	while(@mysql_num_rows($resultado)>=$count)
	{
		$res=mysql_fetch_row($resultado);
		
		
		
		?>
                <tr bgcolor="<?echo"$color";?>">
					
                  <td class="style5"><div align="left"><a href="javascript:selecciona(<?echo"$res[3]";?>);" class="style4"><?echo"$res[0] $res[1] $res[2]";?></a></div></td>
                  <td class="style5"><div align="center"><a href="javascript:selecciona(<?echo"$res[3]";?>);" class="style4"><?echo"$res[3]";?></a></div></td>
                </tr>
                <?
				if($color=="EFEFEF")
					$color="ffffff";
				else
					$color="EFEFEF";
			   $count=$count+1;
	}
	
	


	

?>
              </table>
          </div></td>
        </tr>
      </table>
       <p align="left"><a href="menu.php" class="style5"></a></p>
       <form id="form1" name="form1" method="post" action="entrega.php">
         <input name="pmb" type="hidden" id="pmb" />
              </form>       <p align="center" class="style1">&nbsp;</p></td>
    </tr>
</table>
</div>
</body>
</html>
