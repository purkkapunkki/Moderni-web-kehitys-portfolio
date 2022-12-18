<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tyylit.css">
    <title>Kategoriat</title>
</head>
<body>
    <?php require 'otsake.php';?>
    <main>
        <?php require 'sivupaneeli.php';?>
        <article>
            <div id="kategorialinkit" class="nappi-lista">
                <?php
                $idhaku = "SELECT * FROM `kategoria`;";
                $tulokset = $mysql->query($idhaku);
                while ($kategoria = $tulokset->fetch_assoc()) {
                    echo "<a href='kategoria.php?id={$kategoria['id']}' class='linkkinappi'>{$kategoria['nimi']}</a>";
                }
                ?>
            </div>
        </article>
    </main>
</body>
</html>