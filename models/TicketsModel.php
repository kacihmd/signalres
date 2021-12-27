<?php
    require_once('MainModel.php');

    class TicketsModel extends MainModel {

        function __construct() {
            parent::__construct("tickets");
        }
        
        public function addOne($description, $categorie, $localisation, $iduser){
            $sql = "INSERT INTO ".$this->table." VALUES (NULL,'".$description."','".$categorie."','".$localisation."',".$iduser.")";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

        public function getAll(){
            $sql = 'SELECT idtickets, res.idres, description, res.categorie, 
                           localisation, descprobl, signaldate 
                    FROM tickets, res, anomalie
                    WHERE tickets.idres = res.idres && tickets.idanomalie = anomalie.idanomalie;';

            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);    
        }
    }
?>