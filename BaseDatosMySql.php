<?php
//--------------------------------------Conexion base de datos-------------------------------------//
$servidor = "mysql:dbname=apilink;host=localhost:3306"; 
$usuario = "apilink"; 
$pass = 'Geniunes12-';
try{$pdo = new PDO($servidor, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));}
catch(PDOException $e){ echo "No se púede conectar" . $e->getMessage();}
?>
