<?php
    require 'kanta.php';

    $otsikko = strip_tags($_POST["otsikko"]);
    $teksti = strip_tags($_POST["teksti"]);
    $kommentoija = strip_tags($_POST["kommentoija"]);
    $asiakirja_id = $_POST["asiakirja_id"];

    $haku = "INSERT INTO kommentti (otsikko, teksti, pvm, kommentoija, asiakirja_id)
             VALUES ('$otsikko', '$teksti', CURRENT_DATE(), '$kommentoija', $asiakirja_id);";
    $result = $mysql->query($haku);
    echo $result;
?>