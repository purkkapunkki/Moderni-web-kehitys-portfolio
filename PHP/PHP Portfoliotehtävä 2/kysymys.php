<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tyylit.css">
    <title>kysymys-sivu</kysymys-sivu></title>
</head>
<body>
    <?php require 'otsake.php';?>

    <main>
        <?php require 'sivupaneeli.php';?>

        <article>
        <form method="post">
            <label><b>Kysy neuvoja</b></label>
            <label for="otsikko">Otsikko</label>
            <input type="text" name="otsikko" id="otsikko">
            <label for="kategoria-valinta">Valitse kategoria</label>
            <select id="kategoria-valinta" name="kategoria-valinta">
                <?php
                $idhaku = "SELECT * FROM `kategoria`;";
                $tulokset = $mysql->query($idhaku);
                while ($kategoria = $tulokset->fetch_assoc()) {
                    echo "<option value='{$kategoria['id']}'>{$kategoria['nimi']}</option>";
                }
                ?>

            </select>

            <textarea name="kysymys" placeholder="Kirjoita kysymyksesi tähän"></textarea>
            <input class="nappi" type="submit" name="kysymysnappi" value="Lähetä">
        </form>

        <?php
        if (isset($_POST["kysymysnappi"])) {
            $otsikko = $_POST["otsikko"];
            $kategoria = $_POST["kategoria-valinta"];
            $kysymys = $_POST["kysymys"];

            if (!empty($otsikko) && !empty($kategoria) && !empty($kysymys)) {
                $aika = "TODO";
                $kayttaja_id = $_SESSION["id"];
                $haku = "INSERT INTO `kysymys` (`otsikko`,  `sisalto`,  `aika`, `kayttaja_id`,  `kategoria_id`)
                    VALUES                     ('$otsikko', '$kysymys', NOW(),  '$kayttaja_id', '$kategoria');";
                $mysql->query($haku);
                echo "Kysymyksesi on lähetetty! Voit käydä katsomassa sitä Kategoriat-sivulla.";
            }
        }
        ?>
        </article>
    </main>
</body>
</html>