<?php
  $logged_in = false;

  if (array_key_exists('idU', $_SESSION)) {
    $logged_in = true;
  }
  if ($_SERVER['REQUEST_URI'] == "/index.php") {
      if ($logged_in) {
        header("Location: ./home.php");
      }
    } else {
      if (!$logged_in && $login_required_page) {
        header("Location: ./index.php");
      }
    }
?>