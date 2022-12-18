<?php require 'kanta.php';
    $haku = "SELECT asiakirja_id, otsikko FROM asiakirja;";
    $tulokset = $mysql->query($haku);
    while ($asiakirja = $tulokset->fetch_assoc()) {
        echo "<option value='{$asiakirja['asiakirja_id']}'>{$asiakirja['otsikko']}</option>";
    }
?>