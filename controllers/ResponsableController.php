<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');

class ResponsableController extends MainController {

    private ResModel $resModel;

    public function __construct() {

        parent::__construct("Page Responsable");
        $this->resModel = new ResModel();

    }

    public function render($include = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        $res = $this->resModel->getOne("iduser", $this->sessionId);

        $include = [['/views/css/responsable.css', 'stylesheet']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/ResponsableView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }
}

?>