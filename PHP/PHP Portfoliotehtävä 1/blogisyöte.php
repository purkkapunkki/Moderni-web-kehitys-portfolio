<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect("localhost", "uutisankkuri", "uutisetjasää", "uutiskanta");

$haku = "SELECT blogikirjoitus.otsikko, blogikirjoitus.teksti, blogikirjoitus.julkaisuaika, blogi.nimi, blogi.kirjoittaja 
FROM blogikirjoitus 
INNER JOIN blogi 
ON blogikirjoitus.blogi_id = blogi.blogi_id;";

$tulos = mysqli_query($mysqli, $haku);
$rivit = array();
while($blogikirjoitus = mysqli_fetch_assoc($tulos)) {
    $rivit[] = array_map('utf8_encode', $blogikirjoitus);
}
header('Content-Type: application/json; charset=UTF-8');
$json = json_encode($rivit);
echo $json;
?> 