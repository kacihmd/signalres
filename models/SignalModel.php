<?php
    require_once('MainModel.php');

    class SignalModel extends MainModel {

        function __construct() {
            parent::__construct("tickets");
        }
        
        // Créer un nouveau ticket.
        public function addTicket(int $idres, int $idano, bool $newAno){
            $sql = "INSERT INTO ".$this->table.
                    " VALUES (NULL, ".$idres.",".$idano.", '".date("Y-m-d H:i:s")."');";

            $query = $this->connexion->prepare($sql);
            $query->execute();    

            // Si c'était une anomalie entrée par un utlisateur 
            // il faut la relier au ticket
            if ($newAno) {
                $sql = "SELECT MAX(idtickets) FROM tickets;";
                $query = $this->connexion->prepare($sql);
                $query->execute();
                $idticket = intval($query->fetch(PDO::FETCH_NUM)[0]);

                $sql = "UPDATE anomalie SET idticket = ".$idticket." WHERE idanomalie = ".$idano.";";
                $query = $this->connexion->prepare($sql);
                $query->execute();
            }
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

        public function getAnomaliesOfCategory(String $category) {
            $sql = "SELECT idanomalie, descprobl FROM anomalie WHERE categorie='".$category."';";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);  
        }
    }
?>