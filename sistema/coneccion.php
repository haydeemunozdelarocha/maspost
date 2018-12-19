<?
	$enlace = mysql_connect('localhost', $_ENV["MASPOST_DB_USER"], $_ENV["MASPOST_DB_PASSWORD"]);
	mysql_set_charset('utf8',$enlace);
	if (!$enlace) {
    die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("maspost") or die("No pudo seleccionarse la BD.");
?>
