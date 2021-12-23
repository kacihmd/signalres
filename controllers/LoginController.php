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

        if (isset($user) && $user!=null) {

            // Si le mot de passe est bien le bon
            if (true) {
                $_SESSION['username'] = $_POST['user'];
                $_SESSION['iduser'] = $user['iduser'];

                header('Location: http://192.168.76.76/responsable');    
            }  
        }
        else {
            //Problème de connexion
        }
    }

    public function render($include = null, $content = null) {
        if(isset($_POST['user']) && isset($_POST['mdp'])) {
            $this->connect();
        }

        $include = [['/views/css/login.css', 'stylesheet']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/LoginView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }

}

?>