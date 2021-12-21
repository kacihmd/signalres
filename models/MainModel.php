<?php

abstract class MainModel {
    // Informations de la base de données
    private $host = "localhost";
    private $db_name = "projet";
    private $username = "projet";
    private $password = "tejorp";

    // Instance de la connexion à la bdd
    protected $conexion;
    protected $table;

    function __construct(String $table) {
        $this->table = $table;
        $this->setConnection();
    }
 
    /**
     * Fonction d'initialisation de la connexion à la base de données
     *
     * @return void
     */
    public function setConnection(){
        // On supprime la connexion précédente
        $this->conexion = null;

        // On essaie de se connecter à la base
        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . 
                    ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }  

    /**
     * Méthode permettant d'obtenir un enregistrement de la table choisie en 
     * fonction d'un id
     *
     * @return void
     */
    public function getOne($id){
        $sql = "SELECT * FROM ".$this->table." WHERE id=".$this->id;
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetch();    
    }

    /**
     * Méthode permettant d'obtenir tous les enregistrements de la table 
     * choisie
     *
     * @return void
     */
    public function getAll(){
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

}

?>