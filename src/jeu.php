<?php
// * Est-ce que les champs de formulaire sont définis
if (
    isset($_GET["id"])      // Vérifie si la variable 'id' existe dans l'URL (ex: ?id=123)
    && !empty($_GET["id"])  // Vérifie si cette variable n'est pas vide (ex: ?id=)
) {

    // * Définitions de variables
    require_once "connect.php";
    $id = $_GET["id"];
    print_r($id);

    // * sql SELECT
    $sql = "SELECT * FROM catalogue WHERE id = :id";

    // * préparation de la requête sql
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // * exécution de la requête sql
    $query->execute();

    $game = $query->fetch();
    // print_r($game);

    require "disconnect.php";
}
?>

<!-- http://localhost:8000/game.php?id=3 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-svg">
    <!-- TITRE -->
    <?php
    // * enlever le isset est possible, !empty evite l'option "utilisateur qui entre une id inexistante dans la BDD", isset ne l'évite pas *
    if (isset($game) && !empty($game)):
        // print_r($game);
    ?>
        <title>Page de <?= $game['jeu'] ?></title>
</head>

<body style="background-image: url(img/icon-256x256.gif); background-repeat: no-repeat; background-position: center; background-size: 20%;">
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
    <img width="10%" src="src\img\0Jvtfvy.gif" alt="Gran turismo 2 sur playstation">
    <br>
    <h1 style="border:1px solid black; background-color: black; color: white; width:fit-content">Jeu</h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $game['jeu'] ?></h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $game['genre'] ?></h1>
    <h1 style="border:1px solid black; width:fit-content"><?= $game['année'] ?></h1>
    <!-- <p>Jeu : Yo</p>
    <p>Nom : YDM</p> -->

<?php
    else:
?>

    <p>jeu non présent</p>
    <a href="/">Back to menu</a>

<?php
    endif;
?>

</body>

<!-- // * FOOTER -->
<footer>
    <div class="droits">
        <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_catalogue_jeux_Vidéos | @onlineformapro | Mentions légales</h6>
    </div>
</footer>

</html>