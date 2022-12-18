<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tyylit.css">
    <title>Kategoria</title>
</head>
<body>
    <?php require 'otsake.php';?>
    <main>
        <?php require 'sivupaneeli.php';?>
        <article>
            <div>
                <?php
                
                $kategoria_id = $_GET["id"];
                $kategoriahaku = "SELECT nimi FROM kategoria WHERE id = $kategoria_id;";
                $tulos = $mysql->query($kategoriahaku);
                $kategoria = $tulos->fetch_assoc();
                echo "<h1>{$kategoria['nimi']}</h1>";
                ?>

                <ul id="kysymyslista">
                    <?php
                    $kysymyshaku = "SELECT kysymys.id AS id, `käyttäjä`.nimimerkki AS nimimerkki, kysymys.aika AS aika, kysymys.otsikko as otsikko
                    FROM `kysymys` JOIN `käyttäjä` ON `käyttäjä`.`id` = `kysymys`.`kayttaja_id`
                    WHERE `kysymys`.`kategoria_id` = '$kategoria_id' ORDER BY `aika`;";
                    $tulokset = $mysql->query($kysymyshaku);
                    while ($kysymys = $tulokset->fetch_assoc()) {
                        $id = $kysymys["id"];
                        $nimimerkki = $kysymys["nimimerkki"];
                        $aika = $kysymys["aika"];
                        $otsikko = $kysymys["otsikko"];
                        echo "<li><a href='vastaus.php?id=$id'>$aika - $nimimerkki - $otsikko</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </article>
    </main>
</body>
</html>