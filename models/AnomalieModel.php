<?php
    require_once('MainModel.php');

    // AnomalieModel : Classe permettant de manipuler les anomalies de la base de données.
    class AnomalieModel extends MainModel {

        function __construct() {
            parent::__construct("anomalie");
        }
        
        // addAnomalie: Permet d'ajouter une anomalie à la base de donnée.
        // Retourne l'identifiant de l'anomalie ajoutée.
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

        // setAnomaliePermanent: Permet de définir une anomalie comme permanente.
        // Elle est détachée de son ticket et ne sera pas supprimée lors de la suppression du ticket
        public function setAnomaliePermanent($idano) {
            $sql = "UPDATE anomalie SET idticket = NULL WHERE idanomalie = ".$idano.";";
            $query = $this->connexion->prepare($sql);
            $query->execute();
        }
    }
?>