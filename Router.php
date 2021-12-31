<?php
    // Router.php toute reqête entrante est redirigée vers ce script.
    // En fonction de l'url, un controller adapté est appellé avec la bonne méthode.

    // Récupération des variables de session utlisateur. 
    session_start();

    // Protection des entrée des utilisateurs de l'application.
    // On applique un filtre permettant d'achapper tous les caractères spéciaux.
    foreach ($_POST as $key => $value) {
        $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }

    // Casse la requête courrante en un tableau
    $url = explode('/', $_SERVER['REQUEST_URI']);

    // Ici les pages principales de l'application.
    // L'url ne demande aucun paramètre, le routage est donc simplifié.
    $pages = [
        ["", "MenuController"],
        ["menu", "MenuController"],
        ["login", "LoginController"],
        ["admin", "AdminController"],
        ["ressource", "ResController"],
        ["tickets", "TicketsController"]
    ];

    foreach ($pages as $page) {
        if ( $url[1] === $page[0] ) {
            require_once('controllers/'.$page[1].'.php');
            $controller = new $page[1]();
            $controller->render();
            exit;
        }
    }

    // Permet de déconnecter l'utilisateur, de détruire sa session.
    if ($url[1] === "logout") {
        require_once('controllers/LoginController.php');
        $controller = new LoginController();
        $controller->disconnect();
        exit;
    }

    // Page permettant de signaler une ressource d'identifiant <id>.
    // /signal/<id>
    if ($url[1] === "signal" && isset($url[2]) && is_numeric($url[2])) {
        require_once('controllers/SignalController.php');
        $controller = new SignalController(intval($url[2]));
        $controller->render();
        exit;
    }

    // Page permettant d'afficher l'étiquette une ressource d'identifiant <id>.
    // /print/<id>
    if ($url[1] === "print" && isset($url[2]) && is_numeric($url[2])) {
        require_once('controllers/PrintController.php');
        $controller = new PrintController();
        $controller->print(intval($url[2]));
        exit;
    }

    // Ici les reqêtes demandants la suppression de données de l'application.
    // Les identifiants sont données par méthode POST.
    if ($url[1] === "delete" && isset($url[2])) {
        // Supression d'un utilisateur
        if ($url[2] === "user") {
            require_once('controllers/AdminController.php');
            $controller = new AdminController();
            $controller->deleteUser();
            exit;

        }
        // Supression d'une ressource
        if ($url[2] === "res") {
            require_once('controllers/ResController.php');
            $controller = new ResController();
            $controller->deleteRes();
            exit;
        }
        // Supression d'un ticket
        if ($url[2] === "ticket") {
            require_once('controllers/TicketsController.php');
            $controller = new TicketsController();
            $controller->deleteTicket();
            exit;
        }
    }

    // Ici les requêtes permettant de mettre à jour les données de l'application
    // Les informations à mettre à jours sont données en POST.
    if ($url[1] === "update" && isset($url[2])) {
        // Mettre à jour un utilisateur
        if ($url[2] === "user") {
            require_once('controllers/AdminController.php');
            $controller = new AdminController();
            $controller->updateUser();
        }
        // Mettre à jour une ressource
        if ($url[2] === "res") {
            require_once('controllers/ResController.php');
            $controller = new ResController();
            $controller->updateRes();
        }
        // Mettre à jour un ticket, (archiver un ticket)
        if ($url[2] === "ticket") {
            require_once('controllers/TicketsController.php');
            $controller = new TicketsController();
            $controller->archiveTicket();
            exit;
        }
        exit;
    }

    // Ici les requêtes permettant d'ajouter des données à l'application
    // Les informations à ajouter sont données en POST.
    if ($url[1] === "add" && isset($url[2])) {
        // Ajouter un utilisateur
        if ($url[2] === "user") {
            require_once('controllers/AdminController.php');
            $controller = new AdminController();
            $controller->addUser();
        }
        // Ajouter une ressource
        if ($url[2] === "res") {
            require_once('controllers/ResController.php');
            $controller = new ResController();
            $controller->addRes();
        }
        // Ajouter un ticket
        if ($url[2] === "signal" && isset($url[3]) && is_numeric($url[3])) {
            require_once('controllers/SignalController.php');
            $controller = new SignalController(intval($url[3]));
            $controller->addSignal();
        }
        exit;
    }

    // À but de production uniquement.
    // Permet de remettre à zero la bdd avec les données de base.
    if ($url[1] === "deploy") {
        require_once('models/ResModel.php');
        $deploy = new ResModel();
        $sql = file_get_contents('deploy/base.sql');
        $query = $deploy->connexion->prepare($sql);
        $query->execute();
        exit;
    } 

    // Sinon l'utilisateur est perdu, erreur 404.
    http_response_code(404);
    require(__DIR__.'/views/404.php');
    exit;
?>