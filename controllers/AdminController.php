<?php

require_once('MainController.php');

class AdminController extends MainController {

    public function __construct() {

        parent::__construct("Page Administrateur");

    }

    public function render($include = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle

        $include = [['/views/css/admin.css', 'stylesheet']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/AdminView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }
}

?>