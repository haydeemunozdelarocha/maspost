function mysqli_last_result($db) {
  while (mysqli_more_results($db)) {
    mysqli_use_result($db);
    mysqli_next_result($db);
  }
    return mysqli_store_result($db);
}

if ($password === $confirm_password) {
  if (isset($pmb) && !empty($pmb) && isset($email) && !empty($email) && isset($password) && !empty($password)) {
    $pmb= mysqli_real_escape_string($db, $pmb);
    if ($pmb!="") {
    $email = mysqli_real_escape_string($db, $email);
    $pass = mysqli_real_escape_string($db, $password);
    $options = [
      'cost' => 11
    ];

    $mensaje = '';
    $password = password_hash($pass, PASSWORD_BCRYPT, $options);
    $consulta  = "SELECT @id:=id AS id FROM clientes WHERE pmb = $pmb; UPDATE clientes set email='$email', password='$password' where id = @id;SELECT id,email,tipo,pmb,perfil_status FROM clientes WHERE pmb = $pmb";
    $resultado = mysqli_multi_query($db, $consulta) or die("Error 1 $consulta <Br>".  mysqli_error($db) );
      if ($resultado) {
        $result = mysqli_last_result($db);
        $res = mysqli_fetch_array($result, MYSQLI_BOTH);
      } else {
        echo"<script>alert(\"PMB inválido\");</script>";
      }

      if ($_SESSION['cliente']) {
        echo"<script> window.location=\"home.php\"</script>";
      } else {
        echo"<script>alert(\"No tienes acceso\");</script>";
      }
  }
} else {
  echo"<script>alert(\"El password y la confirmación no concuerdan. Favor de ingresarlos de nuevo.\");</script>";
}