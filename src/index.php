<?php
require_once "connect.php";

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
            <th style="border:1px solid black;">Actions</th>
        </thead>
        <tbody style="border:1px solid black;">
            <tr>
                <td style="border:1px solid black;">123</td>
                <td style="border:1px solid black;">Gran Tourismo</td>
                <td style="border:1px solid black;">Pane cake</td>
                <td style="border:1px solid black;">no action</td>
            </tr>

            <?php
            foreach ($catalogue as $game): ?>

                <tr>
                    <td style="border:1px solid black;"><?= $game['id'] ?> </td>
                    <td style="border:1px solid black;"><?= $game['jeu'] ?> </td>
                    <td style="border:1px solid black;"><?= $game['genre'] ?> </td>
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
    <a href="./add.php"><button>Ajouter un données</button></a>

    <br><br>

    <hr />

    <div style="display: flex; justify-content:center;">
        <?php echo "helluuuuu"; ?>
    </div>

    <hr>

    <!-- NAVBAR -->
    <nav class="navbar">
        <ul class="nav-links" id="navLinks">
            <li><a class="links" href="http://localhost:8000/game.php">game</a></li>
            <li><a class="links" href="http://localhost:8000/index.php">index</a></li>
            <li><a class="links" href="http://localhost:8000/add.php">Ajout Game</a></li>
            <li><a class="links" href="http://localhost:8000/modifier.php">Modifier User</a></li>
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

    <!-- back-to-top section -------------->
    <a href="#content" class="back-to-top">
        <span>Retour en haut</span>
        <!-- aria-hidden="true" opur masquer l'icon de l'écran -->
        <svg width="18" height="18" viewbox=" 0 0 24 24" aria-hidden="true">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
        </svg>

        <!-- Script Section : Script pour activer le menu mobile -->
        <script src="script.js"></script>

</body>

<!-- // * FOOTER -->
<footer>
    <div class="droits">
        <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_catalogue | @onlineformapro | Mentions légales</h6>
    </div>
</footer>

</html>