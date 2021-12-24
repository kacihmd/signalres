<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/UserModel.php');

class AdminController extends MainController {

    private UserModel $userModel;

    public function __construct() {

        parent::__construct("Page Administrateur");

        $this->userModel = new UserModel();
    }

    public function render($include = null, $content = null) {
        if ($_SESSION['username']=='admin' && $_SESSION['iduser']==0) {
            // Récupération de tout les utilisateurs
            $users = $this->userModel->getAll();

            $include = [['/views/css/admin.css', 'stylesheet']];

            // On génère la vue spécifique au signalement d'une ressource
            ob_start();
            require(__DIR__.'/../views/AdminView.php');
            $content = ob_get_clean();

            parent::render($include, $content);  
        }
        else {
            header('Location: http://192.168.76.76/');
        }
    }
}

?>