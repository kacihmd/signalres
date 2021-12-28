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

        if (isset($user)) {

            // Si le mot de passe est bien le bon
            if (password_verify($_POST['mdp'], $user['mdp'])) {
                $_SESSION['username'] = $_POST['user'];
                $_SESSION['iduser'] = intval($user['iduser']);

                header('Location: /ressource'); 
                exit;   
            }

        }

        header('Location: /login/?failure'); 
        exit; 
    }

    public function disconnect() {
        session_destroy();
        header('Location: /');
        exit;
    }

    public function render($cssIncludes = null, $jsIncludes = null, $content = null) {        if(isset($_SESSION['username'])) {
            header('Location: /'); 
            exit;
        }

        if(isset($_POST['user']) && isset($_POST['mdp'])) {
            $this->connect();
        }

        $cssIncludes = ['/public/css/login.css'];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/LoginView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, null, $content);  
    }

}

?>