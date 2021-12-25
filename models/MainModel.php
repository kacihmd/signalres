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
 
    public function setConnection(){
        // On supprime la connexion précédente
        $this->conexion = null;

        // On essaie de se connecter à la base
        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . 
                    ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function getOne($key, $value){
        $sql = "SELECT * FROM ".$this->table." WHERE ".$key."='".$value."'";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetch();    
    }

    public function getAll(){
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

    public function getValues($key, $value){
        $sql = "SELECT * FROM ".$this->table." WHERE ".$key."='".$value."'";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

    public function deleteOne($key, $value){
        $sql = "DELETE FROM ".$this->table." WHERE ".$key."='".$value."'";
        $query = $this->connexion->prepare($sql);
        $query->execute();   
    }

}

?>