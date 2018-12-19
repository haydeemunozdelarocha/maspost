<header class="main-header">
  <nav class="navbar navbar-default " role="navigation"

  <div class="navbar-main">
    <div class="container">
      <div class="navbar-header">
        <?php
          if ($logged_in) {
            include "./templates/_mobile_menu_hamburguer.php";
          }
        ?>
        <a href="/"><img src="images/maspost-sm.png" alt="logo" border="0"></a>
         </div>
        <?php
          if ($logged_in) {
            include "_menu.php";
          }
        ?>
      </div>
    </div>
  </div>
  </nav>
</header>
<body>