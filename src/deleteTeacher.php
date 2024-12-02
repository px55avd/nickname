<?php
if (!file_exists('./Database.php')) {
    die('Fichier Database.php introuvable.');
}
include('./Database.php');

//id teacher
$id = $_GET["idTeacher"];

$db = new Database(); // Créer une instance de la base de données
$db->deleteTeacher($id);

header("Location: ./index.php");
exit();

