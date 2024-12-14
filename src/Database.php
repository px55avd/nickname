<?php

/**
 * Auteur : Omar Egal Ahmed 
 * Date : 25.11.2024
 * Description :classe Database qui sert à regrouper les fonctions qui serons utiliser sur les autres pages
 */

 class Database {


    // Variable de classe
    private $connector;


    /**
     * Se connecter via PDO et utilise la variable de classe $connector
    */
    public function __construct(){
        try
        {
            // Tentative de connexion à la base de données avec PDO
            // Utilisation des paramètres suivants : hôte localhost sur le port 6033, base de données db_nickname, et encodage UTF-8
            $this->connector = new PDO('mysql:host=localhost:6033;dbname=db_nickname;charset=utf8' , 'root', 'root');
        }
        catch (PDOException $e)
        {
            // En cas d'échec de la connexion (exception PDOException), afficher un message d'erreur et arrêter l'exécution du script
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Permet de preparer et d'executer une requete de type simple (sans where)
     */
    private function querySimpleExecute($query){

        // Utilise la méthode 'query' de l'objet 'connector' pour envoyer la requête à la base de données
        $req = $this->connector->query($query);

        // Retourne le résultat de l'exécution de la requête
        return $req;
    }

    /**
     *Permet de preparer, de binder et d'executer une requete (select avec where ou insert, update et delete)
     */
    private function queryPrepareExecute($query, $binds){
        
        // Préparation de la requête SQL avec la méthode 'prepare' de PDO.
        // Cela permet de préparer la requête avant de l'exécuter, ce qui protège contre les injections SQL.
        $req = $this->connector->prepare($query);

        // Boucle pour lier les valeurs des paramètres à la requête préparée.
        // La variable $binds est un tableau associatif où chaque clé représente un label (paramètre)
        // et chaque valeur représente la donnée à lier à ce label.
        foreach($binds as $label => $value) {
            
            // 'bindValue' lie chaque valeur à son label dans la requête préparée.
            // On spécifie que le type de la valeur liée est une chaîne (PDO::PARAM_STR).
            $req->bindValue($label, $value, PDO::PARAM_STR);
        }

        // Exécution de la requête préparée après avoir lié les valeurs des paramètres.
        // La méthode 'execute' exécute la requête avec les valeurs déjà liées.
        $req->execute();

        // Retourne l'objet de la requête, qui contient les résultats de l'exécution.
        return $req;
    }

    /**
     *  traiter les donnees pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
     */
    private function formatData($req){

        // Récupère tous les résultats de la requête sous forme de tableau associatif.
        // La méthode 'fetchAll' permet de récupérer toutes les lignes du résultat, chaque ligne étant un tableau associatif où les clés sont les noms des colonnes.
        // 'PDO::FETCH_ASSOC' spécifie que les résultats doivent être récupérés sous forme de tableau associatif (clés = noms des colonnes).
        $result = $req->fetchALL(PDO::FETCH_ASSOC);

        // Retourne le résultat sous forme de tableau associatif contenant toutes les lignes récupérées par la requête.
        return $result;
    }

    /**
     * TODO: A completer
     */
    private function unsetData($req){

        // TODO: vider le jeu d'enregistrement
    }

    /**
     * Récupère la liste de tous les enseignants de la BD
     */
    public function getAllTeachers(){

        // avoir la requète sql
        $query = "SELECT * FROM t_teacher;";

        // appeler la méthode pour executer la requête
        $req = $this->querySimpleExecute($query);

        // appeler la méthode pour avoir le résultat sous forme de tableau
        $teachers = $this->formatData($req);

        // retour tous les enseignants
        return $teachers;
    }

    /**
     * récupère la liste des informations pour 1 enseignant
     */
    public function getOneTeacher($id){

        // avoir la requete sql pour 1 enseignant (utilisation de l'id)
        $query = "SELECT * FROM t_teacher WHERE idTeacher = $id;";

        // appeler la methode pour executer la requete
        $req = $this->querySimpleExecute($query);
    
        // appeler la m�thode pour avoir le r�sultat sous forme de tableau
        $teacher = $this->formatData($req);

        // retour l'enseignant
        return $teacher[0];
    }


    /**
     * Récupère le nom d'une section en fonction de son identifiant.
     */
    public function getOneSection($idSection){

        // Construction de la requête SQL pour sélectionner le nom de la section correspondant à l'identifiant fourni.
        // La requête recherche dans la table 't_section' la colonne 'secName' pour un enregistrement ayant l'id 'idSection'.
        $query = "SELECT secName FROM t_section WHERE idSection = $idSection";

        // Exécution de la requête simple avec la méthode 'querySimpleExecute' définie ailleurs.
        // Elle retourne un objet ou un résultat lié à la requête.
        $req = $this->querySimpleExecute($query);

        // Formatage des données de la requête en utilisant la méthode 'formatData'.
        // Cette méthode peut transformer le format brut des résultats (par exemple, en tableau associatif).
        $sections = $this->formatData($req);

        // Retourne le premier élément de la liste formatée, qui devrait être le nom de la section.
        // En supposant que la requête retourne une seule ligne.
        return $sections[0];

    }


    /**
     * récupère la liste des informations pour 1 section
     */
    public function getAllSections(){

        // avoir la requète sql
        $query = "SELECT * FROM t_section;";

        // appeler la méthode pour executer la requête
        $req = $this->querySimpleExecute($query);

        // appeler la méthode pour avoir le résultat sous forme de tableau
        $sections = $this->formatData($req);

        // retour tous les sections
        return $sections;
    }


/**
 * Insère un nouvel enseignant dans la base de données.
 *
 * @param string $firstName Le prénom de l'enseignant.
 * @param string $name Le nom de l'enseignant.
 * @param string $nickname Le surnom de l'enseignant.
 * @param string $origin L'origine de l'enseignant.
 * @param string $gender Le genre de l'enseignant (M/F).
 * @param int $section L'ID de la section de l'enseignant.
 * @return bool Succès de l'insertion.
 */
public function insertTeacher($firstName, $name, $nickname, $origin, $gender, $section) {
   
    // Construction de la requête SQL pour insérer un nouvel enseignant dans la table 't_teacher'.
    // Cette requête utilise des paramètres nommés (avec des :paramètres) pour éviter les injections SQL et permettre le lien des valeurs.
    $query = "INSERT INTO t_teacher (teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection) 
              VALUES (:firstName, :name, :gender, :nickname, :origin, :section)";

    // Tableau associatif contenant les valeurs à lier aux paramètres dans la requête SQL.
    // Chaque clé correspond à un paramètre nommé dans la requête, et chaque valeur est celle que l'on souhaite insérer.
    $binds = [
        ':firstName' => $firstName,     // Prénom de l'enseignant
        ':name' => $name,               // Nom de l'enseignant
        ':gender' => $gender,           // Genre de l'enseignant
        ':nickname' => $nickname,       // Surnom de l'enseignant
        ':origin' => $origin,           // Origine du surnom de l'enseignant
        ':section' => $section          // Section de l'enseignant
    ];

    // Exécution de la requête préparée avec les paramètres liés.
    // La méthode 'queryPrepareExecute' prend la requête et les paramètres, les prépare et les exécute.
    return $this->queryPrepareExecute($query, $binds);
}


/**
 * Supprime un enseignant de la base de données en fonction de son identifiant.
*/
public function deleteTeacher($idTeacher) {

    // Construction de la requête SQL pour supprimer un enseignant de la table 't_teacher'.
    // La requête utilise un paramètre nommé ':idTeacher' pour spécifier l'enseignant à supprimer.
    $query = "DELETE FROM t_teacher WHERE idTeacher = :idTeacher";

    // Tableau associatif contenant la valeur à lier au paramètre ':idTeacher' dans la requête SQL.
    // Le paramètre ':idTeacher' sera lié à l'identifiant de l'enseignant à supprimer.
    $binds = [
        ':idTeacher' => $idTeacher,
    ];

    // Exécution de la requête préparée avec les paramètres associés.
    // La méthode 'queryPrepareExecute' est utilisée pour préparer et exécuter la requête de suppression.
    return $this->queryPrepareExecute($query, $binds);

}



/**
 * met à jour un enseignant dans la base de données.
 *
 * @param int $idTeacher L'ID l'enseignant.
 * @param string $firstName Le prénom de l'enseignant.
 * @param string $name Le nom de l'enseignant.
 * @param string $nickname Le surnom de l'enseignant.
 * @param string $origin L'origine de l'enseignant.
 * @param string $gender Le genre de l'enseignant (M/F).
 * @param int $section L'ID de la section de l'enseignant.
 * @return bool Succès de l'insertion.
 */
public function updateTeacher($idTeacher, $firstName, $name, $nickname, $origin, $gender, $section) {
    
    // Construction de la requête SQL pour modifier un nouvel enseignant dans la table 't_teacher'.
    // Cette requête utilise des paramètres nommés (avec des :paramètres) pour éviter les injections SQL et permettre le lien des valeurs.
    $query = "UPDATE t_teacher 
              SET teaFirstname = :firstName, teaName = :name, teaGender = :gender, teaNickname = :nickname, teaOrigine = :origin, fkSection = :section
              WHERE idTeacher = :idTeacher";


    // Tableau associatif contenant les valeurs à lier aux paramètres dans la requête SQL.
    // Chaque clé correspond à un paramètre nommé dans la requête, et chaque valeur est celle que l'on souhaite insérer.
    $binds = [
        ':idTeacher' => $idTeacher,     // ID de l'enseignant
        ':firstName' => $firstName,     // Prénom de l'enseignant
        ':name' => $name,               // Nom de l'enseignant
        ':gender' => $gender,           // Genre de l'enseignant
        ':nickname' => $nickname,       // Surnom de l'enseignant
        ':origin' => $origin,           // Origine du surnom de l'enseignant
        ':section' => $section          // Section de l'enseignant
    ];

    // Exécution de la requête préparée avec les paramètres liés.
    // La méthode 'queryPrepareExecute' prend la requête et les paramètres, les prépare et les exécute.
    return $this->queryPrepareExecute($query, $binds);
}

    // + tous les autres m�thodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }



?>