<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');
require_once(__DIR__.'/../models/AnomalieModel.php');
require_once(__DIR__.'/../models/TicketsModel.php');

// SignalController : Page du formulaire de signalement d'anomalies concercant
// les ressources.
class SignalController extends MainController {

    private ResModel $resModel;
    private AnomalieModel $anoModel;
    private TicketsModel $ticketsModel;
    private int $idRes;

    public function __construct($idRes) {
        if ($idRes < 0) {
            header('Location: /');
            exit;
        }
        parent::__construct("Signaler un problème...");

        $this->resModel = new ResModel();
        $this->anoModel = new AnomalieModel();
        $this->ticketsModel = new TicketsModel();
        $this->idRes = intval($idRes);
    }

    // addSignal: Création d'un ticket pour une ressource
    // En POST doit être fournit soit l'identifiant de l'anomalie à ajouter au ticket
    // soit la description d'une anomalie à ajouter à l'application
    public function addSignal() {
        if (isset($_POST['idAnomalie']) && is_numeric($_POST['idAnomalie'])
            && !isset($_POST['newAnomalie'])) {

            $res = $this->resModel->getOne("idres", $this->idRes);

            $idAnomalie = intval($_POST['idAnomalie']);
            if ($idAnomalie > 0) {
                $this->ticketsModel->addTicket($this->idRes, $idAnomalie, $res['iduser'], FALSE);
            }

        } else if (isset($_POST['newAnomalie'])) {
            $res = $this->resModel->getOne("idres", $this->idRes);
            
            $idAnomalie = $this->anoModel->addAnomalie($res['categorie'], 
            substr($_POST['newAnomalie'], 0, 100));

            $this->ticketsModel->addTicket($this->idRes, $idAnomalie, $res['iduser'], TRUE);
        }

        header('Location: /signal/'.$this->idRes.'/?success');
    }

    public function render($cssIncludes = null, $jsIncludes = null, $content = null) { 
        // Récupération de la ressource à signaler depuis le modèle
        $res = $this->resModel->getOne("idres", $this->idRes);

        // Si la ressource n'existe pas on retourne au menu
        if($res==NULL) {
            header('Location: /');
        }

        $anomaliesOfRes = $this->anoModel->getValues('categorie', $res['categorie']);
        
        $cssIncludes = ['/public/css/signal.css'];
        $jsIncludes = ['/public/js/signal.js'];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/SignalView.php');
        $content = ob_get_clean();

        parent::render($cssIncludes, $jsIncludes, $content);  
    }
}

?>