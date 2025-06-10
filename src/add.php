<?php
// * Afficher les données rentrées dans le formualire de $_POST, il utilise le header, si on met dans une même page un header et un print_r ALORS ERREUR
if ($_POST) {
    // * Est-ce que les champs de formulaire sont définis
    if (
        isset($_POST["jeu"])
        && isset($_POST["genre"])
        && isset($_POST["annee"])
        // * isset : est present même si vide; !empty oblige à inserer du contenu
        && !empty($_POST["jeu"])
        && !empty($_POST["genre"])
        && !empty($_POST["annee"])
    ) {
        // print_r(value: $_POST);

        // * Enlève les balises HTML et PHP des STRING
        $jeu = strip_tags($_POST["jeu"]);
        $genre = strip_tags($_POST["genre"]);
        $annee = strip_tags($_POST["annee"]);

        // * Check si connexion réussie
        require_once "connect.php";

        // * Requête SQL pour ajouter des données (finir le commentaire)
        $sql = "INSERT INTO catalogue (jeu, genre, annee) VALUES (:jeu, :genre, :annee);";

        // * préparation de la base de données SQL
        $query = $db->prepare($sql);

        // * Rattacher les valeurs de bindValue jeu à la requête SQL
        $query->bindValue(":jeu", $jeu, PDO::PARAM_STR);

        // * Rattacher les valeurs de bindValue genre à la requête SQL
        $query->bindValue(":genre", $genre, PDO::PARAM_STR);

        // * Rattacher les valeurs de bindValue annee à la requête SQL
        $query->bindValue(":annee", $annee, PDO::PARAM_INT);

        // * Exécution de la requête SQL
        $query->execute();

        // * récupération des données de la requête sql
        // $catalogue = $query->fetchAll(PDO::FETCH_ASSOC);

        // * close de la fonction connexion réussie
        require "disconnect.php";

        // * Renvoyer le nouvel utilisateur à la page d'accueil après ajout
        header("Location: index.php");

        // * Pour terminer toutes exécution de scripts
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta Name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-svg">

    <title>Add_php_crud</title>
</head>

<body style="background-image: url(img/totoro.gif); background-repeat: no-repeat; background-position: right;">
    <!-- NAVBAR -->
    <nav class="navbar">
        <ul class="nav-links" id="navLinks">
            <li><a href="http://localhost:8001/home.html">home</a></li>
            <li><a href="http://localhost:8001/jeux.html">Jeux</a></li>
            <li><a href="http://localhost:8001/index.php">Index</a></li>
            <li><a href="http://localhost:8001/liste.php">Liste de Jeux</a></li>
            <li><a href="http://localhost:8001/jeu.php">Jeu</a></li>
            <li><a href="http://localhost:8001/add.php">Ajout jeu</a></li>
            <li><a href="http://localhost:8001/modifier.php">Modifier jeu</a></li>
        </ul>
    </nav>

    <p style="border: 1px solid black; width: fit-content; background-color: green; color: white"><b>Ajouter un jeu</b></p>

    <!-- post envoie en masquer un formulaire -->
    <form method="post">
        <label for="jeu">jeu</label>
        <input type="text" Name="jeu" id="jeu" required>
        <label for="genre">genre</label>
        <input type="text" Name="genre" id="genre" required>
        <label for="annee">annee</label>
        <input type="number" Name="annee" id="annee" required>
        <input type="submit" value="Ajouter">
    </form>

</body>

<!-- // * FOOTER -->
<footer>
    <div class="droits">
        <h6 style="display: flex; justify-content:center;">&copy; 2025 Projet_catalogue_jeux_Vidéos | @onlineformapro | Mentions légales</h6>
    </div>
</footer>

</html>