<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');
// require_once(__DIR__.'/../models/SignalModel.php');

class SignalController extends MainController {

    private ResModel $resModel;

    public function __construct() {
        parent::__construct("Ressources");
        $this->resModel = new ResModel();
    }

    public function render($content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        //$allRes = $this->resModel->getOne();

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/SignalView.php');
        $content = ob_get_clean();

        parent::render($content);        
    }
}

?>