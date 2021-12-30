<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/TicketsModel.php');

class TicketsController extends MainController {

    private TicketsModel $ticketsModel;

    public function __construct() {

        parent::__construct("Gestion des Tickets");
        $this->ticketsModel = new TicketsModel();

    }

    public function archiveTicket() {
        if (isset($_POST['idTicket']) && is_numeric($_POST['idTicket'])) {
            
            $ticket = $this->ticketsModel->getValues('idtickets', intval($_POST['idTicket']))[0];
            
            if ($_SESSION['username'] ==  'admin'
                || $ticket['iduser'] == $_SESSION['iduser']) {

                    $this->ticketsModel->setAnomaliePermanent($ticket['idanomalie']);
                    $this->ticketsModel->deleteOne('idtickets', $ticket['idtickets']);
            }
        }

        header('Location: /tickets');
        exit;
    }

    public function deleteTicket() {
        if (isset($_POST['idTicket']) && is_numeric($_POST['idTicket'])) {
            
            $ticket = $this->ticketsModel->getValues('idtickets', intval($_POST['idTicket']))[0];
            
            if ($_SESSION['username'] ==  'admin'
                || $ticket['iduser'] == $_SESSION['iduser']) {

                    $this->ticketsModel->deleteOne('idtickets', $ticket['idtickets']);
            }
        }
        header('Location: /tickets');
        exit;
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

        $cssIncludes = ['/public/css/tickets.css', '/public/css/crud.css'];
        $jsIncludes = ['/public/js/tickets.js'];

        // On génère la vue spécifique à la page responsable
        ob_start();
        require(__DIR__.'/../views/TicketsView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, $jsIncludes, $content);  
    }
}

?>