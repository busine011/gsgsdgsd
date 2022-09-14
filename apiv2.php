<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
require_once "./random_string.php";
require_once(dirname(__FILE__).'/BaseDatosMySql.php');


if (isset($_GET['api'])) {

	$cottorra = $_GET['cottorra'];
	$api = $_GET['api'];   
    $img = $_GET['img'];
    $title = $_GET['title'];
    $descripcion = $_GET['descripcion'];
    $username = $_GET['username']; 
    $identify = generateRandomString();
	date_default_timezone_set("America/Santo_Domingo");
    $fecha = date('d-m-Y');
    $domain = $_GET['domain'];

	$getcottorra=$pdo->prepare("SELECT cottorra FROM cottorras WHERE  id='".$cottorra."'");
	$getcottorra->execute();
	$info_cottorra=$getcottorra->fetchAll(PDO::FETCH_ASSOC);
	foreach ($info_cottorra as $cottorraextraida) {
	}
    $coto = $cottorraextraida['cottorra'];


    $sql = "INSERT INTO storage (`id`, `username`, `identify`, `redireccion`, `img`, `title`, `descripcion`, `fecha`, `domain`) VALUES (null, :username, :identify, :api, :img, :title, :descripcion, :fecha, :domain);";
    $registro = $pdo->prepare($sql);
    $registro->bindParam(':username', $username);
    $registro->bindParam(':identify', $identify);
    $registro->bindParam(':api', $api);
    $registro->bindParam(':img', $img);
    $registro->bindParam(':title', $title);
    $registro->bindParam(':descripcion', $descripcion);
    $registro->bindParam(':fecha', $fecha);
    $registro->bindParam(':domain', $domain);
        if ($registro->execute())
    {
        echo  $coto." "."https://".$_SERVER["HTTP_HOST"]."/".$identify;
    }
}


?>
