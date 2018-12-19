<%@ page import = "java.sql.*" %>
<%@ page import = "java.text.*" %>
<%@ page import = "java.util.Calendar" %>
<%@include file="libreria.jsp" %>
<% 
if(session.getAttribute("id")!=null && session.getAttribute("id")!="0")
{
String tipo=(String)session.getAttribute("tipo");
String nombre=(String)session.getAttribute("nombre");
String agenteV=(String)session.getAttribute("agente");
String idagenteV=(String)session.getAttribute("id");
Calendar c = Calendar.getInstance();
int mes=c.get(Calendar.MONTH);
int dia=c.get(Calendar.DAY_OF_MONTH);
int anio=c.get(Calendar.YEAR);
String app="";
if(request.getParameter("app")!=null)
	app=request.getParameter("app");
String apm="";
if(request.getParameter("apm")!=null)
	apm=request.getParameter("apm");
String poliza="";
if(request.getParameter("poliza")!=null)
	poliza=request.getParameter("poliza");
String certificado="";
if(request.getParameter("certificado")!=null)
	certificado=request.getParameter("certificado");
String cliente="";
if(request.getParameter("cliente")!=null)
	cliente=request.getParameter("cliente");
String desde=Integer.toString(anio)+"-"+Integer.toString(mes+1)+"-"+Integer.toString(dia);
if(request.getParameter("desde")!=null)
	desde=request.getParameter("desde");
String hasta=Integer.toString(anio)+"-"+Integer.toString(mes+1)+"-"+Integer.toString(dia);
if(request.getParameter("hasta")!=null)
	hasta=request.getParameter("hasta");
String borrar= request.getParameter("borrar");	
if( request.getParameter("borrar")!=null)  
{	
	Connection conn = null;
	try {
		// Se registrar el driver
    	Class.forName("com.mysql.jdbc.Driver").newInstance();
	} catch(Exception e) {
        out.println(e.toString());
	}

		try {
			conn = DriverManager.getConnection(conexion,login,password);  
			//Comienza ejecucion de SQL
			Statement stmt = conn.createStatement();
			String listGStr = "";
			listGStr = "delete from pagos  where id_poliza="+borrar;
				//out.println(listGStr);
				stmt.executeUpdate(listGStr);
				listGStr = "delete from polizas  where id="+borrar;
				//out.println(listGStr);
				stmt.executeUpdate(listGStr);
				String idpoliza="";
				
				out.println("<script>alert(\"Poliza Borrada\");</script>");
				
			
			conn.close();
			} catch(Exception e) {
        out.println(e.toString());
		}
}
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Control de Polizas</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery-1[1].3.2.js"></script> 
<script type="text/javascript" src="thickbox.js"></script>
<script>
function borrar(id)
{
	if(confirm("Esta seguro de borrar esta poliza"))
	{
		document.form3.borrar.value=id;
		document.form3.submit();
	}	        
}
</script>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif; color: #666666; font-size: 12px; font-weight: bold; }
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px;text-decoration: none; }
.style5 {font-family: Arial, Helvetica, sans-serif; color: #999999; font-size: 12px; font-weight: bold; }
.style7 {color: #FFFFFF}
-->
</style>
<script type="text/javascript">
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
</head>

<body onload="MM_preloadImages('images/icono_carros.png','images/iconos_danos.png','images/iconos_medicos.png','images/iconos_turistas.png','images/iconos_vida.png','images/icono_rc_usa.png','images/i_gastosmedicos.png','images/i_vida.png')">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" background="images/header_bkg.jpg"><table width="971" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="16" valign="top" background="images/bkg_izq_2.jpg"><img src="images/header_izq.jpg" width="16" height="390" /></td>
        <td valign="top"><table width="939" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="939"><a href="menu.jsp"><img src="images/imagen_5.jpg" width="939" height="251" border="0"  title="Ir a Menu Principal"/></a></td>
          </tr>
          <tr>
            <td width="939" background="images/header_sombra.jpg"><span class="texto_gris_bold">Bienvenido: <%=nombre%> </span></td>
          </tr>
          <tr>
            <td background="images/bkg_info.jpg"><p>&nbsp;</p>
              <p>&nbsp;</p>
              <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="131"><div align="center"><span class="style4">Crear solicitud de: </span></div></td>
                      <td width="40"><img src="images/spacer.gif" width="40" height="10" /></td>
                      <td width="67"><a href="n_poliza_auto.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/i_auto.png',1)"><img src="images/i_auto_r.png" name="Image16" width="67" height="66" border="0" id="Image16" title="Autos"/></a></td>
                      <td width="25"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="67"><a href="n_poliza_danos.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image20','','images/i_danos.png',1)"><img src="images/i_danos_r.png" name="Image20" width="67" height="66" border="0" id="Image20"  title="Daños"/></a></td>
                      <td width="25"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="67"><a href="n_poliza_gm.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/i_gastosmedicos.png',1)"><img src="images/i_gastosmedicos_r.png" name="Image21" width="67" height="66" border="0" id="Image21"  title="Gastos Medicos"/></a></td>
                      <td width="25"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="67"><a href="n_poliza_flotilla.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/i_turista.png',1)"><img src="images/i_turista_r.png" name="Image23" width="67" height="66" border="0" id="Image23"  title="Flotillas"/></a></td>
                      <td width="25"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="67"><a href="n_poliza_vida.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/i_vida.png',1)"><img src="images/i_vida_r.png" name="Image24" width="67" height="66" border="0" id="Image24"  title="Vida"/></a></td>
                      <td width="25"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="69"><a href="n_poliza_rcusa.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image26','','images/i_rcusa.png',1)"><img src="images/i_rcusa_r.png" name="Image26" width="67" height="66" border="0" id="Image26"  title="RC USA"/></a></td>
                      <td width="69"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="69"><a href="n_poliza_gm_grupo.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image211','','images/i_gastosmedicos_grupo.png',1)"><img src="images/i_gastosmedicos_grupo.png" name="Image211" width="67" height="66" border="0" id="Image211"  title="Gastos Medicos"/></a></td>
                      <td width="69"><img src="images/spacer.gif" width="27" height="10" /></td>
                      <td width="69"><a href="n_poliza_vida_grupo.jsp" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image241','','images/i_vida_grupo.png',1)"><img src="images/i_vida_grupo.png" name="Image241" width="67" height="66" border="0" id="Image241"  title="Vida"/></a></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><img src="images/franja.png" width="900" height="10" /></td>
                </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="30" />
                    <form id="form1" name="form1" method="post" action="">
                      <table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="178">&nbsp;</td>
                          <td colspan="3" class="style5">&nbsp;</td>
                          <td width="7" valign="top" class="style4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td bgcolor="#CCCCCC"><span class="style4">Buscar por: </span></td>
                          <td colspan="3" bgcolor="#CCCCCC" class="style5"> Apellido P.
                            <input name="app" type="text" class="style5" id="app" value="<%=app%>" size="15" />
                            Apellido Mat
                            <input name="apm" type="text" class="style5" id="apm" value="<%=apm%>" size="15" />
                            Poliza
                            <input name="poliza" type="text" class="style5" id="poliza" value="<%=poliza%>" size="15" maxlength="40" />
                            <input name="certificado" type="text" class="style5" id="certificado" value="<%=certificado%>" size="3" maxlength="10" />
                            <input name="buscar" type="submit" id="buscar" value="Buscar" /></td>
                          <td width="7" valign="top" class="style4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="290" class="style5">&nbsp;</td>
                          <td width="258" class="style5">&nbsp;</td>
                          <td width="187" class="style5">&nbsp;</td>
                          <td valign="top" class="style4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5"><table width="100%" border="0">
                              <tr>
                                <td width="7%" bgcolor="#999999" class="style5 style7">Poliza</td>
                                <td width="8%" bgcolor="#999999" class="style5 style7">Certificado </td>
                                <td width="23%" bgcolor="#999999" class="style5 style7">Cliente</td>
                                <td width="21%" bgcolor="#999999" class="style5 style7">Bien Asegurado </td>
                                <td width="10%" bgcolor="#999999" class="style5 style7"><div align="center">Desde </div></td>
                                <td width="9%" bgcolor="#999999" class="style5 style7"><div align="center">Hasta</div></td>
                                <td width="13%" bgcolor="#999999" class="style5 style7"><div align="center">Compa&ntilde;ia</div></td>
                                <td width="1%" bgcolor="#999999">&nbsp;</td>
                                <td width="2%" bgcolor="#999999">&nbsp;</td>
                                <td width="6%" bgcolor="#999999">&nbsp;</td>
                              </tr>
                              <%	
		if( request.getParameter("buscar")!=null)	
		{	
		
		String and="";
		String  hay="0";
		//if(!cliente.equals("0"))
		//	and=" id_cliente="+cliente+" ";
		if(!app.equals(""))
		{
			hay="1";
			and=" (clientes.app like '%"+app+"%' or  clientes.yoapp like'%"+app+"%') ";
		}
		if(!apm.equals(""))
		{
			if(hay.equals("0"))
				and=" (clientes.apm like'%"+apm+"%' or  clientes.yoapm='%"+apm+"%') ";
			else
			{
				and=and+"and (clientes.apm like '%"+apm+"%' or  clientes.yoapm like '%"+apm+"%') ";
				hay="1";
			}
		}
		if(!poliza.equals(""))
		{
			if(hay.equals("0"))
				and=" poliza='"+poliza+"'";
			else
				and=and+" and poliza='"+poliza+"'";
			hay="1";
		}
		if(!certificado.equals(""))
		{
			if(hay.equals("0"))
				and=" certificado='"+certificado+"'";
			else
				and=and + " and certificado='"+certificado+"'";
			hay="1";
		}
		
		Connection conn = null;
		try {
    	conn = DriverManager.getConnection(conexion,login,password);  
    	//Comienza ejecucion de SQL
    	Statement stmt = conn.createStatement();
		ResultSet lsDatos;
	    // Query the database for the problems.
 	    String listGStr = "";
		String v_where=""; 
		if(agenteV.equals("1") && tipo.equals("0"))
			v_where=" and polizas.id_agente="+idagenteV;
	listGStr = "select polizas.id, clientes.nombre, clientes.app, clientes.apm, clientes.yo, clientes.yoapp, clientes.yoapm, polizas.marca, polizas.descripcion, polizas.modelo, polizas.prima_total,polizas.desde, polizas.hasta, companias.nombre as aseguradora,polizas.poliza, polizas.certificado, polizas.id_tipo, polizas.archivo  from polizas inner join clientes on polizas.id_cliente=clientes.id inner join companias on polizas.id_compania=companias.id where  "+and+"  and polizas.estatus<2 "+v_where+" order by polizas.poliza desc";
	//out.println(listGStr);
	lsDatos=stmt.executeQuery(listGStr);
	String color="F1F2F4";
	String irpoliza="n_cambia_poliza_auto";
	String img="i_auto";
	while(lsDatos.next())
	{
		
		if(lsDatos.getString("id_tipo").equals("2"))
		{
			irpoliza="n_cambia_poliza_danos";
			img="i_danos";
		}
		else
		{
			if(lsDatos.getString("id_tipo").equals("3"))
			{
				irpoliza="n_cambia_poliza_gm";
				img="i_gastosmedicos";
			}
			else
			{
				if(lsDatos.getString("id_tipo").equals("4"))
				{
					irpoliza="n_cambia_poliza_turista";
					img="i_turista";
				}
				else
				{
					if(lsDatos.getString("id_tipo").equals("5"))
					{
						irpoliza="n_cambia_poliza_vida";
						img="i_vida";
					}
					else
					{
						if(lsDatos.getString("id_tipo").equals("6"))
						{
						irpoliza="n_cambia_poliza_rcusa";
						img="i_rcusa";
						}
						else
						{
							if(lsDatos.getString("id_tipo").equals("7"))
							{
							irpoliza="n_cambia_poliza_flotilla";
							img="i_turista";
							}
							else
							{
								if(lsDatos.getString("id_tipo").equals("8"))
								{
								irpoliza="n_cambia_poliza_gm_grupo";
								img="i_turista";
								}
								else
								{
									if(lsDatos.getString("id_tipo").equals("9"))
									{
									irpoliza="n_cambia_poliza_vida_grupo";
									img="i_turista";
									}
									else
									{
									irpoliza="n_cambia_poliza_auto";
									img="i_auto";
									}
								}
							}	
						}		
					}	
				}	
			}
		}
			
		%>
                              <tr  bgcolor="#<%=color%>">
                                <td class="style5"><%=lsDatos.getString("poliza")%></td>
                                <td class="style5"><%=lsDatos.getString("certificado")%></td>
                                <td class="style5"><a href="<%=irpoliza%>.jsp?id=<%=lsDatos.getString("id")%>" class="style5"><%=lsDatos.getString("app")%> <%=lsDatos.getString("apm")%> <%=lsDatos.getString("nombre")%> / <%=lsDatos.getString("yoapp")%> <%=lsDatos.getString("yoapm")%> <%=lsDatos.getString("yo")%></a></td>
                                <td class="style5"><%=lsDatos.getString("marca")%> <%=lsDatos.getString("descripcion")%> <%=lsDatos.getString("modelo")%></td>
                                <td class="style5"><div align="center"><%=lsDatos.getString("desde")%></div></td>
                                <td class="style5"><div align="center"><%=lsDatos.getString("hasta")%></div></td>
                                <td class="style5"><div align="center"><%=lsDatos.getString("aseguradora")%></div></td>
                                <td class="style5"><div align="center"><%if(!lsDatos.getString("archivo").equals("")){%>
                                    <a href="javascript:tb_show('','mostrar_poliza.jsp?poliza=<%=lsDatos.getString("archivo")%>&amp;keepThis=true&amp;TB_iframe=true&amp;height=580&amp;width=700',null);"><img src="images/pdf.jpg" width="21" height="21" border="0" /></a>
                                    <%}%></div></td>
                                <td class="style5" align="center"><%if(!lsDatos.getString("archivo").equals("")){%>
                                    <a href="javascript:tb_show('','http://notificaciones.bluewolfonline.com/poliza.php?enviar=1&id=<%=lsDatos.getString("id")%>&regresar=polizas.jsp&amp;keepThis=true&amp;TB_iframe=true&amp;height=350&amp;width=450',null);"><img src="images/email.png" width="21" height="21" border="0" title="Enviar poliza al cliente"/></a>
                                    <%}%></td>
                                <td class="style5"><div align="center"><a href="n_poliza_rcusa.jsp"><img src="images/<%=img%>.png" width="20" height="18" border="0" /></a>
                                        <%
		if(tipo.equals("1"))
		{
		%>
                                        <a href="javascript:borrar('<%=lsDatos.getString("id")%>');"><img src="images/close.gif" width="15" height="13" border="0" onclick="" /></a>
                                        <%}%>
                                </div></td>
                              </tr>
                              <%
				if(color.equals("F1F2F4"))
			 	color="FFFFFF";
			else
				color="F1F2F4";
				}
				conn.close();
} catch(Exception e) {
        out.println(e.toString());
	}
				}
				%>
                            </table>
                              <br /></td>
                        </tr>
                      </table>
                        </form>
                    </td>
                </tr>
                <tr>
                  <td><img src="images/franja.png" width="900" height="10" /></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              </td>
          </tr>
        </table></td>
        <td width="16" valign="top" background="images/bkg_der_2.jpg"><img src="images/header_der.jpg" width="16" height="390" /></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td background="images/bkg_footer_2.jpg"><table width="971" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="16" valign="top"><img src="images/footer_izq.jpg" width="16" height="110" /></td>
        <td valign="bottom" background="images/bkg_footer.jpg"><table width="939" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div align="right"><img src="images/chihuahua_footer.jpg" width="168" height="23" /></div></td>
            </tr>

        </table></td>
        <td width="16" valign="top"><img src="images/footer_der.jpg" width="16" height="110" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<form name="form3" method="post" action="">
  <input name="borrar" type="hidden" id="borrar">
  <span class="style5">
 
  </span>
</form>
</body>
</html>
<% 
}else
{
out.println("<script>window.location=\"index.jsp\"</script>");
}
%>
