<?php
require_once "connect.php";

// * sql CREATE
$sql = "CREATE DATABASE catalogue";

// * sql SELECT
$sql = "SELECT * FROM catalogue";

// * préparation de la requête sql
$query = $db->prepare($sql);

// $query->bindValue(':id', $id, PDO::PARAM_INT);
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
    <link rel="icon" href="src\favicon.ico" type="image/x-svg">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="script.js"></script>

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
            <li><a href="http://localhost:8001/add.php">Ajout jeu</a></li>
            <li><a href="http://localhost:8001/modifier.php">Modifier jeu</a></li>
            <li><a href="http://localhost:8001/home.php">Back to menu</a></li>
        </ul>
    </nav>
    <h1 style="background-color: black; color: white; width:fit-content">Indexds</h1>
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
            <th style="border:1px solid black;">annee</th>
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
            foreach ($catalogue as $jeu): ?>

                <tr>
                    <td style="border:1px solid black;"><?= $jeu['id'] ?> </td>
                    <td style="border:1px solid black;"><?= $jeu['jeu'] ?> </td>
                    <td style="border:1px solid black;"><?= $jeu['genre'] ?> </td>
                    <td style="border:1px solid black;"><?= $jeu['annee'] ?> </td>
                    <td style="border:1px solid black;">
                        <a style="border:1px solid black;" href="jeu.php?id=<?= $jeu['id'] ?>">Voir</a>
                        <a style="border:1px solid black;" href="modifier.php?id=<?= $jeu['id'] ?>">Modifier</a>
                        <a style="border:1px solid black;" href="supprimer.php?id=<?= $jeu['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>

    <br>
    <img width="10%" src="icon-256x256.gif" alt="gif d'ajout d'utilisateur">
    <br>
    <br>
    <a href="./add.php"><button>Ajouter un jeu</button></a>

    <br><br>

    <hr />

    <div style="display: flex; justify-content:center;">
        <?php echo "helluuuuu"; ?>
    </div>

    <div style="display: flex; justify-content:center;">
        <?php echo "U"; ?>
    </div>

    <hr>

    <!-- * envoie email -->
    <?php
    // // Le message
    // $message = "Line 1\r\nLine 2\r\nLine 3";

    // // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
    // $message = wordwrap($message, 70, "\r\n");

    // // Envoi du mail
    // mail('yoan.demenzes@gmail.com', 'Mon Sujet', $message);
    ?>
    <?php
    // $destinataire = array();
    // $result = mysql_query("SELECT * FROM alerte_chat_benin");
    // while ($reponse = mysql_fetch_array($result)) {
    //     $destinataire[] = $reponse['champ_mail'];
    // }

    // $mail = "projetbenin@gmail.com";
    // $objet = "objet du mail";
    // $contenu = 'contenu du mail';

    // $headers = 'From: ' . $mail . "\r\n";
    // $headers .= 'MIME-Version: 1.0' . "\r\n";
    // $headers .= 'Content-Type: text/html; charset="iso-8859-1"' . "\n";
    // $headers .= 'Content-Transfer-Encoding: 8bit';

    // $mail_envoye = @mail(implode(';', $destinataire), $objet, $contenu, $headers);
    ?>
    <hr />

    <?php

    // Affiche toutes les infos, comme le ferait INFO_ALL
    // phpinfo();

    // Affiche uniquement le module d'infos.
    // phpinfo(8) fournirait les mêmes infos.
    // phpinfo(INFO_MODULES);

    ?>
    <!-- // * FOOTER -->
    <footer>
        <div class="droits">
            <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_jeux_Vidéos | @onlineformapro | Mentions légales</h6>
        </div>
    </footer>

    <!-- back-to-top section -------------->
    <a href="#content" class="back-to-top">
        <span>top</span>
        <!-- aria-hidden="true" opur masquer l'icon de l'écran -->
        <svg width="10" height="10" viewbox=" 0 0 24 24" aria-hidden="true">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
        </svg>

</body>

</html>