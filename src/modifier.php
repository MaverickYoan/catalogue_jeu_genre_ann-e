<?php
// * Check si connexion réussie
require_once "connect.php";

// * $_POST (superglobale check si l'utilisateur à cliqué sur submit si le form est en method = $_POST)
if ($_POST) {
    if (
        !empty($_POST["jeu"])
        && !empty($_POST["genre"])
        && !empty($_POST["annee"])
    ) {
        $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
        $jeu = htmlspecialchars(strip_tags($_POST["jeu"]));
        $genre = htmlspecialchars(strip_tags($_POST["genre"]));
        $annee = htmlspecialchars(strip_tags($_POST["annee"]));

        // * Mise à jour des données jeu et/ou genre
        $sql = "UPDATE jeux
        SET jeu = :jeu, genre = :genre, annee = :annee
        WHERE id=:id;";

        $query = $db->prepare($sql);

        // * Rattacher les valeurs de bindValue id à la requête SQL
        $query->bindValue(":id", $id, PDO::PARAM_INT);

        // * Rattacher les valeurs de bindValue jeu à la requête SQL
        $query->bindValue(":jeu", $jeu, PDO::PARAM_STR);

        // * Rattacher les valeurs de bindValue genre à la requête SQL
        $query->bindValue(":genre", $genre, PDO::PARAM_STR);

        // * Rattacher les valeurs de bindValue genre à la requête SQL
        $query->bindValue(":annee", $annee, PDO::PARAM_INT);

        // * Exécution de la requête SQL
        $query->execute();

        // * Renvoyer le nouvel utilisateur à la page d'accueil après ajout
        header("Location: index.php");

        // * Pour terminer toutes exécution de scripts
        exit;
    }
}

// * Est-ce que les champs de formulaire sont définis
if (
    isset($_GET["id"])      // Vérifie si la variable 'id' existe dans l'URL (ex: ?id=123)
    && !empty($_GET["id"])  // Vérifie si cette variable n'est pas vide (ex: ?id=)
) {

    // * Définitions de variables
    $id = $_GET["id"];
    // print_r($id);

    // * sql SELECT 
    $sql = "SELECT * FROM catalogue WHERE id = :id";

    // * préparation de la requête sql
    $query = $db->prepare($sql);

    // * Rattacher les valeurs de bindValue id à la requête SQL
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // * exécution de la requête sql
    $query->execute();

    $jeu = $query->fetch();
    // print_r($jeu);

    require "disconnect.php";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta Name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modif_php_crud</title>
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
            <li><a href="http://localhost:8001/add.php">Ajout jeu</a></li>
            <li><a href="http://localhost:8001/modifier.php">Modifier jeu</a></li>
            <li><a href="http://localhost:8001/home.php">Back to menu</a></li>
        </ul>
    </nav>

    <p style="border: 1px solid black; width: fit-content; background-color: yellow; color: black"><b>Modifier un jeu</b></p>

    <!-- post envoie en masquer un formulaire -->
    <form method="post">
        <label for="jeu">Jeu</label>
        <!--// * Nous insérons la valeur du Jeu du game dans le champ jeu -->
        <input type="text" Name="jeu" id="jeu" value="<?= $jeu["jeu"] ?>" required>
        <label for="genre">Genre</label>
        <!--// * Nous insérons la valeur du Genre du game dans le champ genre -->
        <input type="text" Name="genre" id="genre" value="<?= $jeu["genre"] ?>" required>
        <label for="annee">annee</label>
        <!--// * Nous insérons la valeur de l'annee du game dans le champ genre -->
        <input type="number" Name="annee" id="annee" value="<?= $jeu["annee"] ?>" required>
        <!--// * Champ caché -->
        <input type="hidden" name="id" value="<?= $jeu["id"] ?>">
        <input type="submit" value="Modifier">
    </form>

</body>

<!-- // * FOOTER -->
<footer>
    <div class="droits">
        <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_jeux_Vidéos | @onlineformapro | Mentions légales</h6>
    </div>
</footer>

</html>