<?php
    require_once('MainModel.php');

    class ResModel extends MainModel {

        function __construct() {
            parent::__construct("res");
        }
        
        public function addOne($description, $categorie, $localisation, $iduser){
            $sql = "INSERT INTO ".$this->table." VALUES (NULL,'".$description."','".$categorie."','".$localisation."',".$iduser.")";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

        public function getAll(){
            $sql = 'SELECT idres, description, categorie, localisation, 
                    username FROM res, users WHERE res.iduser = users.iduser;';

            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);    
        }
    
        public function getValues($key, $value){
            $sql = 'SELECT idres, description, categorie, localisation, username 
                    FROM res, users WHERE res.iduser = users.iduser && res.'
                    .$key."='".$value."';";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_NUM);    
        }

        public function getIduserOfRes(int $idRes) {
            $sql = 'SELECT iduser FROM res WHERE idres =' .$idRes. ';';
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return intval($query->fetch(PDO::FETCH_NUM)[0]);
        }
    }
?>