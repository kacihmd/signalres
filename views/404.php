<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page 404</title>
        <link href="/public/images/logo.png" rel="icon">
        <link href="/public/css/main.css" rel="stylesheet" />
        <link href="/public/css/404.css" rel="stylesheet" />
    </head>

    <body>

        <!-- En tête de la page -->

        <!-- Contenu inséré dynamiquement -->
        <div>
            <img src="/public/images/logo.png"/> </br>
        </div>
        <div>
        <div class="menu">
            Erreur 404 </br>
            La page demandée n'existe pas ! <?= $_SERVER['REQUEST_URI'] ?> </br>
            Revenir sur le 
            <a href="/menu">Menu</a>
        </div>
        </div>

    </body>

</html>