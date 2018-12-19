<? //if($tipoU=="1"){ $inicio="menu_admin.php"; }else{ $inicio="menu.php"; }?>

 <div class="navbar-main">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.html"><img src="images/maspost-sm.png" alt="" width="139" height="78" border="0"></a>                </div>

                <div id="navbar" class="navbar-collapse collapse pull-right">
                  <ul class="nav navbar-nav">
                    <li><a class="is-active" href="menu_u.php">INICIO</a></li>
                   <li class="has-child"><a href="#">MOSTRADOR</a>
                     <ul class="submenu">
                        <li class="submenu-item"><a href="entrega.php">SALIDAS </a></li>
                        <li class="submenu-item"><a href="recepcion2.php">ENTRADAS </a></li>
            <li class="submenu-item"><a href="pos.php">PUNTO DE VENTA </a></li>
                        <li class="submenu-item"><a href="busqueda.php">BUSQUEDA </a></li>

                        <li class="submenu-item"><a href="entrega_dia.php">ENTRADAS DEL DIA </a></li>
            <li class="submenu-item"><a href="salidas_dia.php">SALIDAS DEL DIA </a></li>
			<li class="submenu-item"><a href="fleteras.php">FLETEROS </a></li>
                     </ul>
                    </li>
			 <li class="has-child"><a href="#">CLIENTES</a>
                      <ul class="submenu">
                        <li class="submenu-item"><a href="clientes.php">CONSULTA </a></li>
                        <li class="submenu-item"><a href="alta_cliente.php">NUEVO</a> </li>
                        <li class="submenu-item"><a href="archivo.php">ARCHIVO MUERTO</a> </li>
						<li class="submenu-item"><a href="vencidos.php">VENCIMIENTOS</a> </li>
                      </ul>
                    </li>
          <li><a class="is-active" href="logout.php">SALIR</a></li>
                  </ul>
                </div> <!-- /#navbar -->
              </div> <!-- /.container -->
            </div> <!-- /.navbar-main -->
