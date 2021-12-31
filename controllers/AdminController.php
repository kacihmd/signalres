<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/UserModel.php');

// AdminController : Classe affichant la page de gestion des gestionnaires 
// de ressource.
class AdminController extends MainController {

    private UserModel $userModel;

    public function __construct() {
        parent::__construct("Page Administrateur");

        // Si ce n'est pas l'administrateur qui est connecté, retourne au menu.
        if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
            header('Location: /');
            exit;
        }

        $this->userModel = new UserModel();
    }

    // deleteUser: la suppression d'un gestionnaire de ressource de 
    // l'application.
    // L'identifiant de l'utilisateur à supprimer doit être donné en POST.
    public function deleteUser() {
        if (isset($_POST['id'])) {
            $this->userModel->deleteOne("username", $_POST['id']);
        }
        header('Location: /admin');
        exit;
    }

    // updateUser: Met à jour les données d'un utilisateur.
    // Le nom d'utilisateur doit être donné en POST.
    // Le nouveau nom d'utilisateur et le nouveau mot de passe doivent
    // être donnés en POST mais ne sont pas obligatoire définis.
    public function updateUser() {
        if (isset($_POST['id'])
            && isset($_POST['username']) && isset($_POST['password'])) {

            $keys = [];
            $values = [];

            if ($_POST['username'] !== "") {
                array_push($keys, 'username');
                array_push($values, $_POST['username']);
            }

            if ($_POST['password'] !== "") {
                array_push($keys, 'mdp');
                array_push($values, password_hash($_POST['password'], null));
            }

            $this->userModel->updateOne("username", $_POST['id'], $keys, $values);
        }
        
        header('Location: /admin');
        exit;
    }

    // addUser: Ajoute un nouvel utilisateur à l'application.
    // Le nom d'utilisateur et le mot de passe doivent être spécifié en POST. 
    public function addUser() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            
            // Aucune expression regulière ne contraint le mot de passe ou le nom
            // d'utilisateur. Peut se mettre en place facilement.

            if (strlen($_POST['username']) !== 0 && strlen($_POST['password']) !== 0) {
                $this->userModel->addOne($_POST['username'], password_hash($_POST["password"], NULL));
            }

        }
        header('Location: /admin');
        exit;    
    }

    public function render($cssIncludes = null, $jsIncludes = null, $content = null) {

        // Récupération de tous les utilisateurs
        $users = $this->userModel->getAll();

        $cssIncludes = ['/public/css/crud.css'];
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