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

        // Créer un nouveau ticket et relie l'anomalie donnée au ticket si c'était une nouvelle anomalie.
        public function addTicket(int $idres, int $idano, int $iduser, bool $newAno){
            $sql = "INSERT INTO ".$this->table.
                    " VALUES (NULL, ".$idres.",".$idano.", ".$iduser.",'".date("Y-m-d H:i:s")."');";

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
    }
?>