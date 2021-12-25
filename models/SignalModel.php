<?php
    require_once('MainModel.php');

    class SignalModel extends MainModel {

        function __construct() {
            parent::__construct("anomalie");
        }
        
        public function addOne($idres, $desc){
            $sql = "INSERT INTO ".$this->table." VALUES (".$idres.",'".$desc."')";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }
    
    }
?>