<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/TicketsModel.php');

class TicketsController extends MainController {

    private TicketsModel $ticketsModel;

    public function __construct() {

        parent::__construct("Gestion des Tickets");
        $this->ticketsModel = new TicketsModel();

    }

    public function render($cssInclude = null, $jsInclude = null, $content = null) {
        if (!isset($_SESSION['iduser']) || $_SESSION['iduser'] == null) {
            session_destroy();
            header('Location: /');
        }

        if ($_SESSION['username'] === 'admin') {
            // Récupération de tous les tickets
            $tickets = $this->ticketsModel->getAll();
        } else {
            // Récupération des tickets du responsable
            $tickets = $this->ticketsModel->getValues("iduser", $_SESSION['iduser']);   
        }

        $cssIncludes = ['/public/css/res.css'];
        $jsIncludes = ['/public/js/res.js'];

        // On génère la vue spécifique à la page responsable
        ob_start();
        require(__DIR__.'/../views/TicketsView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, $jsIncludes, $content);  
    }
}

?>