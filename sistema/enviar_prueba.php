
<?

include "coneccion.php";

	
	
	$EmailFrom = "noreplay@maspostwarehouseusers.com";
	$email = "mgarciavarela@gmail.com";
	
	$Subject = "Prueba ";
	$Body = "";
	
	$success = mail($email, $Subject, "Prueba", "From: maspostwarehouseusers.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
	

?>

 