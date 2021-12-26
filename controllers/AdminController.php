<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/UserModel.php');

class AdminController extends MainController {

    private UserModel $userModel;

    public function __construct() {

        parent::__construct("Page Administrateur");

        $this->userModel = new UserModel();
    }

    public function deleteUser() {
        if(isset($_POST['usertodelete'])){
                $this->userModel->deleteOne("iduser", $_POST['usertodelete']);
            }
        header('Location : /admin');
        exit;
    }

    public function addUser() {
        if(isset($_POST['username'])){
                $this->userModel->addOne($_POST['username'], "password");
            header('Location : /admin');
            exit;
        }
    }

    public function render($include = null, $content = null) {

        if (!isset($_SESSION['username']) || !isset($_SESSION['iduser']) ||
            $_SESSION['username'] !== 'admin' || $_SESSION['iduser'] !== 1) {
            header('Location: /');
            exit;
        }

        // Récupération de tout les utilisateurs
        $users = $this->userModel->getAll();

        $include = [['/public/css/admin.css', 'stylesheet'],
                    ['/public/js/admin.js', 'javascript']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/AdminView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
        exit;
    }
}

?>