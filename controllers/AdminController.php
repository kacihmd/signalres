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
        if (isset($_POST['id']) ) {
            $this->userModel->deleteOne("username", $_POST['id']);
        }
        header('Location: /admin');
        exit;
    }

    public function updateUser() {
        if (isset($_POST['id']) 
            && isset($_POST['username']) 
            && isset($_POST['password'])) {

            $keys = [];
            $values = [];

            if ($_POST['username'] !== "") {
                array_push($keys, 'username');
                array_push($values, $_POST['username']);
            }

            if ($_POST['password'] !== "") {
                array_push($keys, 'mdp');
                array_push($values, $_POST['password']);
            }

            $this->userModel->updateOne("username", $_POST['id'], $keys, $values);
        }
        
        header('Location: /admin');
        exit;
    }

    public function addUser() {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            if (strlen($_POST['username']) !== 0 && strlen($_POST['password']) !== 0) {
                $this->userModel->addOne($_POST['username'], $_POST["password"]);
            }

        }
        header('Location: /admin');
        exit;    
    }

    public function render($cssIncludes = null, $jsIncludes = null, $content = null) {

        if (!isset($_SESSION['username']) || !isset($_SESSION['iduser']) ||
            $_SESSION['username'] !== 'admin' || $_SESSION['iduser'] !== 1) {
            header('Location: /');
            exit;
        }

        // Récupération de tout les utilisateurs
        $users = $this->userModel->getAll();

        $cssIncludes = ['/public/css/admin.css'];
        $jsIncludes = ['/public/js/admin.js'];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/AdminView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, $jsIncludes, $content);  
        exit;
    }
}

?>