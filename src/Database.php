<?php

/**
 * 
 * 
 * 
 * Auteur : Omar Egal Ahmed 
 * Date : 25.11.2024
 * Description :classe Database qui sert à regrouper les fonctions qui serons utiliser sur les autres pages
 */


 class Database {


    // Variable de classe
    private $connector;

    /**
     * TODO: � compl�ter
     */
    public function __construct(){

        // TODO: Se connecter via PDO et utilise la variable de classe $connector
        try
        {
            $this->connector = new PDO('mysql:host=localhost:6033;dbname=db_nickname;charset=utf8' , 'root', 'root');
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Permet de pr�parer et d�ex�cuter une requ�te de type simple (sans where)
     */
    private function querySimpleExecute($query){

        $req = $this->connector->query($query);
        return $req;
    }

    /**
     *permet de pr�parer, de binder et d�ex�cuter une requ�te (select avec where ou insert, update et delete)
     */
    private function queryPrepareExecute($query, $binds){
        
        $req = $this->connector->prepare($query);
        foreach($binds as $label => $value) {
            $req->bindValue($label, $value, PDO::PARAM_STR);
        }
        $req->execute();
        return $req;
    }

    /**
     *  traiter les donn�es pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
     */
    private function formatData($req){

        $result = $req->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    private function unsetData($req){

        // TODO: vider le jeu d�enregistrement
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
     * TODO: récupère la liste des informations pour 1 enseignant
     */
    public function getOneTeacher($id){

        $query = "SELECT * FROM t_teacher WHERE idTeacher = $id;";

        // TODO: avoir la requ�te sql pour 1 enseignant (utilisation de l'id)
        // TODO: appeler la m�thode pour executer la requ�te

        $req = $this->querySimpleExecute($query);
        
        
        // TODO: appeler la m�thode pour avoir le r�sultat sous forme de tableau

        $teacher = $this->formatData($req);
        // TODO: retour l'enseignant

        return $teacher[0];
    }


    public function getOneSection($idSection){

        $query = "SELECT secName FROM t_section WHERE idSection = $idSection";

        $req = $this->querySimpleExecute($query);

        $sections = $this->formatData($req);

        return $sections[0];

    }

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
   
    $query = "INSERT INTO t_teacher (teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection) 
              VALUES (:firstName, :name, :gender, :nickname, :origin, :section)";

    $binds = [
        ':firstName' => $firstName,
        ':name' => $name,
        ':gender' => $gender,
        ':nickname' => $nickname,
        ':origin' => $origin,
        ':section' => $section
    ];

    return $this->queryPrepareExecute($query, $binds);
}



public function deleteTeacher($idTeacher) {


    $query = "DELETE FROM t_teacher WHERE idTeacher = :idTeacher";


    $binds = [
        ':idTeacher' => $idTeacher,
    ];

    return $this->queryPrepareExecute($query, $binds);

}



    // + tous les autres m�thodes dont vous aurez besoin pour la suite (insertTeacher ... etc)
 }



?>