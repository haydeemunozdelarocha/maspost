<?php
include "../coneccion.php";
include "../checar_sesion_admin.php";


  $consulta = "INSERT INTO horas_empleados(entrada,usuario_id) VALUES(NOW(),".$_GET['id'].")";
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if($resultado3)
  {
  echo "true";

} else {
  echo "false";
}
?>
