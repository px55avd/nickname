<?php

include("./Database.php");

$db = new Database();
$teachers = $db->getAllTeachers();

// var_dump($teachers);


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
        <h3>Liste des enseignants</h3>
        <form action="#" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Surnom</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $html = "";

                    //boucle pour les enseignants 
                    foreach($teachers as $teacher) {

                        $html .= "<tr>";

                        $html .= "<td>" . $teacher["teaName"] . " " .  $teacher["teaFirstname"] . "</td>";// rajout du prénom et nom
                        $html .= "<td>" . $teacher["teaNickname"] . "</td>";// rajout du nickname

                        $html .= "<td class=\"containerOptions\">";

                        $html .= "<a href=\"./updateTeacher.php?idTeacher=" . $teacher["idTeacher"] ."\">";
                        $html .= "<img height=\"20em\" src=\"./img/edit.png\" alt=\"edit\">";
                        $html .= "</a>";

                        $html .= "<a onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant?');\" href=\"./deleteTeacher.php?idTeacher=" . $teacher["idTeacher"] ."\">";
                        $html .= "<img height=\"20em\" src=\"./img/delete.png\" alt=\"delete\">";
                        $html .= "</a>";

                        $html .= "<a href=\"./detailTeacher.php?idTeacher=" . $teacher["idTeacher"]."\">";// ajout dans l'url dans l'id teacher avec un POST
                        $html .= "<img height=\"20em\" src=\"./img/detail.png\" alt=\"detail\">";
                        $html .= "</a>";

                        $html .= "</td>";

                        $html .= "</tr>";


                        /*onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant?');*/
                    }
                    echo $html;
                   ?>
                </tbody>
            </table>
        </form>
        <script src="js/script.js"></script>
    </div>

    <footer>
        <p>Copyright GCR - bulle web-db - 2022</p>
    </footer>

</body>

</html>