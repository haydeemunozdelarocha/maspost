<?php
$db = new mysqli('localhost', $_ENV["MASPOST_DB_USER"], $_ENV["MASPOST_DB_PASSWORD"], "maspost");

if (!$db) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
