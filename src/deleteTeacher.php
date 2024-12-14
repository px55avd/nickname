<?php
/**
 * Auteur : Omar Egal Ahmed 
 * Date : 25.11.2024
 * Description : script qui controle la supression d'un enseigant.
 */


// Vérifie si le fichier 'Database.php' n'existe pas dans le répertoire courant.
// Si le fichier n'est pas trouvé, l'exécution du script est arrêtée et un message d'erreur est affiché.
if (!file_exists('./Database.php')) {

    die('Fichier Database.php introuvable.');   // Arrête l'exécution et affiche un message d'erreur.
}

// Si le fichier 'Database.php' existe, il est inclus dans le script.
// Cela permet d'utiliser les classes, fonctions ou variables définies dans 'Database.php'.
include('./Database.php');

// Récupération de l'id teacher
$id = $_GET["idTeacher"];

$db = new Database(); // Créer une instance de la base de données

$db->deleteTeacher($id);   // Appelle de la fonction pour supprimer un enseignant de la base de données.

// Redirige l'utilisateur vers la page 'index.php' du même répertoire.
// La fonction 'header' envoie un en-tête HTTP qui indique au navigateur de rediriger l'utilisateur vers l'URL spécifiée.
// Dans ce cas, il s'agit de rediriger vers 'index.php'.
header("Location: ./index.php");

// Arrête l'exécution du script après la redirection.
// La fonction 'exit()' garantit qu'aucun autre code ne sera exécuté après l'en-tête de redirection.
exit();

