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
        printf("Welcome to signal res ! <br>");

        // Nous appellons le controlleur approprié
        require_once('controllers/MenuController.php');
        $controller = new MenuController();
        $controller->response();

    } else if ($url[1] == "res") {
        // Si l'utilisateur demande la page des ressources
        // Nous appellons le controlleur approprié
        require_once('controllers/ResController.php');
        $controller = new ResController();
        $controller->render();

    } else {
        // Sinon l'utilisateur est perdu (pour l'instant)
        http_response_code(404);
        print("La page demandée n'existe pas !");
    } 
?>