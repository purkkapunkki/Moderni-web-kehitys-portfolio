<?php
isset($_GET["viikko"]) or die("Viikko puuttuu");
header("Content-Type: application/xml; charset=utf-8");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect("localhost", "uutisankkuri", "uutisetjasää", "uutiskanta");
$viikko = $_GET["viikko"];
$haku = "SELECT * FROM saa WHERE vko = $viikko";

$tulos = mysqli_query($mysqli, $haku);
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><säätiedot></säätiedot>');
while($saaennuste = mysqli_fetch_assoc($tulos)) {
    $ennuste = $xml->addChild("ennuste");
    $saaennuste = array_map('utf8_encode', $saaennuste);
    $ennuste->addChild("id", $saaennuste["id"]);
    $ennuste->addChild("vko", $saaennuste["vko"]);
    $ennuste->addChild("paiva", $saaennuste["paiva"]);
    $ennuste->addChild("säätila", utf8_decode($saaennuste["saatila"]));
    $ennuste->addChild("lampotila", $saaennuste["lampotila"]);
    $ennuste->addChild("tuulennopeus", $saaennuste["tuulennopeus"]);
}
echo $xml->asXML();
?> 