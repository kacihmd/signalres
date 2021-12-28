<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');
require_once(__DIR__.'/../models/SignalModel.php');

class SignalController extends MainController {

    private ResModel $resModel;
    private SignalModel $signalModel;
    private int $idRes;

    public function __construct($idRes) {
        if ($idRes < 0) {
            header('Location: /');
            exit;
        }
        parent::__construct("Signaler un problème...");

        $this->resModel = new ResModel();
        $this->signalModel = new SignalModel();
        $this->idRes = intval($idRes);
    }

    public function addSignal() {
        if (isset($_POST['idAnomalie']) && is_numeric($_POST['idAnomalie'])
            && !isset($_POST['newAnomalie'])) {

            $res = $this->resModel->getOne("idres", $this->idRes);

            $idAnomalie = intval($_POST['idAnomalie']);
            if ($idAnomalie > 0) {
                $this->signalModel->addTicket($this->idRes, $idAnomalie, $res['iduser'], FALSE);
            }

        } else if (isset($_POST['newAnomalie'])) {
            $res = $this->resModel->getOne("idres", $this->idRes);
            
            $idAnomalie = $this->signalModel->addAnomalie($res['categorie'], 
            filter_var(substr($_POST['newAnomalie'], 0, 100), FILTER_SANITIZE_STRING));

            $this->signalModel->addTicket($this->idRes, $idAnomalie, $res['iduser'], TRUE);
        }

        header('Location: /signal/'.$this->idRes);
    }

    public function render($cssIncludes = null, $jsIncludes = null, $content = null) { 
        // Récupération de la ressources à signaler depuis le modèle
        $res = $this->resModel->getOne("idres", $this->idRes);

        $anomaliesOfRes = $this->signalModel->getAnomaliesOfCategory($res['categorie']);
        
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