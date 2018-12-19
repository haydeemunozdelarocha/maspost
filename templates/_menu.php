<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">
  <?php
    $urls = array(
    'inicio' => '/home.php',
    'inventario' => '/inventario.php',
    'salir' => '/helpers/logout.php'
    );

    $currentPage='';
    foreach ($urls as $name => $url) {
    print '<li '.(($currentPage === $name) ? ' class="active" ': '').'><a href="'.$url.'">'.$name.'</a></li>';
    }
  ?>
  </ul>
</div>
