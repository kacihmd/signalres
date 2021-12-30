<!-- A définir ici la vue de page générale -->
<!-- Par exemple le menu qui s'affiche partout, le footer etc... -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="/public/images/logo.png" rel="icon">
        <link href="/public/css/main.css" rel="stylesheet" />

        <?php
            if ($cssIncludes != null) {
                foreach ($cssIncludes as $file) {
                    echo('<link href="'.$file.'" rel="stylesheet">');
                }
            }
            if ($jsIncludes != null) {
                foreach ($jsIncludes as $file) {
                    echo('<script src="'.$file.'"></script>');
                }
            }
        ?>
    </head>

    <body>

        <!-- En tête de la page -->
        <header class="mainHeader">
            
            <?php 
                if (isset($_SESSION['username'])) {
                    echo('<p class="username">'.$_SESSION['username'].'</p>');
                }
            ?>

            <img class="logo" src="/public/images/logo.png" alt="signalres logo"
                onclick="window.location='/';">
            <div class="navigation">
                <?php if($_SESSION['username'] === 'admin') {
                        echo('<a href="/admin">Admin</a>');
                    } 
                ?>
                <?php if(isset($_SESSION['username'])) {
                        echo('<a href="/ressource">Ressources</a>');
                        echo('<a href="/tickets">Tickets</a>');
                    } 
                ?>
                <?php if(isset($_SESSION['username'])) {
                        echo('<a href="/logout">Déconnexion</a>');
                    } else {
                        echo('<a href="/login">Connexion</a>');
                    }
                ?>
            </div>
        </header>

        <!-- Contenu inséré dynamiquement -->
        <div class="content">
            <?= $content ?>
        </div>

    </body>

</html>