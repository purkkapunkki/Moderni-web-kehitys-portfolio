<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tyylit.css">
    <title>vastaus-sivu</vastaus-sivu></title>
</head>
<body>
    <?php require 'otsake.php';?>
    <main>
        <?php require 'sivupaneeli.php';?>
        <article>
            <div>
                <?php
                $kysymys_id = $_GET["id"];

                if (isset($_POST["vastausnappi"])) {
                    $vastaus = $_POST["vastaus"];
                    $kayttaja_id = $_SESSION["id"];
                    $haku = "INSERT INTO `vastaus` (`sisalto`,  `aika`, `kayttaja_id`,  `kysymys_id`)
                            VALUES                ('$vastaus', NOW(),  '$kayttaja_id', '$kysymys_id');";
                    $mysql->query($haku);
                    echo "Vastauksesi on lähetetty!";
                }

                $kysymyshaku = "SELECT * FROM kysymys WHERE id = $kysymys_id;";
                $tulos = $mysql->query($kysymyshaku);
                $kysymys = $tulos->fetch_assoc();
                echo "<h1>Kysymys: {$kysymys['otsikko']}</h1>";
                echo "<h2>{$kysymys['sisalto']}</h2>";
                echo "<h1>Vastaukset</h1>";
                echo "<div id='vastaukset'>";
                $vastaushaku = "SELECT `vastaus`.`sisalto`, `vastaus`.`aika`, `käyttäjä`.`nimimerkki` FROM `vastaus`
                    JOIN `käyttäjä` ON `käyttäjä`.`id` = vastaus.kayttaja_id
                    WHERE kysymys_id = $kysymys_id ORDER BY `aika`;";
                $tulokset = $mysql->query($vastaushaku);
                while($vastaus = $tulokset->fetch_assoc()) {
                    echo "<div class='vastaus'>";
                    echo "<p>{$vastaus['sisalto']}</p>";
                    echo "<p>{$vastaus['aika']} - {$vastaus['nimimerkki']}</p>";
                    echo "</div>";
                }
                echo "</div>";
                ?>

                <form method="post" <?php if (!$on_kirjautunut) {echo 'class="piilotettu"';}?>>
                    <label><b>Vastaa valitsemaasi kysymykseen</b></label>
                    <textarea name="vastaus" placeholder="Kirjoita vastauksesi tähän"></textarea>
                    <input class="nappi" type="submit" name="vastausnappi" value="Lähetä">
                </form>
            </div>
        </article>
    </main>
</body>
</html>