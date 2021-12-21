<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');

class ResController extends MainController {

    private ResModel $resModel;

    public function __construct() {
        $this->resModel = new ResModel();
    }

    public function render() {
        print("Voici la pages des ressources ! <br>");

        // Récupération des ressources depuis le modèle
        $allRes = $this->resModel->getAll();

        // On génère la vue qui nous interesse et on la stock dans $content
        ob_start();
        require_once(__DIR__.'/../views/ResView.php');
        $content = ob_get_clean();

        // Puis on affiche $content dans la vue principale MainView
        require_once(__DIR__.'/../views/MainView.php');
    }
}

?>