<?php
// * Est-ce que les champs de formulaire sont définis
if (
    !empty($_GET["id"])  // Vérifie si cette variable n'est pas vide (ex: ?id=)
) {
    require_once "connect.php";

    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

    // * sql DELETE
    $sql = "DELETE FROM catalogue WHERE id= :id;";

    // * préparation de la requête sql
    $query = $db->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);

    // * exécution de la requête sql
    $query->execute();

    // * close de la fonction connexion réussie
    require "disconnect.php";

    // * Renvoyer le nouvel utilisateur à la page d'accueil après ajout
    header("Location: index.php");

    // * Pour terminer toutes exécution de scripts
    exit;
}
