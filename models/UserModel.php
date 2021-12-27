<?php
    require_once('MainModel.php');

    class UserModel extends MainModel {

        function __construct() {
            parent::__construct("users");
        }
        
        public function addOne($username, $password){
            $sql = "INSERT INTO ".$this->table." VALUES (NULL,'".$username."','".$password."')";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

        public function getUsernames() {
            $sql = "SELECT username FROM " . $this->table;
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_NUM);
        }

        public function getIdOfUsername(String $username) {
            $sql = "SELECT iduser FROM users WHERE username = '". $username. "';";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return intval($query->fetch(PDO::FETCH_NUM)[0]);
        }

        public function deleteOne($key, $value) {
            // On efface effectivement l'utilisateur voulu
            parent::deleteOne($key, $value);
            // Puis on réaffecte à admin les ressources devenue orpheline
            $sql = "UPDATE res SET iduser = '1' WHERE iduser IS NULL;";
            $query = $this->connexion->prepare($sql);
            $query->execute();
        }

    }
?>