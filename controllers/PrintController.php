<?php

require_once('MainController.php');
require_once(__DIR__.'/../models/ResModel.php');

// PrintController : Page générant l'étiquette d'une ressource
class PrintController extends MainController {

    private String $api;
    private String $url;

    public function __construct() {
        parent::__construct("Etiquette Ressource");
        $this->resModel = new ResModel();

        // url de l'api générant les qr codes.
        $this->api = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=";
        // url menant vers le formulaire de signalement de la ressource 
        // d'id <id> à laquelle sera suffixée <id>
        $this->url = "http://192.168.76.76/signal/";
    }

    public function print(int $resId) {
        $res = $this->resModel->getOne('idres', $resId);

        // Seul l'administrateur et le responsable de la ressource peuvent demander 
        // à imprimer l'étiquette d'une ressource.
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