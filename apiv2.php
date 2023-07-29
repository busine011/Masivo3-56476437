<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: ');
require_once "./config.php";
require_once "./BaseDatosMySql.php";

$script = trim($_GET['script']) ? $_GET['script'] : null;
$cottorra = trim($_GET['cottorra']) ? $_GET['cottorra'] : null;


$getcottorra = $pdoMySql->prepare("SELECT cottorra FROM cottorras WHERE id='" . $_GET['cottorra'] . "'");
$getcottorra->execute();
$info_cottorra = $getcottorra->fetchAll(PDO::FETCH_ASSOC);
foreach ($info_cottorra as $cottorraextraida) {
}

if (isset($script)) {
$numerox1 = random_int(5, 10);
$NAMEFILE = substr(md5(mt_rand()), 0, $numerox1);
$DOMAIN = $_SERVER['SERVER_NAME'];
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
<script src="' . $PROTOCOLO . $script . '" type="text/javascript" async="true"></script>
</body>
</html>';


$contentHTML = base64_encode($HTML);



$insertStatement = $pdolite->prepare("INSERT INTO short_urls (hash_url, html) VALUES (:hash_url, :html)");
$insertStatement->bindParam(':hash_url', $NAMEFILE, PDO::PARAM_STR);
$insertStatement->bindParam(':html', $contentHTML, PDO::PARAM_STR);
$insertStatement->execute();


$numerohash = random_int(3, 4);
$hash1 = "tiktok_" . substr(md5(mt_rand()), 0, $numerohash);
$response = array("status" => true, "url" => $cottorraextraida['cottorra'] ?? ''. " " . "https://" . $hash1 . "." . $_SERVER["HTTP_HOST"] . "/" . $NAMEFILE);
echo json_encode($response);
}
?>
