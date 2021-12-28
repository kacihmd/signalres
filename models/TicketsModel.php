<?php
    require_once('MainModel.php');

    class TicketsModel extends MainModel {

        function __construct() {
            parent::__construct("tickets");

            $this->sql_retrieve_tickets = 
                    'SELECT tickets.idtickets, res.idres, description, res.categorie, 
                    localisation, anomalie.idanomalie, descprobl, res.iduser, signaldate 
                    FROM tickets, res, anomalie
                    WHERE tickets.idres = res.idres && tickets.idanomalie = anomalie.idanomalie';
        }
        
        public function addOne($description, $categorie, $localisation, $iduser) {
            $sql = "INSERT INTO ".$this->table." VALUES (NULL,'".$description."','".$categorie."','".$localisation."',".$iduser.")";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

        public function getAll() {
            $query = $this->connexion->prepare($this->sql_retrieve_tickets);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);    
        }

        public function getValues($key, $value) {
            $sql = $this->sql_retrieve_tickets . " && tickets.".$key."='".$value."'";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);    
        }

        public function setAnomaliePermanent($idano) {
            $sql = "UPDATE anomalie SET idticket = NULL WHERE idanomalie = ".$idano.";";
            $query = $this->connexion->prepare($sql);
            $query->execute();
        }
    }
?>