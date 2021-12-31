<?php
    require_once('MainModel.php');

    // ResModel : Classe permettant de manipuler les ressources de la base de données
    class ResModel extends MainModel {

        function __construct() {
            parent::__construct("res");
        }
        
        // addOne: Permet l'ajout d'une ressource
        public function addOne($description, $categorie, $localisation, $iduser) {
            $sql = "INSERT INTO ".$this->table." VALUES (NULL,'".$description."','".$categorie."','".$localisation."',".$iduser.");";
            $query = $this->connexion->prepare($sql);
            $query->execute();    
        }

        // getAll: Retourne toutes les ressources de la table avec leur description, 
        //          leur localisation, leur categorie et le nom de leur responsable
        public function getAll(){
            $sql = 'SELECT idres, description, categorie, localisation, 
                    username FROM res, users WHERE res.iduser = users.iduser;';

            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);    
        }
    
        // getValues: Retourne toutes les ressources de la table avec leur description, 
        //              leur localisation, leur categorie et le nom de leur responsable 
        //              en fonction du critère donné sur les ressources
        public function getValues($key, $value){
            $sql = 'SELECT idres, description, categorie, localisation, username 
                    FROM res, users WHERE res.iduser = users.iduser && res.'
                    .$key."='".$value."';";
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_NUM);    
        }

        // getIduserOfRes: Retourne l'identifiant du responsable de la ressource
        public function getIduserOfRes(int $idRes) {
            $sql = 'SELECT iduser FROM res WHERE idres =' .$idRes. ';';
            $query = $this->connexion->prepare($sql);
            $query->execute();
            return intval($query->fetch(PDO::FETCH_NUM)[0]);
        }

        // switchUserResToAdmin: Réattribut à l'administrateur toutes les ressources
        //              d'un responsable ciblé par son identifiant $userId. 
        public function switchUserResToAdmin(int $userId) {
            // On réaffecte à admin les ressources prochainement orpheline
            $sql = "UPDATE res SET iduser = '1' WHERE iduser = ".$userId.";";
            $query = $this->connexion->prepare($sql);
            $query->execute();
        }
    }
?>