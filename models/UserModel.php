<?php
    require_once('MainModel.php');

    // UserModel : Classe permettant la manipulation des responsables de l'application.
    class UserModel extends MainModel {

        function __construct() {
            parent::__construct("users");
        }
        
        public function addOne($username, $password){
            $sql = "INSERT INTO ".$this->table." VALUES (NULL,'".$username."','".$password."')";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

        // getUsernames: Retourne la liste des noms d'utilisateur des repsonsables
        public function getUsernames() {
            $sql = "SELECT username FROM " . $this->table;
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_NUM);
        }

        // getIdOfUsername: Retourne l'identifiant numérique du responsable dont le nom
        //                  est donné par $username
        public function getIdOfUsername(String $username) {
            $sql = "SELECT iduser FROM users WHERE username = '". $username. "';";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return intval($query->fetch(PDO::FETCH_NUM)[0]);
        }
    }
?>