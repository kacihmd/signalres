<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');

class ResController extends MainController {

    private ResModel $resModel;

    public function __construct() {

        parent::__construct("Page Responsable");
        $this->resModel = new ResModel();

    }

    public function deleteRes() {
        if (isset($_POST['id']) && is_numeric($_POST['id']) ) {

            if ($_SESSION['username'] === 'admin' 
                || $this->resModel->getRespOfRes($_POST['id']) === intval($_SESSION['id'])) {
                
                $this->resModel->deleteOne("idres", $_POST['id']);
            }
        
        }
        header('Location: /admin');
        exit;
    }

    public function updateRes() {
        if (isset($_POST['desc']) && isset($_POST['cat']) 
            && isset($_POST['loc'])) {
                    
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

            $respId = $_SESSION['id'];
            if ($_SESSION['username'] === 'admin' 
                && isset($_POST['resp']) && $_POST['resp'] !== "") {
                // Si l'admin modifie une ressource en y assignant un responsable spécifique
                // On récupère l'identifiant du responsable
                $respId = (new UserModel)->getIdOfUsername($_POST['resp']);
            }
            array_push($keys, 'idres');
            array_push($values, $respId);

            $this->resModel->updateOne("idres", $_POST['id'], $keys, $values);
        }
        
        header('Location: /admin');
        exit;
    }

    public function addRes() {
        if (isset($_POST['desc']) && isset($_POST['cat']) 
            && isset($_POST['loc'])) {

            if ($_POST['desc'] !== "" && $_POST['cat'] !== ""
                && $_POST['loc'] !== "") {

                $respId= $_SESSION['id'];

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
            require_once(__DIR__.'/../models/UserModel.php');
            $users = (new UserModel())->getUsernames();
        } else {
            // Récupération des ressources du responsable
            $res = $this->resModel->getValues("iduser", $_SESSION['iduser']);   
        }

        $cssInclude = ['/public/css/ressource.css'];

        // On génère la vue spécifique à la page responsable
        ob_start();
        require(__DIR__.'/../views/ResView.php');
        $content = ob_get_clean();

        parent::render($cssInclude, null, $content);  
    }
}

?>