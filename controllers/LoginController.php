<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/UserModel.php');

class LoginController extends MainController {

    private UserModel $userModel;

    public function __construct() {

        parent::__construct("Connexion");

        $this->userModel = new UserModel();
    }

    public function connect() {
        // On regarde s'il y a un utilisateur de ce nom dans la base de données
        $user = $this->userModel->getOne("username", $_POST['user']);

        if (isset($user) && $user != null) {

            // Si le mot de passe est bien le bon
            if(!strcmp($_POST['mdp'], $user[2])) {
                $_SESSION['username'] = $_POST['user'];
                $_SESSION['iduser'] = intval($user['iduser']);

                header('Location: /ressource'); 
                exit;   
            }  
        }
        else {
            //Problème de connexion
        }
    }

    public function disconnect() {
        session_destroy();
        header('Location: /');
        exit;
    }

    public function render($include = null, $content = null) {
        if(isset($_SESSION['username'])) {
            header('Location: /'); 
            exit;
        }

        if(isset($_POST['user']) && isset($_POST['mdp'])) {
            $this->connect();
        }

        $include = [['/public/css/login.css', 'stylesheet']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/LoginView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }

}

?>