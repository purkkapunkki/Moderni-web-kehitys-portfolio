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
            <?php
            if (isset($_POST["rekisteroitymisnappi"])) {
                $kayttajatunnus = $_POST["kayttajatunnus"];
                $sahkoposti = $_POST["sahkoposti"];
                $salasana = $_POST["salasana"];
                if (!empty($kayttajatunnus) && !empty($sahkoposti) && !empty($salasana)) {
                    $haku = "INSERT INTO `käyttäjä` (`nimimerkki` , `sähköposti` , `salasana`)
                        VALUES ('$kayttajatunnus', '$sahkoposti', '$salasana');";
                    $tulos = $mysql->query($haku);
                    $kayttaja_id = $mysql->insert_id;
                    $_SESSION["id"] = $kayttaja_id;
                }
            }
            ?>
            <form method="post">
                <h1>Rekisteröidy</h1>
                <label>Käyttäjätunnus:</label>
                <input type="text" name="kayttajatunnus">

                <label>Sähköposti:</label>
                <input type="email" name="sahkoposti">
                
                <label>Salasana:</label>
                <input type="password" name="salasana">

                <input class="nappi" type="submit" name="rekisteroitymisnappi" value="Rekisteröidy">
            </form>
        </article>
    </main>
</body>
</html>