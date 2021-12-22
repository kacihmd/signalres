<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');
// require_once(__DIR__.'/../models/SignalModel.php');

class SignalController extends MainController {

    private ResModel $resModel;
    private int $resId;

    public function __construct(int $resId) {
        assert($resId >= 0);

        parent::__construct("Ressources");

        $this->resModel = new ResModel();
        $this->resId = $resId;
    }

    public function render($include = null, $content = null) {
        // Récupération de la ressources à signaler depuis le modèle
        $res = $this->resModel->getOne($this->resId);
        
        $include = null;

        // On génère la vue spécifique au signalement d'une ressource
        ob_start();
        require(__DIR__.'/../views/SignalView.php');
        $content = ob_get_clean();

        parent::render($include, $content);  
    }
}

?>