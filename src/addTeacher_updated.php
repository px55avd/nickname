<?php
include("./Database.php");// Inclure la classe Database
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
        <div class="user-body">
            
<?php
require_once 'Database_updated.php'; 

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $genre = $_POST['genre'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $name = $_POST['name'] ?? '';
    $nickName = $_POST['nickName'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $section = $_POST['section'] ?? '';

    // Vérifier que tous les champs obligatoires sont remplis
    if ($genre && $firstName && $name && $nickName && $origin && $section) {
        $db = new Database(); // Créer une instance de la base de données

        // Insérer les données
        if ($db->insertTeacher($firstName, $name, $nickName, $origin, $genre, $section)) {
            echo "<p>Enseignant ajouté avec succès !</p>";
        } else {
            echo "<p>Erreur lors de l'ajout de l'enseignant.</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}
?>
<form action="addTeacher.php" method="post" id="form">

                <h3>Ajout d'un enseignant</h3>
                <p>
                    <input type="radio" id="genre1" name="genre" value="M" checked>
                    <label for="genre1">Homme</label>
                    <input type="radio" id="genre2" name="genre" value="F">
                    <label for="genre2">Femme</label>
                </p>
                <p>
                    <label for="firstName">Nom :</label>
                    <input type="text" name="firstName" id="firstName" value="">
                </p>
                <p>
                    <label for="name">Prénom :</label>
                    <input type="text" name="name" id="name" value="">
                </p>
                <p>
                    <label for="nickName">Surnom :</label>
                    <input type="text" name="nickName" id="nickName" value="">
                </p>
                <p>
                    <label for="origin">Origine :</label>
                    <textarea name="origin" id="origin"></textarea>
                </p>
                <p>
                    <label style="display: none" for="section"></label>
                    <select name="section" id="section">
                        <option value="">Section</option>
                        <option value="info">Informatique</option>
                        <option value="bois">Bois</option>
                    </select>
                </p>
                <p>
                    <input type="submit" value="Ajouter">
                    <button type="button" onclick="document.getElementById('form').reset();">Effacer</button>
                </p>
            </form>
        </div>
        <div class="user-footer">
            <a href="index.php">Retour à la page d'accueil</a>
        </div>
    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

</body>

</html>