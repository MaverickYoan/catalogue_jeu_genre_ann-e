<?php
require_once "connect.php";

// * sql SELECT
$sql = "CREATE DATABASE catalogue";

// * sql SELECT
$sql = "SELECT * FROM catalogue";

// * préparation de la requête sql
$query = $db->prepare($sql);

// * exécution de la requête sql
$query->execute();

// * récupération des données de la requête sql
$catalogue = $query->fetchAll(PDO::FETCH_ASSOC);

// * afficher la table catalogue
// print_r($catalogue);

require "disconnect.php";
?>


<!DOCTYPE html>
<html lang="en">

<!-- HEAD -->

<head>
    <!-- // - 2 - META -->
    <meta charset=utf-8>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <link rel="icon" href="src/img/favicon.ico" type="image/x-svg">
    <link rel="stylesheet" href="style.css">
    <!-- TITRE -->
    <title>Index_php_crud</title>
</head>

<!-- BODY -->

<body id="content" style="background-image: url(img/b3b48a35785465ed53f20d332f191a5c.gif);">

    <h1 style="border:1px solid black; background-color: black; color: white; width:fit-content">Index</h1>
    <p>créer table sql catalogue</p>

    <h1 style="color:green; font-size:14px;">TABLE SQL catalogue</h1>

    <!-- // * Table catalogue -->
    <table style="border:1px solid black;">
        <!-- <pre> -->
        <?php
        // print_r($catalogue)
        ?>
        <!-- </pre> -->
        <thead style="border:1px solid black;">
            <th style="border:1px solid black;">id</th>
            <th style="border:1px solid black;">jeu</th>
            <th style="border:1px solid black;">genre</th>
            <th style="border:1px solid black;">Année</th>
            <th style="border:1px solid black;">Actions</th>
        </thead>
        <tbody style="border:1px solid black;">
            <tr>
                <td style="border:1px solid black;">123</td>
                <td style="border:1px solid black;">Gran Turismo</td>
                <td style="border:1px solid black;">Course</td>
                <td style="border:1px solid black;">1997</td>
                <td style="border:1px solid black;">no action</td>
            </tr>

            <?php
            foreach ($catalogue as $game): ?>

                <tr>
                    <td style="border:1px solid black;"><?= $game['id'] ?> </td>
                    <td style="border:1px solid black;"><?= $game['jeu'] ?> </td>
                    <td style="border:1px solid black;"><?= $game['genre'] ?> </td>
                    <td style="border:1px solid black;"><?= $game['année'] ?> </td>
                    <td style="border:1px solid black;">
                        <a style="border:1px solid black;" href="game.php?id=<?= $game['id'] ?>">Voir</a>
                        <a style="border:1px solid black;" href="modifier.php?id=<?= $game['id'] ?>">Modifier</a>
                        <a style="border:1px solid black;" href="supprimer.php?id=<?= $game['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>

    <br>
    <img width="10%" src="img/11919432.gif" alt="gif d'ajout d'utilisateur">
    <br>
    <a href="./add.php"><button>Ajouter un jeu</button></a>

    <br><br>

    <hr />

    <div style="display: flex; justify-content:center;">
        <?php echo "helluuuuu U"; ?>
    </div>

    <hr>

    <!-- NAVBAR -->
    <nav class="navbar">
        <ul class="nav-links" id="navLinks">
            <li><a class="links" href="http://localhost:8000/index.php">Index</a></li>
            <li><a class="links" href="http://localhost:8000/jeu.php">Game</a></li>
            <li><a class="links" href="http://localhost:8000/add.php">Ajout jeu</a></li>
            <li><a class="links" href="http://localhost:8000/modifier.php">Modifier jeu</a></li>
            <a href="/">Back to menu</a>
        </ul>
    </nav>

    <hr />

    <?php

    // Affiche toutes les infos, comme le ferait INFO_ALL
    // phpinfo();

    // Affiche uniquement le module d'infos.
    // phpinfo(8) fournirait les mêmes infos.
    // phpinfo(INFO_MODULES);

    ?>

</body>

<!-- // * FOOTER -->
<footer>
    <div class="droits">
        <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_catalogue_jeux_Vidéos | @onlineformapro | Mentions légales</h6>
    </div>
</footer>

</html>