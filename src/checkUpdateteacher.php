<?php
/**
 * Auteur : Omar Egal Ahmed 
 * Date : 25.11.2024
 * Description : script qui controle de la modification d'un nouvevelle enseigant.
 */


// Vérifie si le fichier 'Database.php' n'existe pas dans le répertoire courant.
// Si le fichier n'est pas trouvé, l'exécution du script est arrêtée et un message d'erreur est affiché.
if (!file_exists('./Database.php')) {

    die('Fichier Database.php introuvable.');   // Arrête l'exécution et affiche un message d'erreur.
}

// Si le fichier 'Database.php' existe, il est inclus dans le script.
// Cela permet d'utiliser les classes, fonctions ou variables définies dans 'Database.php'.
include('./Database.php');



$errors = array();  // Instanciation d'un tableau dans une variable

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/

//var_dump($_POST['genre']);

if(!isset($_POST['genre'])){

    $errors[] = "Le genre n'est pas renseigné.";    // intègre l'erreur dans le tableau
}

//var_dump($_POST['name']);

//condition du champs nom
if(!isset($_POST['name']) || $_POST['name'] == ""){

    $errors[] = "Le prénom n'est pas renseigné.";   // intègre l'erreur dans le tableau
}

//var_dump($_POST['firstName']);

//Condition du champs prénom
if(!isset($_POST['firstName']) || $_POST['firstName'] == ""){

    $errors[] = "Le nom n'est pas renseigné.";  // intègre l'erreur dans le tableau
}


//var_dump($_POST['nickName']);

//Condition du champs surnom
if(!isset($_POST['nickName']) || $_POST['nickName'] == ""){

    $errors[] = "Le surnom n'est pas renseigné.";   // intègre l'erreur dans le tableau
}


//var_dump($_POST['origin']);

//Condition du champs Origine
if(!isset($_POST['origin']) || $_POST['origin'] === ""){

    $errors[] = "L'origine n'est pas renseigné.";   // intègre l'erreur dans le tableau
}


/*var_dump($_POST['section']);*/

//Condition du champs section
if(!isset($_POST['section']) || $_POST['section'] == ""){

    $errors[] = "La section n'est pas renseigné.";  // intègre l'erreur dans le tableau
}

// condition si les erreurs sont supérieur à zéro
if (count($errors) > 0) {

    // Pour chaque erreur du tableau
    foreach ($errors as $error) {
        echo "<pre>";
        echo $error;    // Afffiche l'erreur
        echo"</pre>";
    }

} else {
        

    // Récupérer les données du formulaireS
    $id = $_POST["idTeacher"];
    $genre = $_POST['genre'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $name = $_POST['name'] ?? '';
    $nickName = $_POST['nickName'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $section = $_POST['section'] ?? '';

    $db = new Database(); // Créer une instance de la base de données

    $db->updateTeacher($id, $firstName, $name, $nickName, $origin, $genre, $section);   // Apellle de la fonction pour mettre à jour un enseigant dans la base de données

    // Redirige l'utilisateur vers la page 'index.php' du même répertoire.
    // La fonction 'header' envoie un en-tête HTTP qui indique au navigateur de rediriger l'utilisateur vers l'URL spécifiée.
    // Dans ce cas, il s'agit de rediriger vers 'index.php'
    header("Location: ./index.php");

    // Arrête l'exécution du script après la redirection.
    // La fonction 'exit()' garantit qu'aucun autre code ne sera exécuté après l'en-tête de redirection.
    exit();
} 