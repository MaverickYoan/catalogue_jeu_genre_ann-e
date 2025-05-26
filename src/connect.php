<?php
const SERVER_NAME = "db";
const DB_NAME = 'catalogue';
const USERNAME = "test";
const PASSWORD = "test";
const PORT = "5432";

try {
    //code pour connexion réussie...
    $db = new PDO("pgsql:host=" . SERVER_NAME . ";port=" . PORT . ";dbname=" . DB_NAME . ";", USERNAME, PASSWORD);
    // echo "connexion réussie";
} catch (PDOException $e) {
    //code pour connexion nok...
    //throw $th;
    echo "échec de connexion : " . $e->getMessage() . "<br>";
}
