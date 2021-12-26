<?php

require_once('MainController.php');

class MenuController extends MainController {

    public function __construct() {
        parent::__construct("Page Principale");
    }

    public function render($cssIncludes = null, $jsIncludes = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        //$allRes = $this->resModel->getOne();

        $cssIncludes = ['public/css/menu.css'];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/MenuView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, null, $content);  
    }
}

?>