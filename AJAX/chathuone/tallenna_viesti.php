<?php
require "kanta.php";

$kirjoittaja = strip_tags($_POST["kirjoittaja"]);
$sisalto = strip_tags($_POST["sisalto"]);

$haku = "INSERT INTO viesti (kirjoittaja,    sisalto,   aika)
         VALUES             ('$kirjoittaja', '$sisalto', NOW());";
$result = $mysql->query($haku);
echo $result;
?>