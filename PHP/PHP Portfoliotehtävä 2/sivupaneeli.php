
<section>
<?php
require 'kanta.php';
if (isset($_POST["kirjautumisnappi"])) {
    $sahkoposti = $_POST["sahkoposti"];
    $salasana = $_POST["salasana"];
    $haku = "SELECT `id` FROM `käyttäjä` WHERE `sähköposti` = '$sahkoposti' AND `salasana` = '$salasana';";
    $tulos = $mysql->query($haku);
    $kayttaja = $tulos->fetch_assoc();
    if ($kayttaja) {
        echo "Tervetuloa!<br>";
        $_SESSION["id"] = $kayttaja["id"];
    } else {
        echo "Väärä salasana :(";
    }
}
if (isset($_POST["uloskirjautumisnappi"])) {
    echo "Olet nyt kirjautunut ulos.<br>";
    session_unset();
}
$on_kirjautunut = isset($_SESSION["id"]);
if ($on_kirjautunut) {
    $kayttaja_id = $_SESSION['id'];
    $nimihaku = "SELECT `nimimerkki` FROM `käyttäjä` WHERE `id` = '$kayttaja_id';";
    $tulos = $mysql->query($nimihaku);
    $kayttaja = $tulos->fetch_assoc();
    $kayttajatunnus = $kayttaja["nimimerkki"];
    echo "Käyttäjä \"$kayttajatunnus\" on kirjautunut sisään.<br>";
}
?>
<br>
<form method="post" <?php if ($on_kirjautunut) {echo 'class="piilotettu"';}?>>
    <label>Sähköposti:</label>
    <input type="email" name="sahkoposti">
    
    <label>Salasana:</label>
    <input type="password" name="salasana">

    <input class="nappi" type="submit" name="kirjautumisnappi" value="Kirjaudu sisään">
</form>

<form method="post" <?php if (!$on_kirjautunut) {echo 'class="piilotettu"';}?>>
    <input class="nappi" type="submit" name="uloskirjautumisnappi" value="Kirjaudu ulos">
</form>

<ul class="nappi-lista nappi-lista-pysty">
    <li <?php if ($on_kirjautunut) {echo 'class="piilotettu"';}?>>
        <a href="rekisteroityminen.php" class="linkkinappi">Rekisteröidy</a>
    </li>
    <li><a href="etusivu.php" class="linkkinappi">Kategoriat</a></li>
    <li <?php if (!$on_kirjautunut) {echo 'class="piilotettu"';}?>>
        <a href="kysymys.php" class="linkkinappi">Kysy kysymys</a>
    </li>
</ul>
</section>



