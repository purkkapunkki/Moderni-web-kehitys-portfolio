<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tyylit.css">
    <title>etusivu</title>
</head>
<body>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect("localhost", "uutisankkuri", "uutisetjasää", "uutiskanta");

?> 
    <header class="keskitetty" id="paa-otsikko">
        <h1><i>Satuvaltakunnan tarinat</i></h1>
        <h2><i>Uutisia lumotusta maasta</i></h2>
    </header>

    <div>
        <div class="valiotsikot" id="saaotsikko">
            <h4>Viikon sää - Viikko 21</h4>
        </div>
        <div id="saapalkki">
        <?php
        $saaennusteet = simplexml_load_file("http://localhost/PHP/sääsyöte.php?viikko=21");
        foreach($saaennusteet->children() as $saaennuste) {
            echo "<div class='ennustepalkki'>";
            $paiva = date_create($saaennuste->paiva);
            $paiva = date_format($paiva, "j.n.Y");
            echo "<p class='keskitetty saa-paivamaara'><b>$paiva</b></p>";
            echo "<p class='keskitetty lampotila'><b>$saaennuste->lampotila °C</b></p>";
            echo "<p><b>Säätila</b>: <br>$saaennuste->säätila</p>";
            echo "<p><b>Tuulennopeus</b>: <br>$saaennuste->tuulennopeus m/s</p>";
            echo "</div>";
        }
        ?> 
        </div>
    </div>


    <main>
<div id="paaotsikko">
        <?php

    $pääuutiset_haku = "SELECT * FROM uutiset WHERE paauutinen ORDER BY julkaisuaika DESC LIMIT 2;";


    $tulos = mysqli_query($mysqli, $pääuutiset_haku);
    $rivit = array();
    while($paauutinen = mysqli_fetch_assoc($tulos)) {
        $otsikko = $paauutinen['otsikko'];
        $julkaisuaika = date_create($paauutinen['julkaisuaika']);
        $julkaisuaika = date_format($julkaisuaika, "j.n.Y \k\l\o H:i");
        $kirjoittaja = $paauutinen['kirjoittaja'];
        $sisalto = $paauutinen['sisalto'];
        echo "<article>";
        echo "<h4>$otsikko</h4>";
        echo "<p class='harmaateksti'>$julkaisuaika || $kirjoittaja</p>";
        echo "<p>$sisalto</p>";
        echo "</article>";
    }

        ?> 
</div>



    <section>
        <div>
            <div>
                <h3 class="valiotsikot">Uusimmat uutiset</h3> 
            </div>
            <?php
            $uutisotsikko_haku = "SELECT otsikko, julkaisuaika FROM uutiset;";
            $tulos = mysqli_query($mysqli, $uutisotsikko_haku);
            $rivit = array();
            while($uutisotsikko = mysqli_fetch_assoc($tulos)) {
                $otsikko = $uutisotsikko["otsikko"];
                $julkaisuaika = date_create($uutisotsikko['julkaisuaika']);
                $julkaisuaika = date_format($julkaisuaika, "j.n.Y \k\l\o H:i");
                echo "<div class='uutisotsikko dash-borderi'>";
                echo "<p><b>$otsikko</b></p>";
                echo "<p class='harmaateksti'>$julkaisuaika</p>";
                echo "</div>";
            }
            ?> 
        </div>


        <div>
            <div>
                <h3 class="valiotsikot">Vierailevat kirjoittajat</h3>
            </div>

            <?php
            $json = file_get_contents("http://localhost/PHP/blogisyöte.php");

            $blogikirjoitukset = json_decode($json, true);
            foreach($blogikirjoitukset as $blogikirjoitus) {
                $nimi = utf8_decode($blogikirjoitus["nimi"]);
                $otsikko = utf8_decode($blogikirjoitus["otsikko"]);
                $kirjoittaja = utf8_decode($blogikirjoitus["kirjoittaja"]);
                $julkaisuaika = utf8_decode($blogikirjoitus["julkaisuaika"]);
                $julkaisuaika = date_create($julkaisuaika);
                $julkaisuaika = date_format($julkaisuaika, "j.n.Y");
                echo "<div class='dash-borderi'>";
                echo "<p><b>$nimi</b>: $otsikko</p>";
                echo "<div class='aika harmaateksti'>";
                echo "<div class='harmaateksti'>$kirjoittaja</div>";
                echo "<div>$julkaisuaika</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>

        </div>
    </section>
    </main>

</body>
</html>


