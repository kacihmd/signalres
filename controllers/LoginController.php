<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/UserModel.php');

class LoginController extends MainController {

    private UserModel $userModel;

    public function __construct() {

        parent::__construct("Connexion");

        $this->resModel = new UserModel();
    }

    public function render($include = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        
        $includes = null;

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/LoginView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }
}

?>