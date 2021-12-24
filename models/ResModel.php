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
    }
?>