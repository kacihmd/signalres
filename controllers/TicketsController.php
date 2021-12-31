<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/TicketsModel.php');

// TicketsController : Page de gestion des tickets.
class TicketsController extends MainController {

    private TicketsModel $ticketsModel;

    public function __construct() {

        parent::__construct("Gestion des Tickets");
        $this->ticketsModel = new TicketsModel();

    }

    /* archiveTicket: Dans l'état actuel de l'application la méthode n'archive pas
                      vraiment le ticket ciblé. Elle s'assure néanmoin que l'anomalie
                      associée deviennt permanente. Elle est détachée du ticket qui se voit
                      supprimée et pourra être réutilisée pour de futurs signalements.

        Doit être fournit en POST l'id du ticket à archiver.
    */
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

    /* deleteTicket: Supprime un ticket donné. Si une anomalie y est attachée elle 
                     sera supprimée aussi de part les propriété définit dans 
                     la base de donnée.
        En POST doit être donné l'identifiant du ticket.
    */
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