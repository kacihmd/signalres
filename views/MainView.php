<!-- A définir ici la vue de page générale -->
<!-- Par exemple le menu qui s'affiche partout, le footer etc... -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="views/images/logo.png" rel="icon">
        <link href="views/css/main.css" rel="stylesheet" />

        <?php
            foreach ($includes as $file) {
                echo('<link href="'.$file[0].'" rel="'.$file[1].'">');
            }
        ?>
    </head>

    <body>

        <!-- En tête de la page -->
        <header class="mainHeader">
            <img class="logo" src="views/images/logo.png">
            <div class="navigation">
                <a href="/menu">Menu</a>
                <a href="/login">Connexion</a>
            </div>
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