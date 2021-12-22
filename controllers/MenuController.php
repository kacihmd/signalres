<?php

require_once('MainController.php');

class MenuController extends MainController {

    public function __construct() {
        parent::__construct("Page Principale");
    }

    public function render($includes = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        //$allRes = $this->resModel->getOne();

        $includes = [['views/css/menu.css', 'stylesheet']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/MenuView.php');
        $content = ob_get_clean();

        parent::render($includes, $content);        
    }
}

?>