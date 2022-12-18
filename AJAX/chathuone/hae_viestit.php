<?php
    require "kanta.php";

    $haku = "SELECT * FROM (SELECT * FROM viesti ORDER BY aika DESC LIMIT 10) AS viesti ORDER BY aika;";
    
    $tulokset = $mysql->query($haku);
    while ($viesti = $tulokset->fetch_assoc()) {
        $aika = $viesti['aika'];
        $kirjoittaja = $viesti['kirjoittaja'];
        $aika = date("H.i", strtotime(date($aika)));
        $sisalto = $viesti['sisalto'];

        echo "<p><b>$kirjoittaja [$aika]: </b>$sisalto";
        echo "</p>";
    }

?>