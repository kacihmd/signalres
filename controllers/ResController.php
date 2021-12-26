<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');

class ResController extends MainController {

    private ResModel $resModel;

    public function __construct() {

        parent::__construct("Page Responsable");
        $this->resModel = new ResModel();

    }

    public function render($include = null, $content = null) {
        if (isset($_SESSION['iduser']) && $_SESSION['iduser'] != null) {

            if (isset($_POST['description']) 
                && isset($_POST['categorie']) 
                && isset($_POST['localisation'])) {
                    
                $this->resModel->addOne($_POST['description'], 
                                        $_POST['categorie'], 
                                        $_POST['localisation'], 
                                        $_SESSION['iduser']);
            }

            // Récupération des ressources du responsable
            if ($_SESSION['username'] === 'admin') {
                $res = $this->resModel->getAll();
            } else {
                $res = $this->resModel->getValues("iduser", $_SESSION['iduser']);
            }

            $include = [['/public/css/responsable.css', 'stylesheet']];

            // On génère la vue spécifique à la page responsable
            ob_start();
            require(__DIR__.'/../views/ResView.php');
            $content = ob_get_clean();

            parent::render($include, $content);  
        }
        else {
            header('Location: /');
        }
    }
}

?>