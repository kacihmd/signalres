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
                    ";dbname=" . $this->db_name, $this->username, $this->password,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
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
        return $query->fetchAll(PDO::FETCH_NUM);    
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

    // key et value servent à identifier l'élément à modifier
    // keys et values sont les entrées à modifier
    public function updateOne($key, $value, $keys, $values) {

        $n = count($keys);

        // On ne fait rien si il n'y a pas le même nombre de clés et de valeurs
        // Ou si il n'y a rien à modifier
        if ($n != count($values) || $n < 1) {
            return;
        }

        $set = "";
        for ($i = 0; $i < $n; ++$i) {
            $set = $set . $keys[$i] . "='" . $values[$i] . "' ";
            if ($i < $n - 1) {
                $set = $set . " , ";
            }
        }

        $sql = "UPDATE ".$this->table." SET ".$set." WHERE ".$key."='".$value."';";
        // echo($sql);
        $query = $this->connexion->prepare($sql);
        $query->execute();
    }

}

?>