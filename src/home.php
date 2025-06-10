<?php
require_once "connect.php";

// * sql SELECT
$sql = "SELECT * FROM jeux";

// * préparation de la requête sql
$query = $db->prepare($sql);

// * exécution de la requête sql
$query->execute();

// * récupération des données de la requête sql
$jeux = $query->fetchAll(PDO::FETCH_ASSOC);

// * afficher la table jeux
// print_r($jeux);

require "disconnect.php";
?>

<!DOCTYPE html>
<html lang="en">

<!-- HEAD -->

<head>
    <!-- // - 2 - META -->
    <meta charset=utf-8>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <link rel="icon" href="favicon.ico" type="image/x-svg">
    <link rel="stylesheet" href="css/style.css">
    <!-- TITRE -->
    <title>Index_Jeux_Vidéos</title>
</head>

<!-- BODY -->

<body id="content"><!-- NAVBAR -->
    <nav class="navbar">
        <div class="hamburger-menu" id="hamburgerMenu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="http://localhost:8001/home.php">home</a></li>
            <li><a href="http://localhost:8001/jeux.php">Jeux</a></li>
            <li><a href="http://localhost:8001/index.php">Index</a></li>
            <li><a href="http://localhost:8001/liste.php">Liste de Jeux</a></li>
            <li><a href="http://localhost:8001/jeu.php">Jeu</a></li>
            <li><a href="https://fabulous-platypus-fdb4a3.netlify.app/">Wink</a></li>
            <li><a href="http://localhost:8001/add.php">Ajout jeu</a></li>
            <li><a href="http://localhost:8001/modifier.php">Modifier jeu</a></li>
            <li><a href="http://localhost:8001/home.php">Back to menu</a></li>
        </ul>
    </nav>
    </nav>
    
    <a href="https://fabulous-platypus-fdb4a3.netlify.app">Wink Netlify WebbApp</a>

    <a href="http://localhost:8001/home.php">Back to menu</a>

    <h1 style="background-color: black; color: white; width:fit-content">Index</h1>
    <p>créer table sql catalogue</p>

    <h1 style="color:green; font-size:14px;">TABLE SQL catalogue</h1>

    <!-- // * Table catalogue -->
    <table style="border:1px solid white;">
        <!-- <pre> -->
        <?php
        // print_r($jeux)
        ?>
        <!-- </pre> -->
        <thead style="border:1px solid white;">
            <th style="border:1px solid white;">id</th>
            <th style="border:1px solid white;">jeu</th>
            <th style="border:1px solid white;">genre</th>
            <th style="border:1px solid white;">annee</th>
            <th style="border:1px solid white;">editeur_id</th>
            <th style="border:1px solid white;">Actions</th>
        </thead>
        <tbody style="border:1px solid white;">
            <tr>
                <td style="border:1px solid white;">3</td>
                <td style="border:1px solid white;">Gran Turismo</td>
                <td style="border:1px solid white;">Course</td>
                <td style="border:1px solid white;">1997</td>
                <td style="border:1px solid white;">14</td>
                <td style="border:1px solid white;">no action</td>
            </tr>

            <?php
            foreach ($jeux as $jeu): ?>

                <tr>
                    <td style="border:1px solid white;"><?= $jeu['id'] ?> </td>
                    <td style="border:1px solid white;"><?= $jeu['jeu'] ?> </td>
                    <td style="border:1px solid white;"><?= $jeu['genre'] ?> </td>
                    <td style="border:1px solid white;"><?= $jeu['annee'] ?> </td>
                    <td style="border:1px solid white;"><?= $jeu['editeur_id'] ?> </td>
                    <td style="border:1px solid white;">
                        <a href="jeu.php?id=<?= $jeu['id'] ?>">Voir</a>
                        <a href="modifier.php?id=<?= $jeu['id'] ?>">Modifier</a>
                        <a href="supprimer.php?id=<?= $jeu['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>

    <br>
    <img width="10%" src="comparaison-animation-gif-transparent.gif" alt="gif de la terre">
    <br>
    <br>
    <a href="./add.php"><button>Ajouter un jeu</button></a>

    <!-- * FOOTER -->
    <footer>
        <div class="droits">
            <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_jeux_Vidéos |
                @onlineformapro |
                Mentions légales</h6>
        </div>
    </footer>

    <!-- back-to-top section -------------->
    <!-- <a href="#content" class="back-to-top">
    <span>top</span>
    aria-hidden="true" opur masquer l'icon de l'écran
    <svg width="10" height="10" viewbox=" 0 0 24 24" aria-hidden="true">
        <path d="M5 12h14" />
        <path d="m12 5 7 7-7 7" /> -->
    <!-- </svg> -->

    <script src="script.js"></script>

</body>

</html>