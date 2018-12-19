<?php
include "../coneccion.php";
include "../checar_sesion_admin.php";


  $consulta = "SET @id :=(SELECT horas_empleados.id FROM horas_empleados WHERE usuario_id =".$_GET['id']." AND salida IS NULL ORDER BY entrada DESC LIMIT 1);";
  $resultado3 = mysql_query($consulta) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
  if($resultado3)
  {
  $consulta2 = "UPDATE horas_empleados SET salida = NOW() WHERE id =@id;";
  $resultado4 = mysql_query($consulta2) or die("La consultafall&oacuteP1.3:$consulta " . mysql_error());
    if($resultado4)
  {
  echo "true";

} else {
  echo "false";
}
}
?>
