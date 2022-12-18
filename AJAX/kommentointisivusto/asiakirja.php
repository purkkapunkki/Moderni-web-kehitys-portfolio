<?php
    require 'kanta.php';
    
    $where_ehto = "";
    if (isset($_GET['id'])) {
        $where_ehto = "WHERE asiakirja_id = {$_GET['id']}";
    }
    $haku = "SELECT * FROM asiakirja $where_ehto;";
    
    $tulokset = $mysql->query($haku);
    while ($asiakirja = $tulokset->fetch_assoc()) {
        $otsikko = $asiakirja['otsikko'];
        $kirjoittaja = $asiakirja['kirjoittaja'];
        $pvm = $asiakirja['pvm'];
        $pvm = date("d.m.Y", strtotime(date($pvm)));
        $teksti = str_replace("\r\n\r\n", "\n\n", $asiakirja["teksti"]);
        $teksti = str_replace("\n\n", "</p><p>", $teksti);

        echo "<h2>$otsikko</h2>";
        echo "<p class='kirjoittajainfo'><b>Kirjoittanut: </b>";
        echo "$kirjoittaja ($pvm)";
        echo "</p>";
        echo "<p>$teksti</p>";
    }
?>
