<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');
require_once(__DIR__.'/../models/UserModel.php');

// ResController : Page de gestion des ressources
class ResController extends MainController {

    private ResModel $resModel;

    public function __construct() {

        parent::__construct("Page Responsable");
        $this->resModel = new ResModel();

    }

    // deleteRes: Méthode de suppression d'une ressource de l'application.
    // L'identifiant de la ressource doit être donné en POST.
    public function deleteRes() {
        if (isset($_POST['idres']) && is_numeric($_POST['idres']) ) {

            // Seul l'administrateur ou le responsable de la ressource peut
            // demander sa suppression.
            if ($_SESSION['username'] === 'admin' 
                || $this->resModel->getIduserOfRes($_POST['idres']) === intval($_SESSION['iduser'])) {
                
                $this->resModel->deleteOne("idres", $_POST['idres']);
            }
        
        }
        header('Location: /ressource');
        exit;
    }

    // updateRes: Méthode permettant de mettre à jour les caractéristiques d'un
    // ressource. En POST doit être doit être fournit l'identifiant de la ressource.
    // Peuvent être fournit une description, une catégorie, une localisation. 
    public function updateRes() {
        if (isset($_POST['id']) && is_numeric($_POST['id']) &&
            isset($_POST['desc']) && isset($_POST['cat']) && isset($_POST['loc'])) {
                    
            $keys = [];
            $values = [];

            if ($_POST['desc'] !== "") {
                array_push($keys, 'description');
                array_push($values, $_POST['desc']);
            }

            if ($_POST['cat'] !== "") {
                array_push($keys, 'categorie');
                array_push($values, $_POST['cat']);
            }

            if ($_POST['loc'] !== "") {
                array_push($keys, 'localisation');
                array_push($values, $_POST['loc']);
            }

            $respId = $_SESSION['iduser'];
            if ($_SESSION['username'] === 'admin' 
                && isset($_POST['resp']) && $_POST['resp'] !== "") {
                // Si l'admin modifie une ressource en y assignant un responsable spécifique
                // On récupère l'identifiant du responsable
                $respId = (new UserModel)->getIdOfUsername($_POST['resp']);
            }
            array_push($keys, 'iduser');
            array_push($values, $respId);

            $this->resModel->updateOne("idres", $_POST['id'], $keys, $values);
        }
        
        header('Location: /ressource');
        exit;
    }

    // addRes: Méthode permettant d'ajouter une ressource à l'application.
    // Doivent être fournit en POST une decription, une catégorie, une localisation,
    // et éventuellement un responsable dans le cas d'un ajout par l'administrateur 
    public function addRes() {
        if (isset($_POST['desc']) && isset($_POST['cat']) 
            && isset($_POST['loc'])) {

            if ($_POST['desc'] !== "" && $_POST['cat'] !== ""
                && $_POST['loc'] !== "") {

                $respId = $_SESSION['iduser'];

                if ($_SESSION['username'] === 'admin' 
                    && isset($_POST['resp']) && $_POST['resp'] !== "") {
                    // Si l'admin ajoute une ressource et qu'il y assigne un responsable spécifique
                    // On récupère l'identifiant du responsable
                    $respId = (new UserModel)->getIdOfUsername($_POST['resp']);
                }

                $this->resModel->addOne($_POST['desc'], $_POST['cat'], 
                                            $_POST['loc'], $respId);
            }
        }
        header("Location: /ressource");
        exit;
    }

    public function render($cssInclude = null, $jsInclude = null, $content = null) {
        if (!isset($_SESSION['iduser']) || $_SESSION['iduser'] == null) {
            session_destroy();
            header('Location: /');
        }

        if ($_SESSION['username'] === 'admin') {
            // Récupération de toutes les ressources
            $res = $this->resModel->getAll();
            // Récupération de la liste des utilisateurs
            $users = (new UserModel())->getUsernames();
        } else {
            // Récupération des ressources du responsable
            $res = $this->resModel->getValues("iduser", $_SESSION['iduser']);   
        }

        $cssIncludes = ['/public/css/crud.css'];
        $jsIncludes = ['/public/js/res.js'];

        // On génère la vue spécifique à la page responsable
        ob_start();
        require(__DIR__.'/../views/ResView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, $jsIncludes, $content);  
    }
}

?>