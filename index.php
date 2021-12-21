<?php

    // Sert à activer l'affichage des erreures de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Récupère la requête tapée par l'utilisateur
    print($_SERVER['REQUEST_URI'] . "<br>");

    // Casse la requête en un tableau
    $url = explode('/', $_SERVER['REQUEST_URI']);

    // Affiche le tableau des composantes de la requête
    // foreach ($_GET as $key => $value) {
    //     print($key . " -> |" . $value . "| <br>");
    // }

    if ($url[1] == "" || $url[1] == "menu") {
        // Si l'utilisateur demande le menu
        printf("Welcome to signal res !");
    } else {
        // Sinon il est perdu (pour l'instant)
        printf("You lost bro ? " . $url[1]);
    } 
?>