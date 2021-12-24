<?php
    require_once('MainModel.php');

    class UserModel extends MainModel {

        function __construct() {
            parent::__construct("users");
        }
        
        public function addOne($username, $password){
            $sql = "INSERT INTO ".$this->table." VALUES (10,'".$username."','".$password."')";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

    }
?>