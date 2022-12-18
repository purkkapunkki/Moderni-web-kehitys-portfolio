<?php
    require 'kanta.php';
    
    $asiakirja_id = $_GET['asiakirja_id'];
    $haku = "SELECT * FROM kommentti WHERE asiakirja_id = $asiakirja_id;";
    
    $tulokset = $mysql->query($haku);
    while ($kommentti = $tulokset->fetch_assoc()) {
        $kommentoija = $kommentti['kommentoija'];
        $pvm = $kommentti['pvm'];
        $pvm = date("d.m.Y", strtotime(date($pvm)));
        $teksti = str_replace("\r\n\r\n", "\n\n", $kommentti["teksti"]);
        $teksti = str_replace("\n\n", "</p><p>", $teksti);
        $otsikko = $kommentti['otsikko'];

        echo "<div class='kommentti'>";
        echo "<p class='kommentoijainfo'>";
        echo "$kommentoija ($pvm)";
        echo "</p>";        
        echo "<h2>$otsikko</h2>";
        echo  "<div class='kommenttisisalto'>";
        echo "<p>$teksti</p>";
        echo "</div>";
        echo "</div>";
    }
?>
