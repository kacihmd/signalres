<?php
    require_once('MainModel.php');

    class AnomalieModel extends MainModel {

        function __construct() {
            parent::__construct("anomalie");
        }
        
        public function addAnomalie(String $cat, String $descprob) {
            $sql = "INSERT INTO anomalie VALUES (NULL, '".$cat."', '".$descprob."', NULL);";
            $query = $this->connexion->prepare($sql);
            $query->execute();

            // Retourne l'identifiant de l'anomalie ajoutée
            $sql = "SELECT MAX(idanomalie) FROM anomalie;";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return intval($query->fetch(PDO::FETCH_NUM)[0]);  
        }

        public function setAnomaliePermanent($idano) {
            $sql = "UPDATE anomalie SET idticket = NULL WHERE idanomalie = ".$idano.";";
            $query = $this->connexion->prepare($sql);
            $query->execute();
        }

        public function getAnomaliesOfCategory(String $category) {
            $sql = "SELECT idanomalie, descprobl FROM anomalie WHERE categorie='".$category."';";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);  
        }
    }
?>