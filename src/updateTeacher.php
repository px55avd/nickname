<?php 

include("./Database.php");

$db = new Database();
$sections = $db->getAllSections();

$teacher = $db->getOneTeacher($_GET["idTeacher"]);
var_dump($teacher);
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
            

            <form action="./checkUpdateteacher.php" method="post" id="form">

                <h3>Mise à jour d'un enseignant</h3>
                <input type="hidden" name="idTeacher" value="<?php echo htmlspecialchars($teacher["idTeacher"]); ?>">
                <p>             
                    <input type="radio" id="genre1" name="genre" value="M" <?php if ($teacher["teaGender"] === "M") { echo "checked"; } ?> >
                    <label for="genre1">Homme</label>
                    <input type="radio" id="genre2" name="genre" value="F" <?php if ($teacher["teaGender"] === "F") { echo "checked"; } ?> >
                    <label for="genre2">Femme</label>
                </p>
                <p>
                    <label for="firstName">Prénom  :</label>
                    <input type="text" name="firstName" id="firstName" value="<?= $teacher["teaFirstname"] ?>">
                </p>
                <p>
                    <label for="name">Nom :</label>
                    <input type="text" name="name" id="name" value="<?= $teacher["teaName"] ?>">
                </p>
                <p>
                    <label for="nickName">Surnom :</label>
                    <input type="text" name="nickName" id="nickName" value="<?= $teacher["teaNickname"] ?>">
                </p>
                <p>
                    <label for="origin">Origine :</label>
                    <textarea name="origin" id="origin"><?= $teacher["teaOrigine"] ?></textarea>
                </p>
                <p>
                    <label style="display: none" for="section"></label>
                    <select name="section" id="section">
                        <option value="">Section</option>
                        <?php 
                            $html = "";
                            foreach($sections as $section) {

                                $html .= "<option "; 
                                if ($section["idSection"] === $teacher["fkSection"]) {
                                    $html .= " selected ";
                                }
                                $html .= "value=" . $section["idSection"] .  ">" . $section["secName"] . "</option>";
                            }
                            echo $html;
                        ?>

                    </select>
                </p>
                <p>
                    <input type="submit" value="Modifier">
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