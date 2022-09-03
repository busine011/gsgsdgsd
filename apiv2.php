<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: text/html; charset=iso-8859-1');
require_once "./random_string.php";
require_once(dirname(__FILE__).'/BaseDatosMySql.php');


if (isset($_GET['api'])) {
	$api = $_GET['api'];
    $identify = generateRandomString();
	
    $sql = "INSERT INTO storagex2 (`id`, `identify`, `blob64`) VALUES (null, :identify, :api);";
    $registro = $pdo->prepare($sql);
    $registro->bindParam(':identify', $identify);
    $registro->bindParam(':api', $api);
        if ($registro->execute())
    {
        echo  "https://52n3.trade/".$identify;
    }
}


?>
