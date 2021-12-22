<!-- A définir ici la vue de page générale -->
<!-- Par exemple le menu qui s'affiche partout, le footer etc... -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="views/css/main.css" rel="stylesheet" /> 
    </head>

    <body>

        <!-- En tête de la page -->
        <header class="mainHeader">
            <img class="logo" src="images/logo.png">
        </header>

        <!-- Contenu inséré dynamiquement -->
        <div class="content">
            <?= $content ?>
        </div>

        <!-- Pied de page -->
        <div class="footer"> 
            SignalRes : Dites nous tous vos problèmes !
        </div>

    </body>

</html>