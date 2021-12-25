<?php
    // Sert à activer l'affichage des erreures de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Casse la requête courrante en un tableau
    $url = explode('/', $_SERVER['REQUEST_URI']);

    //Affiche le tableau des composantes de la requête
    foreach ($_GET as $key => $value) {
        print($key . " -> |" . $value . "| <br>");
    }

    if ($url[1] == "" || $url[1] == "menu") {
        // Si l'utilisateur demande le menu
        // Nous appellons le controlleur approprié
        require_once('controllers/MenuController.php');
        $controller = new MenuController();
        $controller->render();

    } else if ($url[1] == "signal" && isset($url[2])) {
        // Si l'utilisateur demande la page de signalement
        // Nous appellons le controlleur approprié
        require_once('controllers/SignalController.php');
        $controller = new SignalController($url[2]);
        $controller->render();

    } else if ($url[1] == "login") {
        // Si l'utilisateur demande la page de connexion
        // Nous appellons le controlleur approprié
        require_once('controllers/LoginController.php');
        $controller = new LoginController();
        $controller->render();
    } else if ($url[1] == "admin") {
        // Si l'utilisateur demande la page de signalement
        // Nous appellons le controlleur approprié
        require_once('controllers/AdminController.php');
        $controller = new AdminController();
        $controller->render();
    } else if ($url[1] == "responsable") {
        // Si l'utilisateur demande la page de signalement
        // Nous appellons le controlleur approprié
        require_once('controllers/ResponsableController.php');
        $controller = new ResponsableController();
        $controller->render();
    } else if ($url[1] == "deploy") {

        // Ca fonctionne : ( A voir si on met pas un bouton quelque part sur le site..)

        require_once('models/ResModel.php');

        $deploy = new ResModel();

        $sql = file_get_contents('models/sql/base.sql');

        $query = $deploy->connexion->prepare($sql);
        $query->execute();

    } else {
        // Sinon l'utilisateur est perdu (pour l'instant)
        http_response_code(404);
        print("La page demandée n'existe pas ! " . $_SERVER['REQUEST_URI']);
    } 
?>