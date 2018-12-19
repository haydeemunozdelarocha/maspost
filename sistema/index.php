<?
session_start();
include "coneccion.php";
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>+Post Warehouse</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/style-admin.css">
        <script src="assets/js/modernizr-2.6.2.min.js"></script>
    </head>
<?

$login= mysql_real_escape_string($_POST["login"]);
if($login!=""){

			$pass=mysql_real_escape_string($_POST["pass"]);

			$consulta  = "SELECT * from usuarios where email='$login' and pass='$pass'";//md5()
			$resultado = mysql_query($consulta) or die("Error 1 $consulta <Br>".  mysql_error() );//. mysql_error()
			//echo $consulta;
			if(@mysql_num_rows($resultado)>=1){
                    $res=mysql_fetch_array($resultado,MYSQL_BOTH);

				    $_SESSION['usuario']=$res;
                    $_SESSION['idU']=$_SESSION['usuario']['id'];
					$_SESSION['nombreU']=$_SESSION['usuario']['nombre'];
					$_SESSION['tipoU']=$_SESSION['usuario']['tipo'];

						if($_SESSION['tipoU']=="0"){
							echo"<script> window.location=\"menu_u.php\"</script>";
						}else{
							if($_SESSION['tipoU']=="1"){
								echo"<script> window.location=\"menu.php\"</script>";
							}else{
									echo"<script>alert(\"No tienes acceso\");</script>";
							}
						}
			} else{

					echo"<script>alert(\"Usuario o password invalido\");</script>";

			}

}

?>

  <body  onLoad="document.form1.login.focus();">
  <form id="form1" name="form1" method="post" action="">
    <header class="main-header">
        <nav class="navbar navbar-static-top">



        </nav>
    </header> <!-- /. main-header -->

    <article class="barra-menu">

    </article><!-- /. barra-menu -->

  <section class="tipos-textos">
      <h2 align="center">ACCESO ADMINISTRATIVO</h2>
    </section>
 <section class="tabla">
      <div >
        <div >
          <div align="center">
            <table width="714" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td height="300" valign="top" align="center"><table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>

                    <tr>
                      <td><table width="400" border="0" align="center" cellpadding="5" cellspacing="0">

                          <tr>
                            <td><img src="images/spacer.gif" width="9" height="5" /></td>
                          </tr>
                          <tr>
                            <td><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="center" class="user">Usuario</td>
                                </tr>
                                <tr>
                                  <td><img src="images/spacer.gif" width="9" height="10" /></td>
                                </tr>
                                <tr>
                                  <td align="center"><input name="login" type="text" id="login" placeholder="Usuario" required class="campo"/></td>
                                </tr>
                                <tr>
                                  <td align="center"><img src="images/spacer.gif" width="350" height="6" /></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="center" class="user">Password</td>
                                </tr>
                                <tr>
                                  <td><img src="images/spacer.gif" width="9" height="10" /></td>
                                </tr>
                                <tr>
                                  <td align="center"><input name="pass" type="password" id="pass" placeholder="Password" required class="campo"/></td>
                                </tr>
                                <tr>
                                  <td><div align="center"><img src="images/spacer.gif" width="350" height="6" /></div></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><div align="center">
                              <input name="button" type="submit" id="button" value="Log In" class="btn green-button" />
                            </div></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="9" height="2" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="9" height="1" /></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
  </section>


  <?php include "footer.php" ?>

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.1.min.js"><\/script>')</script>

    <!-- Bootsrap javascript file -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- owl carouseljavascript file -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Template main javascript -->
    <script src="assets/js/main.js"></script>
	</form>
  </body>
</html>
