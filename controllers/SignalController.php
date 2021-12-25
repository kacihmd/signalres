<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');
require_once(__DIR__.'/../models/SignalModel.php');
// require_once(__DIR__.'/../models/SignalModel.php');

class SignalController extends MainController {

    private ResModel $resModel;
    private SignalModel $sigModel;
    private int $resId;

    public function __construct(int $resId) {
        assert($resId >= 0);
        parent::__construct("Signaler un problème...");

        $this->resModel = new ResModel();
        $this->sigModel = new SignalModel();
        $this->resId = $resId;
    }

    public function render($include = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        $res = $this->resModel->getOne("idres", $this->resId);
        
        if(isset($_POST['anomalie'])) {
            echo("TESTTEST");
            $this->sigModel->addOne($this->resId, $_POST['anomalie']);
        }

        $include = [['/views/css/signal.css', 'stylesheet']];

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/SignalView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }
}

?>