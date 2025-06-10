<?php
// * Est-ce que les champs de formulaire sont définis
if (
    isset($_GET["id"])      // Vérifie si la variable 'id' existe dans l'URL (ex: ?id=123)
    && !empty($_GET["id"])  // Vérifie si cette variable n'est pas vide (ex: ?id=)
) {

    // * Définitions de variables
    require_once "connect.php";
    $id = $_GET["id"];
    // print_r($id);

    // * sql SELECT
    $sql = "SELECT * FROM jeux WHERE id = :id";

    // * préparation de la requête sql
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // * exécution de la requête sql
    $query->execute();

    $jeu = $query->fetch();
    // print_r($jeu);

    require "disconnect.php";
}
?>

<!-- http://localhost:8001/jeu.php?id=3 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-svg">
    <link rel="stylesheet" href="css/style.css">

    <!-- TITRE -->
    <?php
    // * enlever le isset est possible, !empty evite l'option "utilisateur qui entre une id inexistante dans la BDD", isset ne l'évite pas *
    if (isset($jeu) && !empty($jeu)):
        // print_r($jeu);
    ?>
        <title>Page de <?= $jeu['jeu'] ?></title>
</head>

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

    <a href="https://fabulous-platypus-fdb4a3.netlify.app">Wink Netlify WebbApp</a>

    <!-- <img width="10%" src="0Jvtfvy.gif" alt="Gran turismo 2 sur playstation"> -->
    <br>
    <h1 style="border:1px solid black; background-color: black; color: white; width:fit-content">Jeu</h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $jeu['jeu'] ?></h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $jeu['genre'] ?></h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $jeu['annee'] ?></h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $jeu['editeur_id'] ?></h1>
    <img src="img/liste" alt="" />
    <!-- <p>Jeu : Yo</p>
    <p>Nom : YDM</p> -->

<?php
    else:
?>

    <p>jeu non présent</p>
    <a href="http://localhost:8001/home.php">Back to menu</a>

<?php
    endif;
?>

<!-- // * FOOTER -->
<footer>
    <div class="droits">
        <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_jeux_Vidéos | @onlineformapro | Mentions légales</h6>
    </div>
</footer>

</body>

<script src="script.js"></script>

</html>