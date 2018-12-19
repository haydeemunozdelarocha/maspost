<?php
session_start();
include "../connection.php";

  //  if (isset($_GET['controller']) && isset($_GET['action'])) {
  //   $controller = $_GET['controller'];
  //   $action     = $_GET['action'];
  // } else {
  //   $controller = 'inventario';
  //   $action     = 'home';
  // }

  // require_once('views/layout.php');

$pmb=$_SESSION['pmbU'];


// foreach ($_FILES as $item) {
//     unlink($item);
// }
// foreach ($_FILES as $item) {
//     echo $item;
// }
$newnameIfe='';
$newnameVisa='';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

if($_FILES["ife"]["name"] !=''){
  $nameIfe = $_FILES['ife']['name'];
  $sizeIfe = $_FILES['ife']['size'];
  $tmpIfe = $_FILES['ife']['tmp_name'];

  $infoIfe = pathinfo($_FILES['ife']['name']);
  $extIfe = $infoIfe['extension']; // get the extension of the file
  $newnameIfe = "ife".time().'.'.$extIfe;

$targetIfe = '../images/ids/'.$newnameIfe;
move_uploaded_file( $_FILES['ife']['tmp_name'], $targetIfe);
}

if($_FILES["visa"]["name"] !=''){
  $nameVisa = $_FILES['visa']['name'];
  $sizeVisa = $_FILES['visa']['size'];
  $tmpVisa = $_FILES['visa']['tmp_name'];

  $infoVisa = pathinfo($_FILES['visa']['name']);
  $extVisa = $infoVisa['extension']; // get the extension of the file
  $newnameVisa = "visa".time().'.'.$extVisa;

$targetVisa = '../images/ids/'.$newnameVisa;
move_uploaded_file( $_FILES['visa']['tmp_name'], $targetVisa);

}

if(!empty($_POST['direccion']) && !empty($_POST['pais']) && !empty($_POST['ciudad']) && !empty($_POST['codigopostal']) && !empty($_POST['estado']) && !empty($_POST['celular'])){
      $direccion=mysqli_real_escape_string($enlace,$_POST["direccion"]);
      if($_POST["pais"]){
      $pais=mysqli_real_escape_string($enlace,$_POST["pais"]);
      } else if ($_POST["pais-otro"]){
         $pais=mysqli_real_escape_string($enlace,$_POST["pais-otro"]);
       }
      $ciudad=mysqli_real_escape_string($enlace,$_POST["ciudad"]);
      if($newnameIfe){
        $ife=$newnameIfe;
      } else {
        $ife = '';
      }
      if($newnameVisa){
        $visa=$newnameVisa;
      } else {
        $visa = '';
      }
      $estado=mysqli_real_escape_string($enlace,$_POST["estado"]);
      $codigopostal=mysqli_real_escape_string($enlace,$_POST["codigopostal"]);
      $celular=mysqli_real_escape_string($enlace,$_POST["celular"]);

      if($_POST['tipo']!=="Persona"){
      $rfc=mysqli_real_escape_string($enlace,$_POST["rfc"]);
      $paisempresa=mysqli_real_escape_string($enlace,$_POST["paisempresa"]);
      } else{
        $rfc = '';
        $paisempresa = '';
      }

      if($_POST["telefono"]){
      $telefono=mysqli_real_escape_string($enlace,$_POST["telefono"]);
      } else {
        $telefono = '';
      }
      if($_POST["email-titular"]){
      $emailtitular=mysqli_real_escape_string($enlace,$_POST["email-titular"]);
      } else {
        $emailtitular = '';
      }
      $adicionalquery = '';
      if(array_key_exists('idadicional',$_POST)){
      $emailsadicional = $_POST["emailadicional"];
      $idsadicional = $_POST["idadicional"];
      for ($i = 0; $i <= (sizeof($emailsadicional)-1); $i++){
        if($emailsadicional[$i]){
      $adicionalquery = $adicionalquery . "UPDATE c_recibir SET email = '".$emailsadicional[$i]."' WHERE id IN (".$idsadicional[$i].");";
        }
      }
    }

      $autorizadoquery = '';
      if(array_key_exists('autorizadosids',$_POST)){
      $idsautorizados = $_POST['autorizadosids'];
      $nombresautorizados =$_POST['nombreautorizado'];
      $emailautorizados =$_POST['emailrecoger'];
      for ($j = 0; $j <= (sizeof($idsautorizados)-1); $j++){
        if($emailsautorizados[$j]){
      $autorizadoquery = $autorizadoquery . "UPDATE c_entregar SET nombre='".$nombresautorizados[$j]."',email='".$emailautorizados."' WHERE id=".$idsautorizados[$j].";";
        }
      }
    }

      $consulta  = "SELECT @id:=id AS id FROM clientes WHERE pmb =".$pmb.";UPDATE clientes SET direccion = '".$direccion."', ciudad = '".$ciudad."',pais='".$pais."', cp = ".$codigopostal.",telefono_fijo = '".$telefono."',celular = ".$celular.",pais_empresa = '".$paisempresa."',rfc = '".$rfc."', estado = '".$estado."',perfil_status=2 where id = @id;SELECT @titularid:=id AS id FROM c_recibir WHERE pmb = ".$pmb." AND tipo = 1;UPDATE c_recibir SET email='".$emailtitular."',ife='".$ife."',visa='".$visa."' WHERE id = @titularid;".$adicionalquery.$autorizadoquery;

      $resultado = mysqli_multi_query($enlace,$consulta) or die("Error 1 $consulta <Br>".  mysqli_error($enlace) );

    if ($resultado) {
     header("Location: ../terms.php"); /* Redirect browser */
    exit();

      } else{
          echo"<script>alert(\"PMB inválido\");</script>";
      }
}
}

?>
