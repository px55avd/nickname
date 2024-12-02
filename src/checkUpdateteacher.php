<?php
if (!file_exists('./Database.php')) {
    die('Fichier Database.php introuvable.');
}
include('./Database.php');



$errors = array();

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/

//var_dump($_POST['genre']);

if(!isset($_POST['genre'])){

    $errors[] = "Le genre n'est pas renseigné.";
}

//var_dump($_POST['name']);

//condition du nom
if(!isset($_POST['name']) || $_POST['name'] == ""){

    $errors[] = "Le prénom n'est pas renseigné.";
}

//var_dump($_POST['firstName']);

if(!isset($_POST['firstName']) || $_POST['firstName'] == ""){

    $errors[] = "Le nom n'est pas renseigné.";
}


//var_dump($_POST['nickName']);

if(!isset($_POST['nickName']) || $_POST['nickName'] == ""){

    $errors[] = "Le surnom n'est pas renseigné.";
}


//var_dump($_POST['origin']);

if(!isset($_POST['origin']) || $_POST['origin'] === ""){

    $errors[] = "L'origine n'est pas renseigné.";
}


/*var_dump($_POST['section']);*/

if(!isset($_POST['section']) || $_POST['section'] == ""){

    $errors[] = "La section n'est pas renseigné.";
}


if (count($errors) > 0) {

    foreach ($errors as $error) {
        echo "<pre>";
        echo $error;
        echo"</pre>";
    }

} else {
        

    // Récupérer les données du formulaire
    //id teacher
    $id = $_POST["idTeacher"];
    $genre = $_POST['genre'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $name = $_POST['name'] ?? '';
    $nickName = $_POST['nickName'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $section = $_POST['section'] ?? '';

    $db = new Database(); // Créer une instance de la base de données
    $db->updateTeacher($id, $firstName, $name, $nickName, $origin, $genre, $section);
    header("Location: ./index.php");
    exit();
} 