<?php 

// Vérifie si le fichier 'Database.php' n'existe pas dans le répertoire courant.
// Si le fichier n'est pas trouvé, l'exécution du script est arrêtée et un message d'erreur est affiché.
if (!file_exists('./Database.php')) {

    die('Fichier Database.php introuvable.');   // Arrête l'exécution et affiche un message d'erreur.
}

// Si le fichier 'Database.php' existe, il est inclus dans le script.
// Cela permet d'utiliser les classes, fonctions ou variables définies dans 'Database.php'.
include('./Database.php');

//récupère l'index du tableau
$id = $_GET["idTeacher"];

$db = new Database();   // Créer une instance de la base de donnéesS

$teacher = $db->getOneTeacher($id); // Appelle de la fonction pour récupérer un enseigant 

$section = $db->getOneSection($teacher["fkSection"]);   // Appelle de la fonction pour récupérer un section

var_dump($section);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/style.css" rel="stylesheet">
    <title>Version statique de l'application des surnoms</title>
</head>

<body>

    <header>
        <div class="container-header">
            <div class="titre-header">
                <h1>Surnom des enseignants</h1>
            </div>
            <div class="login-container">
                <form action="#" method="post">
                    <label for="user"> </label>
                    <input type="text" name="user" id="user" placeholder="Login">
                    <label for="password"> </label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                    <button type="submit" class="btn btn-login">Se connecter</button>
                </form>
            </div>
        </div>
        <nav>
            <h2>Zone pour le menu</h2>
            <a href="index.php">Accueil</a>
            <a href="addTeacher.php">Ajouter un enseignant</a>
        </nav>
    </header>

    <div class="container">
        <div class="user-head">
            <h3>Détail : <?= $teacher["teaFirstname"] . " ". $teacher["teaName"]; // rajout du prénome et nom?>
                
                <?php
                // affichage du logo male ou femelle
                if($teacher["teaGender"]=="H"){
                    echo '<img style="margin-left: 1vw;" height="20em" src="./img/male.png" alt="male symbole">';
                }else{
                   echo '<img style="margin-left: 1vw;" height="20em" src="./img/femelle.png" alt="femelle symbole">';
                }
                ?>
                
            </h3>
            <p>
               <?= $section["secName"];//?>
            </p>
            <div class="actions">

                <a href="#">
                    <img height="20em" src="./img/edit.png" alt="edit icon"></a>
                <a href="javascript:confirmDelete()">
                    <img height="20em" src="./img/delete.png" alt="delete icon"> </a>

            </div>
        </div>
        <div class="user-body">
            <div class="left">
                <p>Surnom : <?= $teacher["teaNickname"]; // rajout du nickname?></p>
                <p><?= $teacher["teaOrigine"];// rajout de l'origine du nickmane?></p>
            </div>
        </div>
        <div class="user-footer">
            <a href="index.php">Retour à la page d'accueil</a>
        </div>

    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

    <script src="js/script.js"></script>

</body>

</html>