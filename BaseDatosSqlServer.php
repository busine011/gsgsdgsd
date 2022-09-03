<?php
// CONECCION SQL SERVER
$pass = "1jkl256b8x809**C";
$usuario = "alienfb.trade";
$servidor = "alienfb.trade";
$server = ".\MSSQLSERVER2016";
try {
    $pdoserver = new PDO("sqlsrv:server=$server;database=$servidor", $usuario, $pass);
    $pdoserver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "No se puede conectar" . $e->getMessage();
}
?>