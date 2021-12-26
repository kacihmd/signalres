<?php
    // Sert à activer l'affichage des erreurs de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Casse la requête courrante en un tableau
    $url = explode('/', $_SERVER['REQUEST_URI']);

    //Affiche le tableau des composantes de la requête
    // foreach ($_GET as $key => $value) {
    //     print($key . " -> |" . $value . "| <br>");
    // }

    $pages = [
        ["", "MenuController"],
        ["menu", "MenuController"],
        ["login", "LoginController"],
        ["admin", "AdminController"],
        ["ressource", "ResController"]
    ];

    foreach ($pages as $page) {
        if ( $url[1] === $page[0] ) {
            require_once('controllers/'.$page[1].'.php');
            $controller = new $page[1]();
            $controller->render();
            exit;
        }
    }

    if ($url[1] === "logout") {
        require_once('controllers/LoginController.php');
        $controller = new LoginController();
        $controller->disconnect();
        exit;
    }

    if ($url[1] === "signal" && isset($url[2])) {
        require_once('controllers/SignalController.php');
        $controller = new SignalController($url[2]);
        $controller->render();
        exit;
    }

    if ($url[1] === "delete" && isset($url[2])) {
        require_once('controllers/AdminController.php');
        if ($url[2] === "user") {
            $controller = new AdminController($url[2]);
            $controller->deleteUser();
        }
        exit;
    }

    if ($url[1] === "update" && isset($url[2])) {
        require_once('controllers/AdminController.php');
        if ($url[2] === "user") {
            $controller = new AdminController($url[2]);
            $controller->updateUser();
        }
        exit;
    }

    if ($url[1] === "add" && isset($url[2])) {
        require_once('controllers/AdminController.php');
        if ($url[2] === "user") {
            $controller = new AdminController($url[2]);
            $controller->addUser();
        }
        exit;
    }

    if ($url[1] === "deploy") {
        require_once('models/ResModel.php');
        $deploy = new ResModel();
        $sql = file_get_contents('deploy/base.sql');
        $query = $deploy->connexion->prepare($sql);
        $query->execute();
        exit;
    } 

    // Sinon l'utilisateur est perdu (pour l'instant)
    http_response_code(404);
    print("La page demandée n'existe pas ! " . $_SERVER['REQUEST_URI']);

    exit;
?>