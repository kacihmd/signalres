<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');


class PrintController extends MainController {

    public function __construct() {
        parent::__construct("Etiquette Ressource");
        $this->resModel = new ResModel();

        $this->api = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=";
        $this->url = "http://192.168.76.76/signal/";
    }

    public function print(int $resId) {
        $res = $this->resModel->getOne('idres', $resId);

        if ((isset($_SESSION['username']) && $_SESSION['username'] === 'admin')
            || ((isset($_SESSION['iduser']) && $_SESSION['iduser'] === intval($res['iduser'])))) {
                // On génère la vue spécifique à l'étiquette d'une ressource
            
            require(__DIR__.'/../views/PrintView.php');
            exit;
        } else {
            header('Location: /menu');
        }
    }
}

?>